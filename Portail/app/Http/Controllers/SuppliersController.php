<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SupplierUpdateContactDetailsRequest;
use App\Http\Requests\SupplierUpdateContactsRequest;
use App\Http\Requests\SupplierUpdateIdentificationRequest;
use App\Http\Requests\SupplierUpdateRbqRequest;
use App\Http\Requests\SupplierUpdateFinanceRequest;
use App\Http\Requests\SupplierUpdateAttachmentsRequest;

use App\Http\Controllers\MailsController;

use App\Models\Supplier;
use App\Models\StatusHistory;
use App\Models\Contact;
use App\Models\PhoneNumber;
use App\Models\RbqLicence;
use App\Models\WorkSubcategory;
use App\Models\Address;
use App\Models\Province;
use App\Models\ProductService;
use App\Models\ProductServiceCategory;
use App\Models\Attachment;
use App\Models\EmailModel;
use App\Models\AccountModification;
use App\Models\ModificationCategory;
use App\Models\ModificationDeletion;
use App\Models\ModificationAddition;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class SuppliersController extends Controller
{
  const USING_FILESTREAM = false;

  public function home(){
    if(Auth::user()){
      $supplier = Auth::user();
      return redirect()->route('suppliers.show');
    }
    else
      return redirect()->route('suppliers.showLogin');
  }

  public function showLogin()
  {
    return View('suppliers.login');
  }

  public function login(LoginRequest $request)
  {
    $reussi = false;
    if(is_null($request->neq)){
      $reussi = Auth::attempt(['neq' => null, 'email' => $request->email,'password' => $request->password]);
    }
    else{
      $reussi = Auth::attempt(['neq' => $request->neq,'password' => $request->password]);
    }

    if($reussi){
      $supplier = Auth::user();
      return redirect()->route('suppliers.show')->with('message',"Connexion réussie");
    }
    else{
      return redirect()->route('suppliers.showLogin')->with('errorMessage',__('login.wrongCredentials'));
    }
  }

  public function logout(Request $request)
  {
      Auth::logout();
  
      $request->session()->invalidate();
  
      $request->session()->regenerateToken();
  
      return redirect()->route('suppliers.showLogin')->with('message',"Déconnexion réussie");
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

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $offset = $request->input('offset', 1); // Get the offset value, default to 0
        $limit = $request->input('limit', 50); // Get the limit value, default to 50

        // Remove accents from search term
        $normalizedSearchTerm = str_replace(
            ['À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'à', 'á', 'â', 'ã', 'ä', 'å', 'È', 'É', 'Ê', 'Ë', 'è', 'é', 'ê', 'ë', 'Ì', 'Í', 'Î', 'Ï', 'ì', 'í', 'î', 'ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'Ù', 'Ú', 'Û', 'Ü', 'ù', 'ú', 'û', 'ü', 'Ç', 'ç', 'Ñ', 'ñ'], 
            ['A', 'A', 'A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a', 'a', 'E', 'E', 'E', 'E', 'e', 'e', 'e', 'e', 'I', 'I', 'I', 'I', 'i', 'i', 'i', 'i', 'O', 'O', 'O', 'O', 'O', 'O', 'o', 'o', 'o', 'o', 'o', 'o', 'U', 'U', 'U', 'U', 'u', 'u', 'u', 'u', 'C', 'c', 'N', 'n'],
            $searchTerm
        );

        // Get total count of matching services (without limiting)
        $total_count = ProductService::whereRaw("LOWER(CONVERT(code USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$normalizedSearchTerm}%"])
            ->orWhere(function ($query) use ($normalizedSearchTerm) {
                $query->whereRaw("LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$normalizedSearchTerm}%"]);
            })
            ->count();

        // Get filtered services with limit of 50
        $services = ProductService::whereRaw("LOWER(CONVERT(code USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$normalizedSearchTerm}%"])
            ->orWhere(function ($query) use ($normalizedSearchTerm) {
                // Exact matches with description normalization
                $query->whereRaw("LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["% {$normalizedSearchTerm} %"])
                    ->orWhereRaw("LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["{$normalizedSearchTerm} %"])
                    ->orWhereRaw("LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["% {$normalizedSearchTerm}"])
                    ->orWhereRaw("LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci = ?", [$normalizedSearchTerm]);
            })
            ->orWhere(function ($query) use ($normalizedSearchTerm) {
                // Partial matches anywhere in the description with normalization
                $query->whereRaw("LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$normalizedSearchTerm}%"]);
            })
            ->orderByRaw("CASE 
                WHEN LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE '{$normalizedSearchTerm}' THEN 1
                WHEN LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE '{$normalizedSearchTerm} %' THEN 2
                WHEN LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE '% {$normalizedSearchTerm} %' THEN 3
                WHEN LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE '% {$normalizedSearchTerm}' THEN 4
                ELSE 5 
            END")
            ->orderByRaw("POSITION('{$normalizedSearchTerm}' IN LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci) ASC")
            ->offset($offset)
            ->take($limit) // Limit results for performance
            ->get();

        // Return both the services and the total count
        return response()->json([
            'services' => $services,
            'total_count' => $total_count
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
      $supplier = new Supplier();
      $supplier->neq = $request->neq;
      $supplier->name = $request->name;
      $supplier->email = $request->email;
      $supplier->site = $request->contactDetailsWebsite;
      $supplier->product_service_detail = $request->product_service_detail;
      $supplier->password = Hash::make($request->password);
      $supplier->save();

      $status_histories = new StatusHistory();
      $status_histories->status = 'waiting';
      $status_histories->updated_by = $request->email;
      $status_histories->supplier_id = $supplier->id;
      $status_histories->created_at = Carbon::now('America/Toronto');
      $status_histories->supplier()->associate($supplier);
      $status_histories->save();

      if($request->filled('products_services')){
        if(count($request->products_services) > 0){
          foreach($request->products_services as $product_service){
            $productService = ProductService::where('code', $product_service)->firstOrFail();
            $productService->suppliers()->attach($supplier->id);
          }
        }
      }
      
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

        $phoneNumberA = new PhoneNumber();
        $phoneNumberA->number = str_replace('-', '', $request->contactTelNumbersA[$i]);
        $phoneNumberA->type = $request->contactTelTypesA[$i];
        $phoneNumberA->extension = $request->contactTelExtensionsA[$i];
        $phoneNumberA->supplier()->associate(null);
        $phoneNumberA->contact()->associate($contact);
        $phoneNumberA->save();

        if(!is_null($request->contactTelNumbersB[$i])){
          $phoneNumberB = new PhoneNumber();
          $phoneNumberB->number = str_replace('-', '', $request->contactTelNumbersB[$i]);
          $phoneNumberB->type = $request->contactTelTypesB[$i];
          $phoneNumberB->extension = $request->contactTelExtensionsB[$i];
          $phoneNumberB->supplier()->associate(null);
          $phoneNumberB->contact()->associate($contact);
          $phoneNumberB->save();
        }
      }

      if(!is_null($request->fileNames)){
        if(!(self::USING_FILESTREAM)){
          $uploadedFiles = $request->file('files');

          for($i = 0 ; $i < Count($request->fileNames) ; $i++){

            if (!$uploadedFiles[$i]->isValid()) {
              Log::error("Fichier invalide : ", [
                  'error' => $uploadedFiles[$i]->getError(),
                  'nom' => $uploadedFiles[$i]->getClientOriginalName(),
                  'taille' => $uploadedFiles[$i]->getSize(),
                  'mime' => $uploadedFiles[$i]->getMimeType(),
              ]);
            }

            if (isset($request->fileNames[$i]) && $uploadedFiles[$i]->isValid()) {
              $fileNameWithoutExtension = $request->fileNames[$i];
              $fileName = $fileNameWithoutExtension.'.'.$uploadedFiles[$i]->extension();
              $path = 'uploads/suppliers/' . $supplier->id;
              $fullPath = storage_path('app/' . $path . '/' . $fileName);


              if (!file_exists(storage_path('app/' . $path))) {
                mkdir(storage_path('app/' . $path), 0777, true);
              }
              else if(file_exists($fullPath)){
                while (file_exists($fullPath)) {
                  $fileNameWithoutExtension = $fileNameWithoutExtension."_1";
                  $fileName = $fileNameWithoutExtension.'.'.$uploadedFiles[$i]->extension();
                  $fullPath = storage_path('app/' . $path . '/' . $fileName);
                }
              }

              try{
                $uploadedFiles[$i]->storeAs($path, $fileName);
              }
              catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $e){
                Log::error("Erreur lors du téléversement du fichier.", [$e]);
              }
            }

            $attachment = new Attachment();
            $attachment->name = $fileNameWithoutExtension;
            $attachment->type = $uploadedFiles[$i]->extension();
            $attachment->size = $request->fileSizes[$i];
            $attachment->deposit_date = $request->addedFileDates[$i];
            $attachment->supplier()->associate($supplier);
            $attachment->save();
          }
        }
      }

      $reussi=Auth::attempt(['email' => $request->email,'password' => $request->password]);
      if($reussi){
        $user = Auth::user();
        InscriptionSendMail($user);
        return redirect()->route('suppliers.show')->with('message',"Demande d'inscription envoyée");
      }
    }

    private function InscriptionSendMail(Supplier $supplier){
      $mailsController = new MailsController();
      $mailModel = EmailModel::where('name', 'inscription')->firstOrFail();
      $mailsController->sendMail($supplier, $mailModel);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
      if(Auth::user()){
        $supplier = Auth::user();

        $workSubcategories = WorkSubcategory::all();
        $provinces = Province::all();
        $modificationCategories = ModificationCategory::all();

        $supplierWithProductsCategories = $supplier->load('productsServices.categories');
        $suppliersGroupedByNatureAndCategory = $supplierWithProductsCategories->productsServices->groupBy(function ($product) {
          return $product->categories->nature;
        })->map(function ($groupedByNature) {
          return $groupedByNature->groupBy(function ($product) {
            return $product->categories->code;
          })->map(function ($groupedByCategory) {
            return [
              'category_name' => $groupedByCategory->first()->categories->name,
              'products' => $groupedByCategory
            ];
          });
        });
  
        $formattedPhoneNumbersContactDetails = $supplier->phoneNumbers->map(function ($phoneNumber) {
          return (object) [
            'id' => $phoneNumber->id,
            'type' => $phoneNumber->type,
            'number' => preg_replace('/(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/', '$1-$2-$3', $phoneNumber->number),
            'extension' => $phoneNumber->extension
          ];
        });
        $formattedPhoneNumbersContacts = $supplier->contacts->map(function ($contact) {
          $contact->formattedPhoneNumbers = $contact->phoneNumbers->map(function ($phoneNumber) {
              return (object) [
                  'type' => $phoneNumber->type,
                  'number' => preg_replace('/(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/', '$1-$2-$3', $phoneNumber->number),
                  'extension' => $phoneNumber->extension
              ];
          });
          return $contact;
        });

        $statusHistory = $supplier->statusHistories()->orderBy('created_at','asc')->get();
        $decryptedReasons = $statusHistory->map(function ($history){
          $deniedReason = "";
          if(!is_null($history->refusal_reason))
            $deniedReason = "";
          else
            $deniedReason = "";
          return(object)[
            'id' => $history->id,
            'status' => $history->status,
            'updated_by' => $history->updated_by,
            'refusal_reason' => $deniedReason,
            'supplier_id' => $history->supplier_id,
            'created_at' => $history->created_at,
            'updated_at' => null
          ];
        });
        $deniedStatus = $decryptedReasons->filter(function ($history) {
          return $history->status === 'denied';
        });
        $latestDeniedReason = $deniedStatus->sortByDesc('created_at')->first();
    
        $postalCode = $supplier->address->postal_code;
        $formattedPostalCode = substr($postalCode, 0, 3) . ' ' . substr($postalCode, 3);

        return View('suppliers.show', 
        compact('supplier', 'suppliersGroupedByNatureAndCategory', 'formattedPhoneNumbersContactDetails',
        'formattedPhoneNumbersContacts', 'decryptedReasons','latestDeniedReason', 'workSubcategories',
        'provinces','formattedPostalCode', 'modificationCategories'));
      }
      else
        return redirect()->route('suppliers.showLogin')->with('errorMessage',__('login.notConnected'));
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
   * Update identification of supplier.
   */
  public function updateIdentification(SupplierUpdateIdentificationRequest $request, Supplier $supplier)
  {
    $identification_category_id = 1;

    try{
      $status = $this->changeStatus($supplier, "modified");

      if($supplier->neq != $request->neq){
        $this->createAccountModificationLine($status, __('form.neqLabelShort'), [$supplier->neq], [$request->neq], $identification_category_id);
        $supplier->neq = $request->neq;
      }
      if($supplier->name != $request->name){
        $this->createAccountModificationLine($status, __('form.companyNameLabel'), [$supplier->name], [$request->name], $identification_category_id);
        $supplier->name = $request->name;
      }
      if($supplier->email != $request->email){
        $this->createAccountModificationLine($status, __('form.emailLabel'), [$supplier->email], [$request->email], $identification_category_id);
        $supplier->email = $request->email;
      }
      $supplier->save();

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdateContactDetails'))
      ->header('Location', route('suppliers.show', ['supplier' => $supplier->id]) . '#identification-section');
    }
    catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
        ->withErrors('message',__('global.updateFailed'));
    }
  }

  /**
   * Remove supplier.
   */
  public function removeFromList($id)
  {
    $supplier = Supplier::findOrFail($id);
    $this->changeStatus($supplier, "deactivated");

    $this->destroyAttachments($supplier);

    return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('message',__('show.removeFromListSuccess'));
  }

  /**
   * Reactivate supplier.
   */
  public function reactivate($id)
  {
    $supplier = Supplier::findOrFail($id);
    $this->changeStatus($supplier, $supplier->latestActivableStatus()->status);

    return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('message',__('show.reactivationSuccess'));
  }

  /**
   * Reactivate supplier.
   */
  private function destroyAttachments($supplier)
  {
    if(!(self::USING_FILESTREAM)){
      $directory = $supplier->id;
      $path = env('FILE_STORAGE_PATH'). "\\". $directory;

      Log::debug($path);
      if (file_exists($path)) {
        File::deleteDirectory($path);
      }
    }
    $supplier->attachments()->delete();
  }

  /**
   * Update contact details of supplier.
   */
  public function updateContactDetails(SupplierUpdateContactDetailsRequest $request, Supplier $supplier)
  {
    $contactDetails_category_id = 2;
    $removedPhoneNumbers = [];
    $addedPhoneNumbers = [];
    try{
      $status = $this->changeStatus($supplier, "modified");
      //Update Address
      if($supplier->address->civic_no != $request->contactDetailsCivicNumber){
        $this->createAccountModificationLine($status, __('form.civicNumberLabel'), [$supplier->address->civic_no], [$request->contactDetailsCivicNumber], $contactDetails_category_id);
        $supplier->address->civic_no = $request->contactDetailsCivicNumber;
      }
      if($supplier->address->street != $request->contactDetailsStreetName){
        $this->createAccountModificationLine($status, __('form.streetName'), [$supplier->address->street], [$request->contactDetailsStreetName], $contactDetails_category_id);
        $supplier->address->street = $request->contactDetailsStreetName;
      }
      if($supplier->address->office != $request->contactDetailsOfficeNumber){
        $this->createAccountModificationLine($status, __('form.officeNumber'), [$supplier->address->office], [$request->contactDetailsOfficeNumber], $contactDetails_category_id);
        $supplier->address->office = $request->contactDetailsOfficeNumber;
      }

      $postal_code = $request->contactDetailsPostalCode;
      $postal_code = str_replace(' ', '', $postal_code);
      $postal_code = strtoupper($postal_code);
      if($supplier->address->postal_code != $postal_code){
        $this->createAccountModificationLine($status, __('form.postalCode'), [$supplier->address->postal_code], [$postal_code], $contactDetails_category_id);
        $supplier->address->postal_code = $postal_code;
      }

      $province = Province::where('name', $request->contactDetailsProvince)->firstOrFail();
      if($supplier->address->province->id != $province->id){
        $this->createAccountModificationLine($status, __('form.province'), [$supplier->address->province->name], [$province->name], $contactDetails_category_id);
        $supplier->address->province()->associate($province);
      }

      if($request->contactDetailsProvince == "Québec"){
        if($supplier->address->city != $request->contactDetailsCitySelect){
          $this->createAccountModificationLine($status, __('form.city'), [$supplier->address->city], [$request->contactDetailsCitySelect], $contactDetails_category_id);
          $supplier->address->city = $request->contactDetailsCitySelect;
        }
      }
      else{
        if($supplier->address->city != $request->contactDetailsInputCity){
          $this->createAccountModificationLine($status, __('form.city'), [$supplier->address->city], [$request->contactDetailsInputCity], $contactDetails_category_id);
          $supplier->address->city = $request->contactDetailsInputCity;
        }
      }
      if($supplier->address->region != $request->contactDetailsDistrictArea){
        $this->createAccountModificationLine($status, __('form.districtArea'), [$supplier->address->region], [$request->contactDetailsDistrictArea], $contactDetails_category_id);
        $supplier->address->region = $request->contactDetailsDistrictArea;
      }

      if($supplier->site != $request->contactDetailsWebsite){
        $this->createAccountModificationLine($status, __('form.website'), [$supplier->site], [$request->contactDetailsWebsite], $contactDetails_category_id);
        $supplier->site = $request->contactDetailsWebsite;
      }
      $supplier->address->save();
      $supplier->save();
      
      //Update Phone numbers    
      $supplierExistingPhoneNumbers = $supplier->phoneNumbers->pluck('id')->toArray();
      $idsToDelete = array_diff($supplierExistingPhoneNumbers, $request->phoneNumberIds);
      foreach ($idsToDelete as $idToDelete) {
        $phoneNumber = PhoneNumber::findOrFail($idToDelete);
        $extension = "";
        if($phoneNumber->extension)
          $extension = " #".$phoneNumber->extension;
        array_push($removedPhoneNumbers, $phoneNumber->type.' '.preg_replace('/(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/', '$1-$2-$3', $phoneNumber->number).$extension);
      }
      PhoneNumber::whereIn('id', $idsToDelete)->delete();

      for($i = 0 ; $i < Count($request->phoneNumbers) ; $i++){
        if($request->phoneNumberIds[$i] == -1){
          $phoneNumber = new PhoneNumber();
          $phoneNumber->number = str_replace('-', '', $request->phoneNumbers[$i]);
          $phoneNumber->type = $request->phoneTypes[$i];
          $phoneNumber->extension = $request->phoneExtensions[$i];
          $phoneNumber->supplier()->associate($supplier->id);
          $phoneNumber->contact()->associate(null);
          $phoneNumber->save();

          $extension = "";
          if($phoneNumber->extension)
            $extension = " #".$phoneNumber->extension;
          array_push($addedPhoneNumbers, $request->phoneTypes[$i].' '.preg_replace('/(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/', '$1-$2-$3', $phoneNumber->number).$extension);
        }
      }

      if(Count($removedPhoneNumbers) > 0 || Count($addedPhoneNumbers) > 0)
        $this->createAccountModificationLine($status, __('form.phoneNumber'), $removedPhoneNumbers, $addedPhoneNumbers, $contactDetails_category_id);

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdateIdentification'))
      ->header('Location', route('suppliers.show', ['supplier' => $supplier->id]) . '#contactDetails-section');
    }
    catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->withErrors('message',__('global.updateFailed'));
    }
  }

  /**
   * Update contacts of supplier.
   */
  public function updateContacts(SupplierUpdateContactsRequest $request, Supplier $supplier)
  {
    $contacts_category_id = 3;
    try {
      $status = $this->changeStatus($supplier, "modified");

      foreach ($supplier->contacts as $contact) {
        if(!in_array($contact->id, $request->contactIds)){
          foreach ($contact->phoneNumbers as $phoneNumber) {
            $phoneNumber->delete();
          }
          $this->createAccountModificationLine($status, $contact->first_name.' '.$contact->last_name, [__('accountModification.deletion')], [], $contacts_category_id);
          $contact->delete();
        }
      }

      for($i = 0 ; $i < Count($request->contactFirstNames) ; $i++){
        $removedInformations = [];
        $addedInformations = [];

        if($request->contactIds[$i] != -1){
          $contact = Contact::findOrFail($request->contactIds[$i]);
        }
        else{
          $contact = new Contact();
        }
        
        if($contact->email != $request->contactEmails[$i]){
          array_push($removedInformations, $contact->email);
          array_push($addedInformations, $request->contactEmails[$i]);
          $contact->email = $request->contactEmails[$i];
        }
        if($contact->first_name != $request->contactFirstNames[$i]){
          array_push($removedInformations, $contact->first_name);
          array_push($addedInformations, $request->contactFirstNames[$i]);
          $contact->first_name = $request->contactFirstNames[$i];
        }
        if($contact->last_name != $request->contactLastNames[$i]){
          array_push($removedInformations, $contact->last_name);
          array_push($addedInformations, $request->contactLastNames[$i]);
          $contact->last_name = $request->contactLastNames[$i];
        }
        if($contact->job != $request->contactJobs[$i]){
          array_push($removedInformations, $contact->job);
          array_push($addedInformations, $request->contactJobs[$i]);
          $contact->job = $request->contactJobs[$i];
        }
        $contact->supplier()->associate($supplier);
        $contact->save();

        if($request->contactTelIdsA[$i] != -1){
          $phoneNumberA = PhoneNumber::findOrFail($request->contactTelIdsA[$i]);
        }
        else{
          $phoneNumberA = new PhoneNumber();
        }
        if($phoneNumberA->number != str_replace('-', '', $request->contactTelNumbersA[$i]) || 
            $phoneNumberA->extension != $request->contactTelExtensionsA[$i] || 
            $phoneNumberA->type != $request->contactTelTypesA[$i]
          )
        {
          if($phoneNumberA->number){
            $extension = "";
            if($phoneNumberA->extension)
              $extension = " #".$phoneNumberA->extension;
            array_push($removedInformations, $phoneNumberA->type.' '.preg_replace('/(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/', '$1-$2-$3', $phoneNumberA->number).$extension);
          }

          $phoneNumberA->number = str_replace('-', '', $request->contactTelNumbersA[$i]);
          $phoneNumberA->type = $request->contactTelTypesA[$i];
          $phoneNumberA->extension = $request->contactTelExtensionsA[$i];
          
          $extension = "";
          if($request->contactTelExtensionsA[$i])
            $extension = " #".$request->contactTelExtensionsA[$i];
          array_push($addedInformations, $request->contactTelTypesA[$i].' '.preg_replace('/(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/', '$1-$2-$3', str_replace('-', '', $request->contactTelNumbersA[$i])).$extension);
        }

        if($request->contactTelIdsA[$i] == -1){
          $phoneNumberA->supplier()->associate(null);
          $phoneNumberA->contact()->associate($contact);
        }
        $phoneNumberA->save();

        if(!is_null($request->contactTelNumbersB[$i])){
          if($request->contactTelIdsB[$i] != -1){
            $phoneNumberB = PhoneNumber::findOrFail($request->contactTelIdsB[$i]);
          }
          else{
            $phoneNumberB = new PhoneNumber();
          }
          
          if(
            $phoneNumberB->number != str_replace('-', '', $request->contactTelNumbersB[$i]) || 
            $phoneNumberB->extension != $request->contactTelExtensionsB[$i] || 
            $phoneNumberB->type != $request->contactTelTypesB[$i]
            )
          {
            if($phoneNumberB->number){
              $extension = "";
              if($phoneNumberB->extension)
                $extension = " #".$phoneNumberB->extension;
              array_push($removedInformations, $phoneNumberB->type.' '.preg_replace('/(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/', '$1-$2-$3', $phoneNumberB->number).$extension);
            }

            $phoneNumberB->number = str_replace('-', '', $request->contactTelNumbersB[$i]);
            $phoneNumberB->type = $request->contactTelTypesB[$i];
            $phoneNumberB->extension = $request->contactTelExtensionsB[$i];
            
            $extension = "";
            if($request->contactTelExtensionsB[$i])
              $extension = " #".$request->contactTelExtensionsB[$i];
            array_push($addedInformations, $request->contactTelTypesB[$i].' '.preg_replace('/(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/', '$1-$2-$3', str_replace('-', '', $request->contactTelNumbersB[$i])).$extension);
          }

          if($request->contactTelIdsB[$i] == -1){
            $phoneNumberB->supplier()->associate(null);
            $phoneNumberB->contact()->associate($contact);
          }
          $phoneNumberB->save();
        }
        else if(Count($contact->phoneNumbers) == 2){
          $extension = "";
          if($contact->phoneNumbers[1]->extension)
            $extension = " #".$contact->phoneNumbers[1]->extension;
          array_push($removedInformations, $contact->phoneNumbers[1]->type.' '.preg_replace('/(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/', '$1-$2-$3', $contact->phoneNumbers[1]->number).$extension);

          $contact->phoneNumbers[1]->delete();
        }
        if(Count($removedInformations) > 0 || Count($addedInformations) > 0)
          $this->createAccountModificationLine($status, $contact->first_name.' '.$contact->last_name, $removedInformations, $addedInformations, $contacts_category_id);
      }

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdateContact'))
      ->header('Location', route('suppliers.show', ['supplier' => $supplier->id]) . '#contacts-section');
      
    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('errorMessage',__('global.updateFailed'));
    }
  }

  /**
   * Update RBQ Licence of supplier.
   */
  public function updateRbq(SupplierUpdateRbqRequest $request, Supplier $supplier)
  {
    $licenceRbq_category_id = 5;
    $removedCategories = [];
    $addedCategories = [];

    try {
      $status = $this->changeStatus($supplier, "modified");

      $supplierRbqExisting = !is_null($supplier->rbqLicence);
      $requestRbqExisting = !is_null($request->licenceRbq);
  
      if($supplierRbqExisting && $requestRbqExisting){
        $licence = RbqLicence::findOrFail($supplier->rbqLicence->id);
        
        if($licence->number != $request->licenceRbq){
          $this->createAccountModificationLine($status, __('form.rbqLicenceSection'), [$licence->number], [$request->licenceRbq], $licenceRbq_category_id);
          $licence->number = $request->licenceRbq;
        }
        if($licence->status != $request->statusRbq){
          $this->createAccountModificationLine($status, __('form.statusLabel'), [$licence->status], [$request->statusRbq], $licenceRbq_category_id);
          $licence->status = $request->statusRbq;
        }
        if($licence->type != $request->typeRbq){
          $this->createAccountModificationLine($status, __('form.typeLabel'), [$licence->type], [$request->typeRbq], $licenceRbq_category_id);
          $licence->type = $request->typeRbq;
        }
        $licence->supplier()->associate($supplier);
        $licence->save();

        foreach ($supplier->workSubcategories as $rbqSubCategory) {
          if(!in_array($rbqSubCategory->code, $request->rbqSubcategories)){
            $categoryLabel = $rbqSubCategory->code.' '.$rbqSubCategory->name;
            array_push($removedCategories, $categoryLabel);

            $supplier->workSubcategories()->detach($rbqSubCategory->id);
          }
        }

        $supplierExistingCategories = $supplier->workSubcategories->pluck('code')->toArray();
        foreach ($request->rbqSubcategories as $rbqSubCategory) {
          if(!in_array($rbqSubCategory, $supplierExistingCategories)){
            $subCategory = WorkSubcategory::where('code', $rbqSubCategory)->firstOrFail();
            $supplier->workSubcategories()->attach($subCategory);
            
            $categoryLabel = $subCategory->code.' '.$subCategory->name;
            array_push($addedCategories, $categoryLabel);
          }
        }
      }
      else if(!$supplierRbqExisting && $requestRbqExisting){
        $licence = new RbqLicence();
        
        if($licence->number != $request->licenceRbq){
          $this->createAccountModificationLine($status, __('form.rbqLicenceSection'), [$licence->number], [$request->licenceRbq], $licenceRbq_category_id);
          $licence->number = $request->licenceRbq;
        }
        if($licence->status != $request->statusRbq){
          $this->createAccountModificationLine($status, __('form.statusLabel'), [$licence->status], [$request->statusRbq], $licenceRbq_category_id);
          $licence->status = $request->statusRbq;
        }
        if($licence->type != $request->typeRbq){
          $this->createAccountModificationLine($status, __('form.typeLabel'), [$licence->type], [$request->typeRbq], $licenceRbq_category_id);
          $licence->type = $request->typeRbq;
        }
        $licence->supplier()->associate($supplier);
        $licence->save();
  
        foreach($request->rbqSubcategories as $rbqSubCategory){
          $subCategory = WorkSubcategory::where('code', $rbqSubCategory)->firstOrFail();
          $supplier->workSubcategories()->attach($subCategory);
            
          $categoryLabel = $subCategory->code.' '.$subCategory->name;
          array_push($addedCategories, $categoryLabel);
        }
      }
      else if($supplierRbqExisting && !$requestRbqExisting){
        $licence = RbqLicence::findOrFail($supplier->rbqLicence->id);

        if($licence->number != $request->licenceRbq){
          $this->createAccountModificationLine($status, __('form.rbqLicenceSection'), [$licence->number], [null], $licenceRbq_category_id);
          $licence->number = $request->licenceRbq;
        }
        if($licence->status != $request->statusRbq){
          $this->createAccountModificationLine($status, __('form.statusLabel'), [$licence->status], [null], $licenceRbq_category_id);
          $licence->status = $request->statusRbq;
        }
        if($licence->type != $request->typeRbq){
          $this->createAccountModificationLine($status, __('form.typeLabel'), [$licence->type], [null], $licenceRbq_category_id);
          $licence->type = $request->typeRbq;
        }
        $licence->delete();

        foreach ($supplier->workSubcategories as $workSubcategory) {
          $categoryLabel = $workSubcategory->code.' '.$workSubcategory->name;
          array_push($removedCategories, $categoryLabel);
        }
        $supplier->workSubcategories()->sync([]);
      }
      
      if(Count($removedCategories) > 0 || Count($addedCategories) > 0)
        $this->createAccountModificationLine($status, __('accountModification.categories'), $removedCategories, $addedCategories, $licenceRbq_category_id);

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdateRbq'))
      ->header('Location', route('suppliers.show', ['supplier' => $supplier->id]) . '#licence-section');
      
    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('errorMessage',__('global.updateFailed'));
    }
  }

  /**
   * Update products and services of supplier.
   */
  public function updateProductsServices(Request $request, Supplier $supplier)
  {
    $productsServices_category_id = 4;

    try {
      $status = $this->changeStatus($supplier, "modified");

      if($supplier->product_service_detail != $request->product_service_detail){
        $this->createAccountModificationLine($status, __('form.productsAndServiceCategoriesDetails'), [$supplier->product_service_detail], [$request->product_service_detail], $productsServices_category_id);
        $supplier->product_service_detail = $request->product_service_detail;
      }
      $supplier->save();
      
      $removedProductsServices = [];
      $addedProductsServices = [];
      
      foreach ($supplier->productsServices as $productService) {
        if($request->filled('products_services')){
          if(!in_array($productService->code, $request->products_services)){
            $productServiceLabel = $productService->code.' '.$productService->description;
            array_push($removedProductsServices, $productServiceLabel);

            $supplier->productsServices()->detach($productService->code);
          }
        }
        else{
          foreach ($supplier->productsServices as $productService) {
            $productServiceLabel = $productService->code.' '.$productService->description;
            array_push($removedProductsServices, $productServiceLabel);
          }

          $supplier->productsServices()->detach();
        }
      }

      $supplierExistingProductsServices = $supplier->productsServices->pluck('code')->toArray();
      if($request->filled('products_services')){
        foreach ($request->products_services as $productServiceCode) {
          if(!in_array($productServiceCode, $supplierExistingProductsServices)){
            $productService = ProductService::where('code', $productServiceCode)->firstOrFail();
            $supplier->productsServices()->attach($productService);

            $productServiceLabel = $productService->code.' '.$productService->description;
            array_push($addedProductsServices, $productServiceLabel);
          }
        }
      }
      
      if(Count($removedProductsServices) > 0 || Count($addedProductsServices) > 0)
        $this->createAccountModificationLine($status, __('form.productsAndServiceServices'), $removedProductsServices, $addedProductsServices, $productsServices_category_id);

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdatePS'))
      ->header('Location', route('suppliers.show', ['supplier' => $supplier->id]) . '#productsServices-section');

    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('errorMessage',__('global.updateFailed'));
    }
  }

  /**
   * Update finance of supplier.
   */
  public function updateFinance(SupplierUpdateFinanceRequest $request, Supplier $supplier)
  {
    $finance_category_id = 7;
    try {
      $status = $this->changeStatus($supplier, "modified");

      if($supplier->tps_number != $request->financesTps){
        $this->createAccountModificationLine($status, __('form.tpsNumber'), [$supplier->tps_number], [$request->financesTps], $finance_category_id);
        $supplier->tps_number = $request->financesTps;
      }
      if($supplier->tvq_number != $request->financesTvq){
        $this->createAccountModificationLine($status, __('form.tvqNumber'), [$supplier->tvq_number], [$request->financesTvq], $finance_category_id);
        $supplier->tvq_number = $request->financesTvq;
      }
      if($supplier->payment_condition != $request->financesPaymentConditions){
        $supplierTradVariable = 'form.'.$supplier->payment_condition;
        $requestTradVariable = 'form.'.$request->financesPaymentConditions;
        $this->createAccountModificationLine($status, __('form.paymentConditions'), [__($supplierTradVariable)], [__($requestTradVariable)], $finance_category_id);
        $supplier->payment_condition = $request->financesPaymentConditions;
      }
      if($supplier->currency != $request->currency){
        $supplierTradVariable = $supplier->currency == 1 ? __('form.canadianCurrency') : __('form.usCurrency');
        $requestTradVariable = $request->currency == 1 ? __('form.canadianCurrency') : __('form.usCurrency');
        $this->createAccountModificationLine($status, __('form.currency'), [$supplierTradVariable], [$requestTradVariable], $finance_category_id);
        $supplier->currency = $request->currency;
      }
      if($supplier->communication_mode != $request->communication_mode){
        $supplierTradVariable = $supplier->communication_mode == 1 ? __('form.email') : __('form.mail');
        $requestTradVariable = $request->communication_mode == 1 ? __('form.email') : __('form.mail');
        $this->createAccountModificationLine($status, __('form.communication'), [$supplierTradVariable], [$requestTradVariable], $finance_category_id);
        $supplier->communication_mode = $request->communication_mode;
      }
      $supplier->save();

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdateFinance'))
      ->header('Location', route('suppliers.show', ['supplier' => $supplier->id]) . '#finances-section');

    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('errorMessage',__('global.updateFailed'));
    }
  }

  /**
   * Update attachments of supplier.
   */
  public function updateAttachments(SupplierUpdateAttachmentsRequest $request, Supplier $supplier)
  {
    Log::debug($request);
    try {
      if($request->filled('attachmentFilesIds')){
        $supplierExistingAttachments= $supplier->attachments->pluck('id')->toArray();
        $idsToDelete = array_diff($supplierExistingAttachments, $request->attachmentFilesIds);
        foreach ($idsToDelete as $id) {
          $attachment = Attachment::FindOrFail($id);
          $attachmentFullName = $attachment->name .".".$attachment->type;
          
          if(!(self::USING_FILESTREAM)){
            $directory = $supplier->id;
            $path = env('FILE_STORAGE_PATH'). "\\". $directory. "\\". $attachmentFullName;
            Log::debug($path);
            if (file_exists($path)) {
              File::delete($path);
            }
          }
        }
        Attachment::whereIn('id', $idsToDelete)->delete();

        for ($i=0; $i < Count($request->attachmentFilesIds) ; $i++) { 
          if($request->attachmentFilesIds[$i] == -1){
            $uploadedFile;
            $fileNameWithoutExtension = $request->fileNames[$i];
            foreach ($request->file('files') as $key => $file) {
              if(str_contains($file->getClientOriginalName(), $fileNameWithoutExtension)){
                $uploadedFile = $file;
              }
            }

            if (!$uploadedFile->isValid()) {
              Log::error("Fichier invalide : ", [
                  'error' => $uploadedFile->getError(),
                  'nom' => $uploadedFile->getClientOriginalName(),
                  'taille' => $uploadedFile->getSize(),
                  'mime' => $uploadedFile->getMimeType(),
              ]);
            }

            if (isset($request->fileNames[$i]) && $uploadedFile->isValid()) {
              $fileName = $fileNameWithoutExtension.'.'.$uploadedFile->extension();
              $path = 'uploads/suppliers/' . $supplier->name;
              $fullPath = storage_path('app/' . $path . '/' . $fileName);
  
  
              if (!file_exists(storage_path('app/' . $path))) {
                mkdir(storage_path('app/' . $path), 0777, true);
              }
              else if(file_exists($fullPath)){
                while (file_exists($fullPath)) {
                  $fileNameWithoutExtension = $fileNameWithoutExtension."_1";
                  $fileName = $fileNameWithoutExtension.'.'.$uploadedFile->extension();
                  $fullPath = storage_path('app/' . $path . '/' . $fileName);
                }
              }
  
              try{
                $uploadedFile->storeAs($path, $fileName);
              }
              catch(\Symfony\Component\HttpFoundation\File\Exception\FileException $e){
                Log::error("Erreur lors du téléversement du fichier.", [$e]);
              }
            }
  
            $attachment = new Attachment();
            $attachment->name = $fileNameWithoutExtension;
            $attachment->type = $uploadedFile->extension();
            $attachment->size = $request->fileSizes[$i];
            $attachment->deposit_date = $request->addedFileDates[$i];
            $attachment->supplier()->associate($supplier);
            $attachment->save();
          }
        }
      }
      else{
        $this->destroyAttachments($supplier);
      }

      $this->changeStatus($supplier, "modified");
      //Supprimer dans le dossier 

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdatePJ'))
      ->header('Location', route('suppliers.show', ['supplier' => $supplier->id]) . '#attachments-section');

    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('errorMessage',__('global.updateFailed'));
    }
  }

  /**
   * Update status of supplier.
   */
  private function changeStatus($supplier, $newStatus){
    $status = new StatusHistory();
    $status->status = $newStatus;
    $status->updated_by = auth()->user()->email;
    $status->created_at = Carbon::now('America/Toronto');
    $status->supplier()->associate($supplier);
    $status->save();
    return $status;
  }

  /**
   * Create an account modification line.
   */
  private function createAccountModificationLine(StatusHistory $status, ?string $changedAttribute, $deletionsInformations, $additionsInformations, int $categoryId){
    $accountModification = new AccountModification();
    if(!is_null($changedAttribute)){
      $accountModification->changed_attribute = $changedAttribute;
    }
    $accountModification->category_id = $categoryId;
    $accountModification->statusHistory()->associate($status);
    $accountModification->save();

    foreach ($deletionsInformations as $deletionInformation) {
      if(!is_null($deletionInformation)){
        $deletion = new ModificationDeletion();
        $deletion->deletion = $deletionInformation;
        $deletion->accountModification()->associate($accountModification);
        $deletion->save();
      }
    }
    foreach ($additionsInformations as $additionsInformation) {
      if(!is_null($additionsInformation)){
        $addition = new ModificationAddition();
        $addition->addition = $additionsInformation;
        $addition->accountModification()->associate($accountModification);
        $addition->save();
      }
    }
  }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

  public function checkEmail(Request $request)
  {
    $email = $request->email;
    $neq = $request->neq;
    $supplierId = $request->supplierId;
    $exists = Supplier::where('neq', $neq)
                        ->where('email', $email)
                        ->when($supplierId, function ($query, $supplierId) {
                          return $query->where('id', '!=', $supplierId);
                        })
                        ->exists();
    return response()->json(['exists' => $exists]);
  }

  public function checkNeq(Request $request)
  {
    $neq = $request->neq;
    $supplierId = $request->supplierId;
    $exists = Supplier::where('neq', $neq)
                        ->when($supplierId, function ($query, $supplierId) {
                          return $query->where('id', '!=', $supplierId);
                        })
                      ->exists();
    return response()->json(['exists' => $exists]);
  }
}
