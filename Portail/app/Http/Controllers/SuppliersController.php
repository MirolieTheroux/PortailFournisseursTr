<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Supplier;
use App\Models\Contact;
use App\Models\PhoneNumber;
use App\Models\RbqLicence;
use App\Models\WorkSubcategory;
use App\Models\Address;
use App\Models\Province;
use App\Models\ProductService;
use App\Models\ProductServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\facades\Session;

class SuppliersController extends Controller
{
  public function showLogin()
  {
    return View('suppliers.login');
  }

  public function login(LoginRequest $request)
  {
    $reussiNEQ=Auth::attempt(['neq' => $request->id,'password' => $request->password]);
    $reussiEmail=Auth::attempt(['email' => $request->id,'password' => $request->password]);
    if($reussiNEQ || $reussiEmail){
      $supplier = Auth::user();
      return redirect()->route('suppliers.show', $supplier)->with('message',"Connexion réussie");
    }
    else{
      return redirect()->route('suppliers.showLogin')->with('errorMessage',__('login.wrongCredentials'));
    }
  }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $workSubcategories = WorkSubcategory::orderByRaw('
          CAST(SUBSTRING_INDEX(code, ".", 1) AS UNSIGNED),
          CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(code, ".0"), ".", 2), ".", -1) AS UNSIGNED),
          CAST(SUBSTRING_INDEX(CONCAT(code, ".0.0"), ".", -1) AS UNSIGNED)
        ')->get();
        $provinces = Province::all();
        $productServices = ProductService::all();
        $productServiceSubCategories = ProductServiceCategory::all();
        $productServiceCategories = ProductServiceCategory::select('nature')->groupBy('nature')->orderBy('nature')->get();

        return View('suppliers.create', compact('workSubcategories','provinces', 'productServices', 'productServiceSubCategories', 'productServiceCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
      Log::debug($request);

      $supplier = new Supplier();
      $supplier->neq = $request->neq;
      $supplier->name = $request->name;
      $supplier->email = $request->email;
      $supplier->site = $request->contactDetailsWebsite;
      $supplier->product_service_detail = $request->product_service_detail;
      $supplier->password = Hash::make($request->password);
      $supplier->save();

      $supplier = Supplier::where('email', $request->email)->firstOrFail();

      if(!is_null($request->licenceRbq)){
        $licence = new RbqLicence();
        $licence->number = $request->licenceRbq;
        $licence->status = $request->statusRbq;
        $licence->type = $request->typeRbq;
        $licence->supplier()->associate($supplier);
        $licence->save();

        foreach($request->rbqSubcategories as $rbqSubCategory){
          $subCategory = WorkSubcategory::where('code', $rbqSubCategory)->firstOrFail();
          $supplier->workSubcategories()->attach($subCategory);
        }
      }

      $province = Province::where('name', $request->contactDetailsProvince)->firstOrFail();
      $address = new Address();
      $address->civic_no = $request->contactDetailsCivicNumber;
      $address->street = $request->contactDetailsStreetName;
      $address->office = $request->contactDetailsOfficeNumber;

      $postal_code = $request->contactDetailsPostalCode;
      $postal_code = str_replace(' ', '', $postal_code);
      $postal_code = strtoupper($postal_code);
      $address->postal_code = $postal_code;

      if($request->contactDetailsProvince == "Québec"){
        $address->city = $request->contactDetailsCitySelect;
        $address->region = $request->contactDetailsDistrictArea;
      }
      else{
        $address->city = $request->contactDetailsInputCity;
      }

      $address->supplier()->associate($supplier);
      $address->province()->associate($province);
      $address->save();

      for($i = 0 ; $i < Count($request->phoneNumbers) ; $i++){
        $phoneNumber = new PhoneNumber();
        $phoneNumber->number = str_replace('-', '', $request->phoneNumbers[$i]);
        $phoneNumber->type = $request->phoneTypes[$i];
        $phoneNumber->extension = $request->phoneExtensions[$i];
        $phoneNumber->supplier()->associate($supplier);
        $phoneNumber->contact()->associate(null);
        $phoneNumber->save();
      }

      for($i = 0 ; $i < Count($request->contactFirstNames) ; $i++){
        $contact = new Contact();
        $contact->email = $request->contactEmails[$i];
        $contact->first_name = $request->contactFirstNames[$i];
        $contact->last_name = $request->contactLastNames[$i];
        $contact->job = $request->contactJobs[$i];
        $contact->supplier()->associate($supplier);
        $contact->save();

        $contact = Contact::where('email', $request->contactEmails[$i])->firstOrFail();

        $phoneNumberA = new PhoneNumber();
        $phoneNumberA->number = $request->contactTelNumbersA[$i];
        $phoneNumberA->type = $request->contactTelTypesA[$i];
        $phoneNumberA->extension = $request->contactTelExtensionsA[$i];
        $phoneNumberA->supplier()->associate(null);
        $phoneNumberA->contact()->associate($contact);
        $phoneNumberA->save();

        if(!is_null($request->contactTelNumbersB[$i])){
          $phoneNumberB = new PhoneNumber();
          $phoneNumberB->number = $request->contactTelNumbersB[$i];
          $phoneNumberB->type = $request->contactTelTypesB[$i];
          $phoneNumberB->extension = $request->contactTelExtensionsB[$i];
          $phoneNumberB->supplier()->associate(null);
          $phoneNumberB->contact()->associate($contact);
          $phoneNumberB->save();
        }
      }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
      if($supplier == Auth::user())
        return View('suppliers.show', compact('supplier'));
      else
        return redirect()->route('suppliers.showLogin')->with('errorMessage',__('login.getWrongSupplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function checkEmail(Request $request)
    {
      $email = $request->email;
      $exists = Supplier::where('email', $email)->exists();
      return response()->json(['exists' => $exists]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function checkNeq(Request $request)
    {
      $neq = $request->neq;
      $exists = Supplier::where('neq', $neq)->exists();
      return response()->json(['exists' => $exists]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function checkRbq(Request $request)
    {
      $number = $request->number;
      $exists = RbqLicence::where('number', $number)->exists();
      return response()->json(['exists' => $exists]);
    }

}
