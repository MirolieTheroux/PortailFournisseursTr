<!--//? NICE_TO_HAVE::Liste de fournisseurs sélectionné - sélectionner - exporter la liste des fournisseur en fichier excel-->

@extends('layouts.app')

@section('css')
@endsection

@section('content')
  @foreach ($suppliers as $supplier)
    <div class="container bg-white rounded my-3 p-3">
      <div class="row border-bottom border-dark mx-0 px-0">
        <div class="px-0 fw-bolder">{{$supplier->name}}</div>
      </div>
      <div class="row">
        <div class="col-4">
          <div>{{__('form.emailLabel')}} : {{$supplier->email}}</div>
          @foreach ($supplier->phoneNumbers as $phoneNumber)
            <div>{{$phoneNumber->type}} {{$phoneNumber->number}} {{$phoneNumber->extension}}</div>
          @endforeach
        </div>
        <div class="col-4 d-flex flex-row justify-content-between">
          <div class="contactsList">
            @foreach ($supplier->contacts as $contact)
              <div class="contactContainer">
                <div>{{$contact->first_name}} {{$contact->last_name}}, {{$contact->job}}</div>
                <div>{{__('form.emailLabel')}} : {{$contact->email}}</div>
                @foreach ($contact->phoneNumbers as $phoneNumber)
                  <div>{{$phoneNumber->type}} {{$phoneNumber->number}} {{$phoneNumber->extension}}</div>
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
        <div class="col-4">
          <div>Contacté</div>
        </div>
      </div>
    </div>
  @endforeach
@endsection

@section('scripts')
<script src="{{ asset('js/suppliersSelectedList/changeContact.js') }}"></script>
@endsection