@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/suppliers/show.css') }}">
@endsection

@section('title', 'Gestion - ' . $supplier->name)

@section('content')
<!--TODO::
 - Ajouter les boutons pour accepter/refuser (vue selon les rôles)
 - Voir pour remettre le code avec les erreurs pour les premières sections
 - Hauteur fixe ? La hauteur change selon la section du form
 - Quand une section est séléctionnée, mettre la section courante en bg vert.
 - Ajouter un hover pour montrer que les sections sont cliquables
 - Est-ce qu'on peut cacher les chants qui on juste rapport à la modif?
    - Le numéro de tel au dessus de la liste
    - Le input pour ajoute des fichiers
    - etc.
  - Si pas de contacts, voir pour afficher le form vide. (Lors de la demande, pas le choix de mettre un contact.)
-->
<div class="container-fluid h-100">
  <div class="row h-100">
    <div class="shadow-sm col-2 bg-white h-100 full-viewport sticky-under-navbar d-flex flex-column justify-content-between">
      <h5 class="text-center py-2 fw-bold">{{$supplier->name}}</h5>
      <div id="requestStatus-nav-button" class="text-center py-2">{{__('show.requestStatus')}}</div>
      <div id="identification-nav-button" class="text-center py-2">{{__('show.identification')}}</div>
      <div id="contactDetails-nav-button" class="text-center py-2">{{__('show.contactDetails')}}</div>
      <div id="contacts-nav-button" class="text-center py-2">{{__('show.contacts')}}</div>
      <div id="productsServices-nav-button" class="text-center py-2">{{__('show.productsAndServices')}}</div>
      <div id="licence-nav-button" class="text-center py-2">{{__('show.rqbLicence')}}</div>
      <div id="attachments-nav-button" class="text-center py-2">{{__('show.attachmentFiles')}}</div>
      <div id="finances-nav-button" class="text-center py-2">{{__('show.finance')}}</div>
    </div>

    <div class="col-10 h-100 px-4">
      <!--ETAT DEMANDE-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section" id="requestStatus-section">
        <div class="bg-white rounded my-2 form-section w-65">
          <div class="row py-2">
            <div class="offset-2 col-8 text-center">
              <h1>{{__('form.requestStatusTitle')}}</h1>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z" />
                <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z" />
                <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5" />
              </svg>
            </div>
          </div>
          <div class="px-3">
            <div class="row pb-3">
              <div class="col-6 text-center ">
                <div class="form-floating ">
                  <select name="requestStatus" id="requestStatus" class="form-select" aria-label="" disabled>
                    <option>{{__('form.status')}}</option>
                  </select>
                  <label for="requestStatus" id="">{{__('form.status')}}</label>
                </div>
              </div>
              <div class="col-6 text-center ">
                <div class="form-floating">
                  <input type="date" name="requestStatusCreatedDate" id="requestStatusCreatedDate" class="form-control" value="" placeholder="" disabled>
                  <label for="requestStatus" id="">{{__('form.requestResponseDate')}}</label>
                </div>
              </div>
            </div>
            <div class="row pb-3">
              <div class=" col-6 text-center">
                <div class="form-floating">
                  <input type="date" name="requestStatusCreatedDate" id="requestStatusCreatedDate" class="form-control" value="" placeholder="" disabled>
                  <label for="requestStatusCreatedDate" id="">{{__('form.requestCreatedDate')}}</label>
                </div>
              </div>
              <div class="col-6 text-center">
                <div class="form-floating">
                  <input type="date" name="requestLastModifiedDate" id="requestLastModifiedDate" class="form-control" value="" placeholder="" disabled>
                  <label for="requestLastModifiedDate" id="">{{__('form.requestLastModifiedDate')}}</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 d-flex justify-content-center mb-2">
                <button id="btnEditRequestStatus" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.edit')}}</button>
                <button id="btnSaveRequestStatus" type="submit" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.save')}}</button>
              </div>
            </div>
          </div>
        </div>
      </div><!--FIN ETAT DEMANDE-->
      <!--IDENTIFICATION-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="identification-section">
        <div class=" bg-white rounded my-2 form-section px-3 w-85">
          <div class="row">
            <div class="col-12 text-center">
              <h1>{{__('form.identificationTitle')}}</h1>
            </div>
          </div>
          <div class="row py-3">
            <div class="col-6 d-flex flex-column justify-content-between">
              <div class="d-flex flex-column justify-content-between h-100">
                <div class="text-start">
                  <div class="form-floating mb-3">
                    <input type="text" name="neq" id="neq" class="form-control" placeholder="" value="{{ $supplier->neq }}" maxlength="10" disabled>
                    <label for="neq">{{__('form.neqLabel')}}</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="text-start">
                <div class="form-floating mb-3">
                  <input type="text" name="name" id="name" class="form-control" placeholder="" value="{{ $supplier->name }}" maxlength="64" disabled>
                  <label for="name">{{__('form.companyNameLabel')}}</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row text-center">
            <div class="text-start">
              <div class="form-floating mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" value="{{ $supplier->email }}" maxlength="64" disabled>
                <label for="email">{{__('form.emailLabel')}}</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
              <button id="btnModifyId" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.edit')}}</button>
              <button id="btnSaveId" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.save')}}</button>
            </div>
          </div>
        </div>
      </div><!--FIN IDENTIFICATION-->
      <!--COORDONNÉES-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="contactDetails-section">
        <div class="bg-white rounded my-2 form-section px-3">
          <div class="row">
            <div class="col-12 text-center">
              <h1 class="section-title">{{__('form.contactDetailsTitle')}}</h1>
            </div>
          </div>
          <div class="row px-3">
            <div class="col-12 col-md-6 d-flex flex-column">
              <h2 class="text-center section-subtitle">{{__('form.contactDetailsAddressSection')}}</h2>
              <div class=" text-center d-flex flex-row pb-3">
                <div class="form-floating col-6 pe-2">
                  <input type="text" name="contactDetailsCivicNumber" id="contactDetailsCivicNumber" class="form-control" value="{{ $supplier->address->civic_no }}" placeholder="" maxlength="8" disabled>
                  <label for="contactDetailsCivicNumber" id="civicNumber">{{__('form.civicNumberLabel')}}</label>
                </div>
                <div class="form-floating col-6">
                  <input type="text" name="contactDetailsOfficeNumber" id="contactDetailsOfficeNumber" class="form-control" value="{{ $supplier->address->office }}" placeholder="" maxlength="8" disabled>
                  <label for="contactDetailsOfficeNumber" id="officeNumber">{{__('form.officeNumber')}}</label>
                </div>
              </div>
              <div class="text-center mb-4">
                <div class="form-floating">
                  <input type="text" name="contactDetailsStreetName" id="contactDetailsStreetName" class="form-control" value="{{ $supplier->address->street }}" placeholder="" maxlength="64" disabled>
                  <label for="contactDetailsStreetName">{{__('form.streetName')}}</label>
                </div>
              </div>
              <div class="d-flex flex-column justify-content-between h-100">
                <div class="text-center d-flex flex-row pb-3">
                  <div class="form-floating col-6 pe-2" id="div-city">
                    <select name="contactDetailsCitySelect" id="contactDetailsCitySelect" class="form-select" aria-label="" disabled>
                      <option>{{ $supplier->address->city }}</option>
                    </select>
                    <input type="text" name="contactDetailsInputCity" id="contactDetailsInputCity" class="form-control d-none" value="{{ $supplier->address->city }}" placeholder="" maxlength="64" disabled>
                    <label for="contactDetailsCitySelect">{{__('form.city')}}</label>
                  </div>
                  <div class="form-floating col-6">
                    <select name="contactDetailsProvince" id="contactDetailsProvince" class="form-select" aria-label="" disabled>
                      <option>{{ $supplier->address->province->name }}</option>
                    </select>
                    <label for="contactDetailsProvince">{{__('form.province')}}</label>
                  </div>
                </div>
                <div class="text-center d-flex flex-row mb-4">
                  <div class="form-floating col-8 pe-2">
                    <select name="contactDetailsDistrictArea" id="contactDetailsDistrictArea" class="form-select" aria-label="" disabled>
                      <option>{{ $supplier->address->region }}</option>
                    </select>
                    <label for="contactDetailsDistrictArea">{{__('form.districtArea')}}</label>
                  </div>
                  <div class="form-floating">
                    <input type="text" name="contactDetailsPostalCode" id="contactDetailsPostalCode" class="form-control" value="{{ $supplier->address->postal_code }}" placeholder="" maxlength="6" disabled>
                    <label for="contactDetailsPostalCode" id="postalCode">{{__('form.postalCode')}}</label>
                  </div>
                </div>
                <div class="text-center mb-4">
                  <div class="form-floating">
                    <input type="text" name="contactDetailsWebsite" id="contactDetailsWebsite" class="form-control" value="{{ $supplier->site }}" placeholder="" maxlength="64" disabled>
                    <label for="contactDetailsWebsite">{{__('form.website')}}</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 d-flex flex-column">
              <h2 class="text-center section-subtitle">{{__('form.contactDetailsPhoneNumbersSection')}}</h2>
              <div class="text-center d-flex flex-row pb-3 d-none">
                <div class="form-floating col-3">
                  <select name="contactDetailsPhoneType" id="contactDetailsPhoneType" class="form-select" aria-label="" disabled>
                    <option value="{{__('form.officeNumber')}}">{{__('form.officeNumber')}}</option>
                    <option value="{{__('form.fax')}}">{{__('form.fax')}}</option>
                    <option value="{{__('form.cellphone')}}">{{__('form.cellphone')}}</option>
                  </select>
                  <label for="contactDetailsPhoneType">{{__('form.typeLabel')}}</label>
                </div>
                <div class="form-floating col-5 px-2">
                  <input type="text" name="contactDetailsPhoneNumber" id="contactDetailsPhoneNumber" class="form-control" placeholder="" maxlength="12" disabled>
                  <label class="ms-2" for="contactDetailsPhoneNumber">{{__('form.numberLabel')}}</label>
                </div>
                <div class="form-floating col-3">
                  <input type="text" name="contactDetailsPhoneExtension" id="contactDetailsPhoneExtension" class="form-control" placeholder="" maxlength="6" disabled>
                  <label for="contactDetailsPhoneExtension">{{__('form.phoneExtension')}}</label>
                </div>
                <div class="col-1 d-flex align-items-center ">
                  <svg id="add-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="cursor: pointer; padding-left:10px">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                  </svg>
                </div>
              </div>
              <div class="form-floating h-100 pb-4" id="div-phoneNumberList">
                <div class="form-control pt-2 h-100  mb-4" id="contactDetailsPhoneNumberList" style="overflow-x: hidden; overflow-y: auto;">
                  <div class="fs-5 text-start title-border fw-bold" for="contactDetailsPhoneNumberList">{{__('form.phoneNumberList')}}</div>
                  <div class="row px-3">
                    <div class="d-flex justify-content-between mt-2">
                      <div class="col-2 fs-6">{{__('form.typeLabel')}}</div>
                      <div class="col-6 fs-6 text-center" id="phoneNumber">{{__('form.phoneNumber')}}</div>
                      <div class="col-2 fs-6 text-center">{{__('form.phoneExtension')}}</div>
                      <div class="col-2 "></div>
                    </div>
                    <div class="d-flex flex-column justify-content-between pt-3" id="phoneNumberList">
                      @foreach($supplier->phoneNumbers as $phoneNumber)
                      <div class="row mb-2 align-items-center justify-content-between divPhone">
                        <div class="col-2 text-start phoneType">{{ $phoneNumber->type }}</div>
                        <input class="d-none" name="phoneTypes[]" value="{{ $phoneNumber->type }}" />
                        <div class="col-6 text-center phoneNumber">{{ $phoneNumber->number }}</div>
                        <input class="d-none" name="phoneNumbers[]" value="{{ $phoneNumber->number }}" />
                        <div class="col-2 text-center phoneExtension">{{ $phoneNumber->extension }}</div>
                        <input class="d-none" name="phoneExtensions[]" value="{{ $phoneNumber->number }}" />
                        <div class="col-2 d-flex justify-content-center d-none">
                          <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-x removePhone" viewBox="0 0 16 16" style="cursor:pointer;">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                          </svg>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
              <button id="btnEditContactDetails" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.edit')}}</button>
              <button id="btnSaveContactDetails" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.save')}}</button>
            </div>
          </div>
        </div>
      </div><!--FIN COORDONNÉES-->
      <!--CONTACT-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="contacts-section">
        <div class=" bg-white rounded my-2 form-section w-100">
          <div class="row">
            <div class="col-8 col-md-10 offset-2 offset-md-1 text-center">
              <h1 class="section-title">{{__('form.contactsTitle')}}</h1>
            </div>
            <div class="col-2 col-md-1 d-flex align-items-center justify-content-center d-none">
              <button type="button" class="add-contact p-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                </svg>
              </button>
            </div>
          </div>

          <div id="contactsRow" class="row justify-content-center px-3">
            @if(!is_null(old('contactFirstNames')))
            @foreach(old('contactFirstNames') as $contactFirstName)
            <div id="referenceContact" class="col-12 col-lg-6 d-flex flex-column justify-content-between mb-2">
              <div class="rounded px-3 border">
                <div class="row">
                  <h2 id="contactSubtitle1" class="col-11 text-start section-subtitle">{{__('form.contactsSubtitle')}}</h2>
                  <button type="button" class="col-1 text-end delete-contact p-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                    </svg>
                  </button>
                </div>
                <div class="row">
                  <div class="col-12 col-lg-6 text-center mb-4">
                    <div class="form-floating">
                      <input type="text" name="contactFirstNames[]" id="contactFirstName1" class="form-control contact-input contact-name-input" placeholder="" maxlength="32" value="">
                      <label id="contactFirstNameLabel1" for="contactFirstName1">{{__('form.firstNameLabel')}}</label>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 text-center mb-4">
                    <div class="form-floating">
                      <input type="text" name="contactLastNames[]" id="contactLastName1" class="form-control contact-input contact-name-input" placeholder="" maxlength="32" value="">
                      <label id="contactLastNameLabel1" for="contactLastName1">{{__('form.lastNameLabel')}}</label>
                    </div>
                  </div>
                </div>
                <div class="text-center mb-4">
                  <div class="form-floating">
                    <input type="text" name="contactJobs[]" id="contactJob1" class="form-control contact-input contact-job-input" placeholder="" maxlength="32" value="">
                    <label id="contactJobLabel1" for="contactJob1">{{__('form.jobLabel')}}</label>
                  </div>
                </div>
                <div class="text-center mb-4">
                  <div class="form-floating">
                    <input type="text" name="contactEmails[]" id="contactEmail1" class="form-control contact-input contact-email-input" placeholder="" maxlength="64" value="">
                    <label id="contactEmailLabel1" for="contactEmail1">{{__('form.emailLabel')}}</label>
                  </div>
                </div>
                <h2 class="text-center section-subtitle">{{__('form.contactDetailsPhoneNumbersSection')}}</h2>
                <div class="mb-4">
                  <div class="text-center d-flex flex-column flex-md-row mb-0">
                    <div class="form-floating col-12 col-md-3">
                      <select name="contactTelTypesA[]" id="contactTelTypeA1" class="form-select" aria-label="" value="">
                        <option value="desktop">{{__('form.officeNumber')}}</option>
                        <option value="fax">{{__('form.fax')}}</option>
                        <option value="cellphone">{{__('form.cellphone')}}</option>
                      </select>
                      <label id="contactTelTypeLabelA1" for="contactTelTypeA1">{{__('form.typeLabel')}}</label>
                    </div>
                    <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                      <input type="text" name="contactTelNumbersA[]" id="contactTelNumberA1" class="form-control" placeholder="" maxlength="10" value="">
                      <label id="contactTelNumberLabelA1" class="my-4 my-md-0 ms-md-2" for="contactTelNumberA1">{{__('form.numberLabel')}}</label>
                    </div>
                    <div class="form-floating col-12 col-md-3">
                      <input type="text" name="contactTelExtensionsA[]" id="contactTelExtensionA1" class="form-control" placeholder="" maxlength="6" value="">
                      <label id="contactTelExtensionLabelA1" for="contactTelExtensionA1">{{__('form.phoneExtension')}}</label>
                    </div>
                  </div>

                </div>
                <h2 class="text-center section-subtitle d-md-none">{{__('form.phoneNumber')}}</h2>
                <div class="mb-4">
                  <div class="text-center d-flex flex-column flex-md-row mb-0">
                    <div class="form-floating col-12 col-md-3">
                      <select name="contactTelTypesB[]" id="contactTelTypeB1" class="form-select" aria-label="" value="">
                        <option value="desktop">{{__('form.officeNumber')}}</option>
                        <option value="fax">{{__('form.fax')}}</option>
                        <option value="cellphone">{{__('form.cellphone')}}</option>
                      </select>
                      <label id="contactTelTypeLabelB1" for="contactTelTypeB1">{{__('form.typeLabel')}}</label>
                    </div>
                    <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                      <input type="text" name="contactTelNumbersB[]" id="contactTelNumberB1" class="form-control" placeholder="" maxlength="10" value="">
                      <label id="contactTelNumberLabelB1" class="my-4 my-md-0 ms-md-2" for="contactTelNumberB1">{{__('form.numberLabel')}}</label>
                    </div>
                    <div class="form-floating col-12 col-md-3">
                      <input type="text" name="contactTelExtensionsB[]" id="contactTelExtensionB1" class="form-control" placeholder="" maxlength="6" value="">
                      <label id="contactTelExtensionLabelB1" for="contactTelExtensionB1">{{__('form.phoneExtension')}}</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            @else
            <div id="referenceContact" class="d-flex flex-row justify-content-between mb-2 pe-3">
              <!-- <div class="row">
              </div> -->
              @foreach ($supplier->contacts as $contact)
              <div class="rounded pt-1 px-3 border ms-2">
                <div class="row">
                  <h2 id="contactSubtitle1" class="col-11 text-start section-subtitle">{{__('form.contactsSubtitle')}}</h2>
                  <button type="button" class="col-1 text-end delete-contact p-0 d-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                    </svg>
                  </button>
                </div>
                <div class="row">
                  <div class="col-12 col-lg-6 text-center mb-4">
                    <div class="form-floating">
                      <input type="text" name="contactFirstNames[]" id="contactFirstName1" class="form-control contact-input contact-name-input" placeholder="" maxlength="32" value="{{ $contact->first_name}}" disabled>
                      <label id="contactFirstNameLabel1" for="contactFirstName1">{{__('form.firstNameLabel')}}</label>
                      <div class="text-start invalid-feedback nameInvalidRequired" style="display: none;">{{__('form.contactsFirstNamesValidationRequired')}}</div>
                      <div class="text-start invalid-feedback nameInvalidSymbols" style="display: none;">{{__('form.contactsNamesValidationSymbols')}}</div>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 text-center mb-4">
                    <div class="form-floating">
                      <input type="text" name="contactLastNames[]" id="contactLastName1" class="form-control contact-input contact-name-input" placeholder="" maxlength="32" value="{{ $contact->last_name }}" disabled>
                      <label id="contactLastNameLabel1" for="contactLastName1">{{__('form.lastNameLabel')}}</label>
                      <div class="text-start invalid-feedback nameInvalidRequired" style="display: none;">{{__('form.contactsLastNamesValidationRequired')}}</div>
                      <div class="text-start invalid-feedback nameInvalidSymbols" style="display: none;">{{__('form.contactsNamesValidationSymbols')}}</div>
                    </div>
                  </div>
                </div>
                <div class="text-center mb-4">
                  <div class="form-floating">
                    <input type="text" name="contactJobs[]" id="contactJob1" class="form-control contact-input contact-job-input" placeholder="" maxlength="32" value="{{ $contact->job }}" disabled>
                    <label id="contactJobLabel1" for="contactJob1">{{__('form.jobLabel')}}</label>
                    <div class="text-start valid-feedback jobValid" style="display: none;"></br></div>
                    <div class="text-start invalid-feedback jobInvalidRequired" style="display: none;">{{__('form.contactsJobsValidationRequired')}}</div>
                  </div>
                </div>
                <div class="text-center mb-4">
                  <div class="form-floating">
                    <input type="text" name="contactEmails[]" id="contactEmail1" class="form-control contact-input contact-email-input" placeholder="" maxlength="64" value="{{ $contact->email }}" disabled>
                    <label id="contactEmailLabel1" for="contactEmail1">{{__('form.emailLabel')}}</label>
                    <div class="text-start invalid-feedback emailInvalidRequired" style="display: none;">{{__('form.contactsEmailsValidationRequired')}}</div>
                    <div class="text-start invalid-feedback emailInvalidFormat" style="display: none;">{{__('form.contactsEmailsValidationFormat')}}</div>
                  </div>
                </div>

                <h2 class="text-center section-subtitle">{{__('form.phoneNumber')}}</h2>
                @foreach ($contact->phoneNumbers as $contactPhoneNumber)
                <div class="d-flex flex-column mb-4 phone-container">
                  <div class="text-center d-flex flex-column flex-md-row flew-mb-wrap">
                    <div class="form-floating col-12 col-md-3">
                      <select name="contactTelTypesA[]" id="contactTelTypeA1" class="form-select" aria-label="" disabled>
                        <option value="desktop">{{ $contactPhoneNumber->type }}</option>
                      </select>
                      <label id="contactTelTypeLabelA1" for="contactTelTypeA1">{{__('form.typeLabel')}}</label>
                    </div>
                    <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                      <input type="text" name="contactTelNumbersA[]" id="contactTelNumberA1" class="form-control contact-input contact-primary-phone-input" placeholder="" maxlength="10" value="{{ $contactPhoneNumber->number }}" disabled>
                      <label id="contactTelNumberLabelA1" class="my-4 my-md-0 ms-md-2" for="contactTelNumberA1">{{__('form.numberLabel')}}</label>
                    </div>
                    <div class="form-floating col-12 col-md-3">
                      <input type="text" name="contactTelExtensionsA[]" id="contactTelExtensionA1" class="form-control contact-input contact-extension-input" placeholder="" maxlength="6" value="{{ $contactPhoneNumber->extension }}" disabled>
                      <label id="contactTelExtensionLabelA1" for="contactTelExtensionA1">{{__('form.phoneExtension')}}</label>
                    </div>
                  </div>
                  <div class="text-start invalid-feedback phoneInvalidRequired" style="display: none;">{{__('form.contactsTelNumberValidationRequired')}}</div>
                  <div class="text-start invalid-feedback phoneInvalidNumber" style="display: none;">{{__('form.contactsTelNumberValidation')}}</div>
                  <div class="text-start invalid-feedback phoneInvalidSize" style="display: none;">{{__('form.contactsTelNumberValidationSize')}}</div>
                  <div class="text-start invalid-feedback phoneInvalidExtension" style="display: none;">{{__('form.contactsTelExtensionValidation')}}</div>
                </div>
                @endforeach
                <!-- <h2 class="text-center section-subtitle d-md-none">{{__('form.phoneNumber')}}</h2>
                <div class="d-flex flex-column mb-4 phone-container">
                  <div class="text-center d-flex flex-column flex-md-row">
                    <div class="form-floating col-12 col-md-3">
                      <select name="contactTelTypesB[]" id="contactTelTypeB1" class="form-select" aria-label="">
                        <option value="desktop">{{__('form.officeNumber')}}</option>
                        <option value="fax">{{__('form.fax')}}</option>
                        <option value="cellphone">{{__('form.cellphone')}}</option>
                      </select>
                      <label id="contactTelTypeLabelB1" for="contactTelTypeB1">{{__('form.typeLabel')}}</label>
                    </div>
                    <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                      <input type="text" name="contactTelNumbersB[]" id="contactTelNumberB1" class="form-control contact-input contact-secondary-phone-input" placeholder="" maxlength="10">
                      <label id="contactTelNumberLabelB1" class="my-4 my-md-0 ms-md-2" for="contactTelNumberB1">{{__('form.numberLabel')}}</label>
                    </div>
                    <div class="form-floating col-12 col-md-3">
                      <input type="text" name="contactTelExtensionsB[]" id="contactTelExtensionB1" class="form-control contact-input contact-extension-input" placeholder="" maxlength="6">
                      <label id="contactTelExtensionLabelB1" for="contactTelExtensionB1">{{__('form.phoneExtension')}}</label>
                    </div>
                  </div>
                  <div class="text-start invalid-feedback phoneInvalidNumber" style="display: none;">{{__('form.contactsTelNumberValidation')}}</div>
                  <div class="text-start invalid-feedback phoneInvalidSize" style="display: none;">{{__('form.contactsTelNumberValidationSize')}}</div>
                  <div class="text-start invalid-feedback phoneInvalidExtension" style="display: none;">{{__('form.contactsTelExtensionValidation')}}</div>
                </div> -->
              </div>
              @endforeach
            </div>
            @endif
          </div>
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
              <button id="btnEditContacts" type="button" class="m-2 py-1 px-3 rounded button-darkblue button-darkblue">{{__('global.edit')}}</button>
              <button id="btnSaveContacts" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.save')}}</button>
            </div>
          </div>
        </div>
      </div> <!--FIN CONTACT-->
      <!--PRODUITS ET SERVICES-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="productsServices-section">
        <div class=" bg-white rounded my-2 w-100 form-section">
          <div class="row">
            <div class="col-12 text-center">
              <h1 class="section-title">{{__('form.productsAndServiceTitle')}}</h1>
            </div>
          </div>
          <div class="flex-row d-flex justify-content-center px-3">
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between d-none">
              <h2 class="text-center section-subtitle">{{__('form.productsAndServiceServices')}}</h2>
              <div class="text-center">
                <div class="form-floating mb-3">
                  <input type="text" id="service-search" class="form-control" placeholder="">
                  <label for="service-search">{{__('form.productsAndServiceCategoriesSearch')}}</label>
                </div>
              </div>
              <div>
                <div class="form-floating">
                  <div class="form-control" placeholder="details" id="products-categories" style="height: 232px; overflow-x: hidden; overflow-y: auto;">
                    <div class="mt-lg-0 mt-md-4" id="service-list">
                    </div>
                  </div>
                  <label for="products-categories" class="labelbackground">{{__('form.productsAndServiceServicesCategorySelection')}}</label>
                  <div class="note" id="results-count"><br></div>
                </div>
              </div>
            </div>
            <div class="col-6 me-2">
              <h2 class="text-center section-subtitle">{{__('form.productsAndServiceSelectedServicesList')}}</h2>
              <div>
                <div class="form-floating">
                  <div class="form-control" placeholder="selected" id="products-selected" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
                    <div class="mt-lg-0 mt-md-4" id="service-selected">

                      @foreach ($suppliersGroupedByNatureAndCategory as $nature => $categories)
                      <div class="row pb-3">
                        <h6 class="mb-3 fw-bold">{{ $nature }}</h6>
                        @foreach ($categories as $categoryCode => $categoryData)
                        <div class="row">
                          <h6 class="fst-italic"> {{ $categoryCode }} - {{ $categoryData['category_name'] }}</h6>
                          @foreach ($categoryData['products'] as $product)
                          <div class="col-4">
                            {{ $product->code }}
                          </div>
                          <div class="col-8">
                            {{ $product->description }}
                          </div>
                          @endforeach
                        </div>
                        @endforeach
                      </div>
                      @endforeach
                    </div>
                  </div>
                  <!-- <label for="products-selected" class="labelbackground">{{__('form.productsAndServiceServicesCategorySelected')}}</label> -->
                  <div class="note"><br></div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <h2 class="text-center section-subtitle">{{__('form.productsAndServiceCategoriesDetails')}}</h2>
              <div class="text-center">
                <div class="form-floating">
                  <textarea class="form-control" name="product_service_detail" placeholder="details" id="products-details" style="height: 308px; resize: none;" maxlength="500" disabled>{{ $supplier->product_service_detail }}</textarea>
                  <!-- <label for="products-details" class="labelbackground"></label> -->
                  <div class="note"><br></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
              <button id="btnEditProductsServices" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.edit')}}</button>
              <button id="btnSaveProductsServices" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.save')}}</button>
            </div>
          </div>
        </div>
      </div><!--FIN PRODUITS ET SERVICES-->
      <!--LICENCE RBQ-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="licence-section">
        <div class=" bg-white rounded my-2 form-section">
          <div class="row">
            <div class="col-12 text-center">
              <h1>{{__('form.rbqTitle')}}</h1>
            </div>
          </div>
          <div class="row px-3">
            <div class="col-12 col-md-4 d-flex flex-column">
              <h2 class="text-center">{{__('form.rbqLicenceSection')}}</h2>
              <div class="d-flex flex-column justify-content-between h-100">
                <div class="text-center">
                  <div class="form-floating mb-3">
                    <input type="text" name="licenceRbq" id="licenceRbq" value="{{ $supplier->rbqLicence->number }}" class="form-control" placeholder="" maxlength="10" disabled>
                    <label for="licenceRbq">{{__('form.numberLabel')}}</label>
                  </div>
                </div>
                <div class="text-center">
                  <div class="form-floating mb-3">
                    <select name="statusRbq" id="statusRbq" class="form-select" aria-label="" disabled>
                    <option value="valid" {{ "valid" == $supplier->rbqLicence->status ? 'selected' : null }}>{{__('form.choiceValid')}}</option>
                      <option value="restrictedValid" {{ "restrictedValid" == $supplier->rbqLicence->status  ? 'selected' : null }}>{{__('form.choiceRestrictedValid')}}</option>
                      <option value="invalid" {{ "invalid" == $supplier->rbqLicence->status  ? 'selected' : null }}>{{__('form.choiceInvalid')}}</option>
                    </select>
                    <label for="statusRbq">{{__('form.statusLabel')}}</label>
                  </div>
                </div>
                <div class="text-center">
                  <div class="form-floating mb-3">
                    <select name="typeRbq" id="typeRbq" class="form-select" aria-label="" disabled>
                    <option disabled selected value>{{__('form.choiceDefaultType')}}</option>
                      <option value="entrepreneur" {{ "entrepreneur" == $supplier->rbqLicence->type ? 'selected' : null }}>{{__('form.choiceEntrepreneur')}}</option>
                      <option value="ownerBuilder" {{ "ownerBuilder" == $supplier->rbqLicence->type ? 'selected' : null }}>{{__('form.choiceOwnerBuilder')}}</option>
                    </select>
                    <label for="typeRbq">{{__('form.typeLabel')}}</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-8 d-flex flex-column justify-content-start">
              <h2 class="text-center">{{__('form.rbqCategoriesSection')}}</h2>
              <div class="text-center">
                <div class="form-floating mb-3">
                  <div id="subcategories-container" class="form-control pt-2" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
                    <div id="no-categories" class="d-block">
                      {{__('form.rbqCategoriesUnselectedType')}}
                    </div>
                    <div id="entrepreneur-categories" class="d-none">
                      <div class="fs-5 text-start fw-bold mb-2 title-border">{{__('form.rbqCategoriesGeneralEntrepreneur')}}</div>
                      <div class="form-check pb-2">
                        <input
                          class="form-check-input mt-0 rbq-subcategories-check"
                          type="checkbox"
                          name="rbqSubcategories[]"
                          value="">
                        <div class="d-flex">
                          <label class="form-check-label text-start rbq-category-label-number" for="">
                          </label>
                          <label class="form-check-label text-start ps-2" for="">
                          </label>
                        </div>
                      </div>

                      <div class="fs-5 text-start fw-bold mb-2 title-border">{{__('form.rbqCategoriesSpecialisedEntrepreneur')}}</div>
                      <div class="form-check pb-2">
                        <input
                          class="form-check-input mt-0 rbq-subcategories-check"
                          type="checkbox"
                          name="rbqSubcategories[]"
                          value="">
                        <div class="d-flex">
                          <label class="form-check-label text-start rbq-category-label-number" for="">
                          </label>
                          <label class="form-check-label text-start ps-2" for="">
                          </label>
                        </div>
                      </div>
                    </div>

                    <div id="ownerBuilder-categories" class="d-none">
                      <div class="fs-5 text-start fw-bold mb-2 title-border">{{__('form.rbqCategoriesGeneralOwnerBuilder')}}</div>
                      <div class="form-check pb-2">
                        <input
                          class="form-check-input mt-0 rbq-subcategories-check"
                          type="checkbox"
                          name="rbqSubcategories[]"
                          value="">
                        <div class="d-flex">
                          <label class="form-check-label text-start rbq-category-label-number" for="">
                          </label>
                          <label class="form-check-label text-start ps-2" for="">
                          </label>
                        </div>
                      </div>

                      <div class="fs-5 text-start fw-bold mb-2 title-border">{{__('form.rbqCategoriesSpecialisedOwnerBuilder')}}</div>
                      <div class="form-check pb-2">
                        <input
                          class="form-check-input mt-0 rbq-subcategories-check"
                          type="checkbox"
                          name="rbqSubcategories[]"
                          value="">
                        <div class="d-flex">
                          <label class="form-check-label text-start rbq-category-label-number" for="">
                          </label>
                          <label class="form-check-label text-start ps-2" for="">
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
              <button id="btnEditRbq" type="button" class="m-2 py-1 px-3 rounded  button-darkblue">{{__('global.edit')}}</button>
              <button id="btnSaveRbq" type="button" class="m-2 py-1 px-3 rounded button-darkblue ">{{__('global.save')}}</button>
            </div>
          </div>
        </div>
      </div><!--FIN LICENCE RBQ-->
      <!--PIÈCES JOINTES-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="attachments-section">
        <div class=" bg-white rounded my-2 form-section">
          <div class="row">
            <div class="col-12 text-center">
              <h1>{{__('form.attachmentFilesTitle')}}</h1>
            </div>
          </div>
          <div class="row px-3 mb-3">
            <div class="col-12 d-flex flex-column justify-content-between mb-3">
              <h2 class="text-center section-subtitle">{{__('form.attachmentFilesSection')}}</h2>
            </div>
            <div class=" col-12 d-flex flex-column justify-content-between">
              <div class="row flex-row justify-content-between">
                <div class="col-10">
                  <div>
                    <input class="form-control" type="file" id="formFile" disabled>
                  </div>
                  <div class="text-start invalid-feedback attachment" id="attachmentFileRequired" style="display: none;">{{__('form.attachmentFileRequired')}}</div>
                  <div class="text-start invalid-feedback attachment" id="attachmentFileNameLength" style="display: none;">{{__('form.attachmentFileNameLength')}}</div>
                  <div class="text-start invalid-feedback attachment" id="attachmentFileNameAlphaNum" style="display: none;">{{__('form.attachmentFileNameAlphaNum')}}</div>
                  <div class="text-start invalid-feedback attachment" id="attachmentFileFormat" style="display: none;">{{__('form.attachmentFileFormat')}}</div>
                  <div class="text-start invalid-feedback attachment" id="attachmentSameFileName" style="display: none;">{{__('form.attachmentSameFileName')}}</div>
                  <div class="text-start invalid-feedback attachment" id="attachmentFilesExceedSize" style="display: none;">{{__('form.attachmentFilesExceedSize')}}</div>
                </div>
                <div class="col-2 text-center pt-1">
                  <svg id="add-file" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus-circle-fill" width="30" height="30" viewBox="0 0 16 16" style="cursor: pointer;">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                  </svg>
                </div>
              </div>
              <table class="table">
                <tbody>
                  <tr>
                    <td class="fw-bold">{{__('form.attachmentFileName')}}</td>
                    <td class="text-center" id="fileName"></td>
                  </tr>
                  <tr>
                    <td class="fw-bold">{{__('form.attachmentFileSize')}}</td>
                    <td class="text-center" id="fileSize"></td>
                  </tr>
                  <tr>
                    <td class="fw-bold">{{__('form.attachmentAddedFileDate')}}</td>
                    <td class="text-center" id="addedFileDate"></td>
                  </tr>
                  <tr class="d-none">
                    <td class="text-center" id="valueInput"></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-12 ">
              <div class="form-floating h-100" id="div-attachmentFilesList">
                <div class="form-control pt-2 h-100" id="attachmentList" style="overflow-x: hidden; overflow-y: auto; min-height:150px;">
                  <div class="fs-5 text-start title-border fw-bold" for="attachmentList">{{__('form.attachmentFilesList')}}</div>
                  <div class="row px-3">
                    <div class="d-flex justify-content-between mt-2">
                      <div class="col-6 fs-6 fst-italic">{{__('form.attachmentFileName')}}</div>
                      <div class="col-2 fs-6 text-center fst-italic">{{__('form.attachmentFileSize')}}</div>
                      <div class="col-2 fs-6 text-center fst-italic">{{__('form.attachmentAddedFileDate')}}</div>
                      <div class="col-2 "></div>
                    </div>
                    <div class="d-flex flex-column justify-content-between" id="attachmentFilesList">
                      <!-- foreach pour les fichiers cliquable pour voir la pièce jointe -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-end inline-block">
              <p class="mb-0" id="totalSize">/75Mo</p>
            </div>
            @if(!is_null(old('fileNames')))
            @foreach(old('fileNames') as $fileName)
            <div hidden>
              {{$fileNameIndex = "phoneTypes." . "$loop->index"}}
              {{$fileSizeIndex = "fileSizes." . "$loop->index"}}
              {{$fileTypeIndex = "fileTypes." . "$loop->index"}}
              {{$addedFileDateIndex = "addedFileDates." . "$loop->index"}}
            </div>
            @if($errors->has($fileNameIndex))
            <p class="m-0">{{ $errors->first($fileNameIndex) }}</p>
            @endif
            @if($errors->has($fileSizeIndex))
            <p class="m-0">{{ $errors->first($fileSizeIndex) }}</p>
            @endif
            @if($errors->has($fileTypeIndex))
            <p class="m-0">{{ $errors->first($fileTypeIndex) }}</p>
            @endif
            @if($errors->has($addedFileDateIndex))
            <p class="m-0">{{ $errors->first($addedFileDateIndex) }}</p>
            @endif
            @endforeach
            @endif
          </div>
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
              <button id="btnEditAttachmentFiles" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.edit')}}</button>
              <button id="btnSaveAttachmentFiles" type="submit" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.save')}}</button>
            </div>
          </div>
        </div>
      </div><!--FIN PIÈCES JOINTES-->
      <!--FINANCES-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="finances-section">
        <div class="bg-white rounded my-2 form-section w-65">
          <div class="row">
            <div class="col-12 text-center">
              <h1>{{__('show.finance')}}</h1>
            </div>
          </div>
          <div class="row px-3 mb-3">
            <div class="col-12 text-center pb-3">
              <div class="form-floating pe-2">
                <input type="text" name="financesTps" id="financesTps" class="form-control" value="" placeholder="" maxlength="8" disabled>
                <label for="financesTps" id="">{{__('form.tpsNumber')}}</label>
              </div>
            </div>
            <div class="col-12 text-center pb-3">
              <div class="form-floating pe-2">
                <input type="text" name="financesTvq" id="financesTvq" class="form-control" value="" placeholder="" maxlength="8" disabled>
                <label for="financesTvq" id="">{{__('form.tvqNumber')}}</label>
              </div>
            </div>
            <div class="col-12 text-center pb-3">
              <div class="form-floating pe-2">
                <select name="financesPaymentConditions" id="financesPaymentConditions" class="form-select" aria-label="" disabled>
                  <option>{{__('form.paymentConditions')}}</option>
                </select>
                <label for="financesPaymentConditions" id="">{{__('form.paymentConditions')}}</label>
              </div>
            </div>
            <div class="row pb-3">
              <div class="col-6">
                <div class="w-100">
                  <h5 class="text-center text-decoration-underline">{{__('form.currency')}}</h5>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioCAD" id="flexRadioCAD" checked disabled>
                    <label class="form-check-label" for="flexRadioCAD">{{__('form.canadianCurrency')}}</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioUS" id="flexRadioUS" disabled>
                    <label class="form-check-label" for="flexRadioUS">{{__('form.usCurrency')}}</label>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="w-100">
                  <h5 class="text-center text-decoration-underline">{{__('form.communication')}}</h5>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioEmail" id="flexRadioEmail" checked disabled>
                    <label class="form-check-label" for="flexRadioEmail">{{__('form.email')}}</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioMail" id="flexRadioMail" disabled>
                    <label class="form-check-label" for="flexRadioMail">{{__('form.mail')}}</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 d-flex justify-content-center mb-2">
                <button id="btnEditFinances" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.edit')}}</button>
                <button id="btnSaveFinances" type="submit" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.save')}}</button>
              </div>
            </div>
          </div>
        </div>
      </div><!--FIN FINANCES-->
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src=" {{ asset('js/showSupplier.js') }} "></script>
@endsection