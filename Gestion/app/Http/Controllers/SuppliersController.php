<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\StatusHistory;
use App\Models\Province;
use App\Models\WorkSubcategory;
use App\Models\ProductService;
use App\Models\Contact;
use App\Models\PhoneNumber;
use App\Models\RbqLicence;
use App\Models\EmailModel;
use App\Models\AccountModification;
use App\Models\ModificationCategory;
use App\Models\ModificationDeletion;
use App\Models\ModificationAddition;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\MailsController;

use App\Http\Requests\SupplierUpdateStatusRequest;
use App\Http\Requests\SupplierDenialRequest;
use App\Http\Requests\SupplierUpdateContactDetailsRequest;
use App\Http\Requests\SupplierUpdateContactsRequest;
use App\Http\Requests\SupplierUpdateIdentificationRequest;
use App\Http\Requests\SupplierUpdateRbqRequest;
use App\Http\Requests\SupplierUpdateFinanceRequest;

use Illuminate\Support\facades\Crypt;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Symfony\Component\ErrorHandler\Debug;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovalMail;
use App\Models\Attachment;

class SuppliersController extends Controller
{
  const SUPPLIER_FETCH_LIMIT = 100;
  const USING_FILESTREAM = false;
  const DAYS_BEFORE_TO_CHECK = 90;
  const USING_CRON = false;

  /**
   * Display a listing of the resource.
   */
  public function index()
  { 
    if(!self::USING_CRON)
      $this->toCheckRevision();
    
    $workSubcategories = WorkSubcategory::all();
    $productsServices = ProductService::paginate(self::SUPPLIER_FETCH_LIMIT);

    $suppliers = Supplier::select('id', 'name')
    ->with([
      'address' => function ($query) {
        $query->select('city', 'supplier_id');
      },
      'latestNonModifiedStatus' => function ($query) {
        $query->select('status', 'supplier_id');
      },
      'productsServices' => function ($query) {
        $query->select('code', 'supplier_id');
      },
      'workSubcategories' => function ($query) {
        $query->select('code', 'supplier_id');
      },
    ])
    ->whereHas('latestNonModifiedStatus', function ($query) {
      $query->where('status', '!=', 'deactivated');
    })
    ->withCount([
      'productsServices as productsServicesCount' => function ($query) use ($productsServices) {
        $selectedProductsServices = $productsServices->pluck('code')->toArray();
        $query->whereIn('code', $selectedProductsServices);
      },
      'workSubcategories as workSubcategoriesCount' => function ($query) use ($workSubcategories) {
        $selectedWorkSubcategories = $workSubcategories->pluck('code')->toArray();
        $query->whereIn('code', $selectedWorkSubcategories);
      }
    ])
    ->paginate(self::SUPPLIER_FETCH_LIMIT);


    $waitingSuppliersCount = Supplier::whereHas('statusHistories', function ($query) {
      $query->where('status', '!=', 'modified')
            ->where('status', 'waiting')
            ->whereRaw('created_at = (SELECT MAX(created_at)
                                      FROM status_histories
                                      WHERE supplier_id = suppliers.id
                                        AND status != "modified")');
    })->count();
    
    return View('suppliers.index', compact('suppliers','workSubcategories', 'productsServices', 'waitingSuppliersCount'));
  }

  public function selectedList(Request $request){
    if($request->filled('suppliers') && is_array($request->suppliers)){
      $suppliers = Supplier::whereIn('id', $request->suppliers)->get();
      return View('suppliers.selectedList', compact('suppliers'));
    }
    else{
      return redirect()->route('suppliers.index')->with('errorMessage',__('index.noSelection'));
    }
  }
  
  public function toCheckRevision()
  {
    Log::info("Mise à jours automatique des statuts.");
    $suppliersQuery = Supplier::query();
    $suppliers = $suppliersQuery->get()->filter(function ($supplier){
      return $supplier->latestNonModifiedStatus->status == 'denied';
    });
    foreach ($suppliers as $supplier) {
      if($supplier->latestNonModifiedStatus->created_at <= Carbon::now('America/Toronto')->subDays(self::DAYS_BEFORE_TO_CHECK)){
        $this->changeStatusBySystem($supplier, "toCheck");
      }
    }
  }

  public function filter(Request $request)
  {
      Log::debug($request);
      $suppliersQuery = Supplier::query()->select('id', 'name')
      ->with([
        'address' => function ($query) {
          $query->select('city', 'supplier_id');
        },
        'latestNonModifiedStatus' => function ($query) {
          $query->select('status', 'supplier_id');
        },
        'productsServices' => function ($query) {
          $query->select('code', 'supplier_id');
        },
        'workSubcategories' => function ($query) {
          $query->select('code', 'supplier_id');
        },
      ])
      ->withCount([
        'productsServices as productsServicesCount' => function ($query) use ($request) {
          if ($request->filled('produits_services') && is_array($request->produits_services)) {
            $query->whereIn('code', $request->produits_services);
          }
        },
        'workSubcategories as workSubcategoriesCount' => function ($query) use ($request) {
          if ($request->filled('workCategories') && is_array($request->workCategories)) {
            $query->whereIn('code', $request->workCategories);
          }
        }
      ]);

      if($request->filled('name')){
          $suppliersQuery->where('name', 'like',  '%' . $request->name .'%');
      }

      if ($request->filled('cities') && is_array($request->input('cities'))) {
          $suppliersQuery->whereHas('address', function($q) use($request){
              $q->whereIn('city', $request->cities);
          });
      }

      if ($request->filled('districtAreas') && is_array($request->input('districtAreas'))) {
          $suppliersQuery->whereHas('address', function($q) use($request){
              $q->whereIn('region', $request->districtAreas);
          });
      }

      if ($request->filled('workCategories') && is_array($request->input('workCategories'))) {
          $suppliersQuery->whereHas('workSubcategories', function($q) use($request){ 
              $q->whereIn('code', $request->workCategories);
          });
      }

      if ($request->filled('produits_services') && is_array($request->input('produits_services'))) {
          $suppliersQuery->whereHas('productsServices', function($q) use($request){
              $q->whereIn('code', $request->produits_services);
          });
      }

      if($request->filled('status') && is_array($request->input('status'))){
        $suppliersQuery->whereHas('statusHistories', function ($query) use ($request) {
          $query->where('status', '!=', 'modified')
                ->whereIn('status', $request->status)
                ->whereRaw('created_at = (SELECT MAX(created_at) 
                                          FROM status_histories 
                                          WHERE supplier_id = suppliers.id 
                                            AND status != "modified")');
        });
      }
      else{
        $suppliersQuery->whereHas('latestNonModifiedStatus', function ($query) {
          $query->where('status', '!=', 'deactivated');
        });
      }

      $suppliers = $suppliersQuery->paginate(self::SUPPLIER_FETCH_LIMIT);
      
      return response()->json([
          'html' => view('suppliers.components.supplierList', compact('suppliers'))->render(),
      ]);
  }

  public function waitingSuppliers(){
      $workSubcategories = WorkSubcategory::all();
      $productsServices = ProductService::paginate(self::SUPPLIER_FETCH_LIMIT);
      
      $suppliers = Supplier::select('id', 'name')
      ->with([
        'address' => function ($query) {
          $query->select('city', 'supplier_id');
        },
        'latestNonModifiedStatus' => function ($query) {
          $query->select('status', 'supplier_id');
        },
        'productsServices' => function ($query) {
          $query->select('code', 'supplier_id');
        },
        'workSubcategories' => function ($query) {
          $query->select('code', 'supplier_id');
        },
      ])
      ->whereHas('statusHistories', function ($query) {
        $query->where('status', '!=', 'modified')
              ->where('status', 'waiting')
              ->whereRaw('created_at = (SELECT MAX(created_at) 
                                        FROM status_histories 
                                        WHERE supplier_id = suppliers.id 
                                          AND status != "modified")');
      })
      ->withCount([
        'productsServices as productsServicesCount' => function ($query) use ($productsServices) {
          $selectedProductsServices = $productsServices->pluck('code')->toArray();
          $query->whereIn('code', $selectedProductsServices);
        },
        'workSubcategories as workSubcategoriesCount' => function ($query) use ($workSubcategories) {
          $selectedWorkSubcategories = $workSubcategories->pluck('code')->toArray();
          $query->whereIn('code', $selectedWorkSubcategories);
        }
      ])
      ->paginate(self::SUPPLIER_FETCH_LIMIT);

      return response()->json([
          'html' => view('suppliers.components.supplierList', compact('suppliers'))->render(),
      ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Supplier $supplier)
  {
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
        $deniedReason = trim(unserialize(Crypt::decryptString($history->refusal_reason)));
      else
        $deniedReason = "";
      return(object)[
        'id' => $history->id,
        'status' => $history->status,
        'updated_by' => $history->updated_by,
        'refusal_reason' => $deniedReason,
        'supplier_id' => $history->supplier_id,
        'created_at' => $history->created_at,
        'updated_at' => null,
        'accountModifications' => $history->accountModifications,
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
  
  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    
  }

  /**
   * Update status of supplier.
   */
  public function updateStatus(SupplierUpdateStatusRequest $request, Supplier $supplier, StatusHistory $statusHistory)
  {
    try {
      $user = Auth::user()->email;
      $statusHistory->status = $request->requestStatus;
      $statusHistory->updated_by = $user;
      if ($request->requestStatus === "denied" && !empty($request->deniedReasonText)) {
        $statusHistory->refusal_reason = Crypt::encrypt($request->deniedReasonText);
      }
      
      $statusHistory->supplier_id = $supplier->id;
      $statusHistory->created_at = Carbon::now('America/Toronto');
      $statusHistory->save();

      if ($request->requestStatus == "denied") {
        $this->destroyAttachments($supplier);
      }

      $this->verifyStatusAndSendMail($request->requestStatus, $supplier);

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdateStatus'));
    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
        ->withErrors('message',__('global.updateFailed'));
    }
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

  public function denyRequest(SupplierDenialRequest $request, Supplier $supplier)
  {
    $this->changeSupplierStatusWithReason($supplier, "denied", $request->deniedReason);

    $this->verifyStatusAndSendMail("denied", $supplier);

    return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('message',__('show.denialSuccess'));
  }

  public function approveRequest($id)
  {
    $supplier = Supplier::findOrFail($id);
    
    $this->verifyStatusAndSendMail("accepted", $supplier);

    $this->changeStatus($supplier, "accepted");
    return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('message',__('show.approvalSuccess'));
  }

  public function removeFromList($id)
  {
    $supplier = Supplier::findOrFail($id);
    $this->changeStatus($supplier, "deactivated");

    $this->destroyAttachments($supplier);

    return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('message',__('show.removeFromListSuccess'));
  }

  public function reactivate($id){
    $supplier = Supplier::findOrFail($id);
    if($supplier->latestActivableStatus()->status == "denied"){
      $refusal_reason = trim(unserialize(Crypt::decryptString($supplier->latestActivableStatus()->refusal_reason)));
      $this->changeSupplierStatusWithReason($supplier, $supplier->latestActivableStatus()->status, $refusal_reason);
    }
    else
      $this->changeStatus($supplier, $supplier->latestActivableStatus()->status);

    return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('message',__('show.reactivationSuccess'));
  }

  private function changeStatus($supplier, $newStatus){
    $status = new StatusHistory();
    $status->status = $newStatus;
    $status->updated_by = auth()->user()->email;
    $status->created_at = Carbon::now('America/Toronto');
    if($newStatus == "deactivated")
      $status->deactivated_by_admin = true;
    $status->supplier()->associate($supplier);
    $status->save();
    return $status;
  }
  private function changeSupplierStatusWithReason($supplier, $newStatus, $reason){
    $status = new StatusHistory();
    $status->status = $newStatus;
    $status->updated_by = auth()->user()->email;
    $status->created_at = Carbon::now('America/Toronto');
    $status->refusal_reason = Crypt::encrypt($reason);
    $status->supplier()->associate($supplier);
    $status->save();
  }
  private function changeStatusBySystem($supplier, $newStatus){
    $status = new StatusHistory();
    $status->status = $newStatus;
    $status->updated_by = __('global.system');
    $status->created_at = Carbon::now('America/Toronto');
    $this->verifyStatusAndSendMail($newStatus, $supplier);
    $status->supplier()->associate($supplier);
    $status->save();
    return $status;
  }

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
    //Log::debug($request);
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

  private function verifyStatusAndSendMail(string $status, Supplier $supplier){
    $mailsController = new MailsController();
    if($status == "accepted"){
      $mailModel = EmailModel::where('name', 'SupplierAccepted')->firstOrFail();
      $mailsController->sendStatusSupplierMail($supplier, $mailModel);
    }
    else if($status == "denied"){
      $mailModel = EmailModel::where('name', 'SupplierDenied')->firstOrFail();
      $mailsController->sendStatusSupplierMail($supplier, $mailModel);
    }
    else if($status == "waiting"){
      $mailModel = EmailModel::where('name', 'SupplierWaiting')->firstOrFail();
      $mailsController->sendStatusSupplierMail($supplier, $mailModel);
    }
    else if($status == "toCheck"){
      $mailModel = EmailModel::where('name', 'ResponsableToCheck')->firstOrFail();
      $mailsController->sendToCheckResponsableMail($supplier, $mailModel);
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
      
      if($request->filled('produits_services')){
        foreach ($supplier->productsServices as $productService) {
          if(!in_array($productService->code, $request->produits_services)){
            $productServiceLabel = $productService->code.' '.$productService->description;
            array_push($removedProductsServices, $productServiceLabel);

            $supplier->productsServices()->detach($productService->code);
          }
        }
      }
      else{
        foreach ($supplier->productsServices as $productService) {
          $productServiceLabel = $productService->code.' '.$productService->description;
          array_push($removedProductsServices, $productServiceLabel);
        }
        $supplier->productsServices()->detach();
      }
      
      $supplierExistingProductsServices = $supplier->productsServices->pluck('code')->toArray();
      if($request->filled('produits_services')){
        foreach ($request->produits_services as $productServiceCode) {
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
  public function updateAttachments(Request $request, Supplier $supplier)
  {
    $attachments_category_id = 6;
    $removedAttachments = [];
    $addedAttachments = [];

    try {
      $status = $this->changeStatus($supplier, "modified");

      if($request->filled('attachmentFilesIds')){
        $supplierExistingAttachments= $supplier->attachments->pluck('id')->toArray();
        $idsToDelete = array_diff($supplierExistingAttachments, $request->attachmentFilesIds);
        //foreach
        foreach ($idsToDelete as $id) {
          $attachment = Attachment::FindOrFail($id);
          $attachmentFullName = $attachment->name .".".$attachment->type;
          array_push($removedAttachments, $attachmentFullName);
          
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
      }
      else{
        foreach ($supplier->attachments as $attachment) {
          $attachmentFullName = $attachment->name.'.'.$attachment->type;
          array_push($removedAttachments, $attachmentFullName);
        }
        $this->destroyAttachments($supplier);
      }
      
      if(Count($removedAttachments) > 0 || Count($addedAttachments) > 0)
        $this->createAccountModificationLine($status, null, $removedAttachments, $addedAttachments, $attachments_category_id);

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdatePJ'))
      ->header('Location', route('suppliers.show', ['supplier' => $supplier->id]) . '#attachments-section');

    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('errorMessage',__('global.updateFailed'));
    }
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

  public function export(Request $request)
  {
    $suppliersIds = $request->input('supplierIds', []);
    $suppliers = Supplier::whereIn('id', $suppliersIds)->get();

    $selectedSupplierIds = $request->input('selectedSupplierIds', []);
    $selectedSupplierContactNames = $request->input('selectedSupplierContactNames', []);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->mergeCells('A1:C1');
    $sheet->setCellValue('A1', __('selectedSuppliersList.exportDate') . Carbon::now('America/Toronto')->format('d-m-Y'));

    $sheet->setCellValue('A2', __('form.lastNameLabel'));
    $sheet->setCellValue('B2', __('form.emailLabel'));
    $sheet->setCellValue('C2', __('form.neqLabelShort'));
    $sheet->setCellValue('D2', __('form.contactsSubtitle'));
    $sheet->setCellValue('E2', __('selectedSuppliersList.joined'));
    
    $row = 3;
    foreach ($suppliers as $supplier) {
      $sheet->setCellValue('A' . $row, $supplier->name);
      $sheet->setCellValue('B' . $row, $supplier->email);
      $sheet->setCellValue('C' . $row, $supplier->neq);

      foreach ($selectedSupplierIds as $key=>$selectedSupplierId) {
        if($supplier->id == $selectedSupplierId){
          $sheet->setCellValue('D' . $row, $selectedSupplierContactNames[$key]);
        }
      }
      
      $contacted = in_array($supplier->id, $selectedSupplierIds) ? __('global.yes') : __('global.no');
      $sheet->setCellValue('E' . $row, $contacted);

      $row++;
    }

    foreach (range('A', 'E') as $columnID) {
      $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    $fileName = 'fournisseurs_' . Carbon::now('America/Toronto')->format('Y-m-d_H-i-s') . '.xlsx';
    $temp_file = tempnam(sys_get_temp_dir(), $fileName);
    $writer = new Xlsx($spreadsheet);
    $writer->save($temp_file);

    return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
  }

  public function sendApprovalMail($supplierEmail){
    Log::debug($supplierEmail);
    $details = [
      'title' => 'Mail from Laravel',
      'body' => 'This is a test email.'
    ];
    Mail::to('fleurent.nicolas@hotmail.com')->send(new ApprovalMail($details));
    return "Email Sent!";
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
