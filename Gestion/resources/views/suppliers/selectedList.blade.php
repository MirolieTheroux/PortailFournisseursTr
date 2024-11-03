<!--//? NICE_TO_HAVE::Liste de fournisseurs sélectionné - sélectionner - exporter la liste des fournisseur en fichier excel-->

@extends('layouts.app')

@section('css')
@endsection

@section('content')
<form action="{{ route('suppliers.selectedList.export') }}" method="POST">
  @csrf
  <div class="container px-0 pt-3">
    <div class="d-flex w-100 justify-content-end">
      <button id="exportButton" type="submit" class="py-1 px-2 rounded button-darkblue">
        <div>{{__('selectedSuppliersList.exportList')}}</div>
      </button>
    </div>
  </div>
  @foreach ($suppliers as $supplier)
    <div class="container bg-white rounded my-3 p-3">
      <input type="hidden" name="supplierIds[]" value="{{ $supplier->id }}">
      <div class="row border-bottom border-dark mx-0 px-0">
        <div class="px-0 fw-bolder">{{$supplier->name}}</div>
      </div>
      <div class="row">
        <div class="col-5">
          <div>{{__('form.emailLabel')}} : {{$supplier->email}}</div>
          @foreach ($supplier->phoneNumbers as $phoneNumber)
            @php
              $phoneNumberFirstPart = substr($phoneNumber->number, 0, 3);
              $phoneNumberSecondPart = substr($phoneNumber->number, 3, 3);
              $phoneNumberLastPart = substr($phoneNumber->number, -4);
              $phoneNumberFormated = $phoneNumberFirstPart."-".$phoneNumberSecondPart."-".$phoneNumberLastPart
            @endphp
            <div class="d-flex flex-row mb-1">
              @switch($phoneNumber->type)
                @case(__('form.officeNumber'))
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-buildings-fill" viewBox="0 0 16 16">
                    <path d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zM2 11h1v1H2zm2 0h1v1H4zm-1 2v1H2v-1zm1 0h1v1H4zm9-10v1h-1V3zM8 5h1v1H8zm1 2v1H8V7zM8 9h1v1H8zm2 0h1v1h-1zm-1 2v1H8v-1zm1 0h1v1h-1zm3-2v1h-1V9zm-1 2h1v1h-1zm-2-4h1v1h-1zm3 0v1h-1V7zm-2-2v1h-1V5zm1 0h1v1h-1z"/>
                  </svg>
                  @break

                @case(__('form.cellphone'))
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-phone-fill" viewBox="0 0 16 16">
                    <path d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm6 11a1 1 0 1 0-2 0 1 1 0 0 0 2 0"/>
                  </svg>
                  @break

                @case(__('form.fax'))
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                    <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
                    <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                  </svg>
                  @break
              
                @default
                  
              @endswitch
              <div class="ms-2">{{$phoneNumberFormated}}</div>
              @if($phoneNumber->extension != null)
                <div class="ms-2">{{__('form.phoneExtension')}} : {{$phoneNumber->extension}}</div>
              @endif
            </div>
          @endforeach
        </div>
        <div class="col-5 d-flex flex-row justify-content-between">
          <div class="contactsList">
            @foreach ($supplier->contacts as $contact)
              <div class="contactContainer">
                <div class="contactName">{{$contact->first_name}} {{$contact->last_name}}, {{$contact->job}}</div>
                <div>{{__('form.emailLabel')}} : {{$contact->email}}</div>
                @foreach ($contact->phoneNumbers as $phoneNumber)
                  @php
                    $phoneNumberFirstPart = substr($phoneNumber->number, 0, 3);
                    $phoneNumberSecondPart = substr($phoneNumber->number, 3, 3);
                    $phoneNumberLastPart = substr($phoneNumber->number, -4);
                    $phoneNumberFormated = $phoneNumberFirstPart."-".$phoneNumberSecondPart."-".$phoneNumberLastPart
                  @endphp
                  <div class="d-flex flex-row mb-1">
                    @switch($phoneNumber->type)
                      @case(__('form.officeNumber'))
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-buildings-fill" viewBox="0 0 16 16">
                          <path d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zM2 11h1v1H2zm2 0h1v1H4zm-1 2v1H2v-1zm1 0h1v1H4zm9-10v1h-1V3zM8 5h1v1H8zm1 2v1H8V7zM8 9h1v1H8zm2 0h1v1h-1zm-1 2v1H8v-1zm1 0h1v1h-1zm3-2v1h-1V9zm-1 2h1v1h-1zm-2-4h1v1h-1zm3 0v1h-1V7zm-2-2v1h-1V5zm1 0h1v1h-1z"/>
                        </svg>
                        @break

                      @case(__('form.cellphone'))
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-phone-fill" viewBox="0 0 16 16">
                          <path d="M3 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2zm6 11a1 1 0 1 0-2 0 1 1 0 0 0 2 0"/>
                        </svg>
                        @break

                      @case(__('form.fax'))
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                          <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
                          <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                        </svg>
                        @break
                    
                      @default
                        
                    @endswitch
                    <div class="ms-2">{{$phoneNumberFormated}}</div>
                    @if($phoneNumber->extension != null)
                      <div class="ms-2">{{__('form.phoneExtension')}} : {{$phoneNumber->extension}}</div>
                    @endif
                  </div>
                @endforeach
              </div>
            @endforeach
          </div>
          <div class="d-flex flex-column justify-content-center">
            <button type="button" class="my-2 py-1 px-2 rounded button-darkblue contactchangeButton contactUpButtom">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
              </svg>
            </button>
            <button type="button" class="my-2 py-1 px-2 rounded button-darkblue contactchangeButton contactDownButtom">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1"/>
              </svg>
            </button>
          </div>
        </div>
        <div class="col-2 d-flex justify-content-center align-items-center">
          <button type="button" class="my-2 py-1 px-2 rounded button-darkblue contactedButton">
            <div>{{__('selectedSuppliersList.contacted')}}</div>
          </button>
        </div>
      </div>
    </div>
  @endforeach
</form>
@endsection

@section('scripts')
<script src="{{ asset('js/suppliersSelectedList/changeContact.js') }}"></script>
<script src="{{ asset('js/suppliersSelectedList/markContacted.js') }}"></script>
@endsection