@extends('layouts.app')

@section('title', __('form.signupTitle'))

@section('css')
<link rel="stylesheet" href="{{ asset('css/supplier.css') }}">
<link rel="stylesheet" href="{{ asset('css/progressBar.css') }}">
<link rel="stylesheet" href="{{ asset('css/documentation.css') }}">
@endsection

@section('content')
<form id="form" method="post" action="{{ route('suppliers.store') }}" class="need-validation" onkeydown="return event.key != 'Enter';" enctype="multipart/form-data">
  @csrf
  <!--PROGRESS BAR-->
  <div class="container-fluid d-flex justify-content-center">
    <div id="progressBar" class="arrow-steps mt-3">
      <div class="step current clickFleche">
        <span class="number clickCircle">
        <svg class="d-none icon-valid-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
          <path d="m16.298,8.288l1.404,1.425-5.793,5.707c-.387.387-.896.58-1.407.58s-1.025-.195-1.416-.585l-2.782-2.696,1.393-1.437,2.793,2.707,5.809-5.701Zm7.702,3.712c0,6.617-5.383,12-12,12S0,18.617,0,12,5.383,0,12,0s12,5.383,12,12Zm-2,0c0-5.514-4.486-10-10-10S2,6.486,2,12s4.486,10,10,10,10-4.486,10-10Z" />
        </svg>
        <svg class="d-none icon-invalid-circle" width="20" height="20" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="m23.121,6.151L17.849.878c-.567-.566-1.321-.878-2.121-.878h-7.455c-.8,0-1.554.312-2.122.879L.879,6.151c-.566.567-.879,1.32-.879,2.121v7.456c0,.801.312,1.554.879,2.121l5.272,5.273c.567.566,1.321.878,2.121.878h7.455c.8,0,1.554-.312,2.122-.879l5.271-5.272c.566-.567.879-1.32.879-2.121v-7.456c0-.801-.313-1.554-.879-2.121Zm-1.121,9.577c0,.263-.106.521-.293.707l-5.271,5.271c-.19.189-.442.294-.709.294h-7.455c-.267,0-.519-.104-.708-.293l-5.271-5.272c-.187-.187-.293-.444-.293-.707v-7.456c0-.263.106-.521.293-.707L7.563,2.294c.19-.189.442-.294.709-.294h7.455c.267,0,.519.104.708.293l5.271,5.272c.187.187.293.444.293.707v7.456Zm-9-2.728h-2v-7h2v7Zm.5,3.5c0,.828-.672,1.5-1.5,1.5s-1.5-.672-1.5-1.5.672-1.5,1.5-1.5,1.5.672,1.5,1.5Z" />
        </svg>
        1
        </span>
        <span class="icon-valid"></span>
        <span class="icon-invalid"></span>
        <span class="name">{{__('form.identificationTitle')}}</span>
      </div>
      <div class="step clickFleche">
        <span class="number clickCircle">
        <svg class="d-none icon-valid-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
          <path d="m16.298,8.288l1.404,1.425-5.793,5.707c-.387.387-.896.58-1.407.58s-1.025-.195-1.416-.585l-2.782-2.696,1.393-1.437,2.793,2.707,5.809-5.701Zm7.702,3.712c0,6.617-5.383,12-12,12S0,18.617,0,12,5.383,0,12,0s12,5.383,12,12Zm-2,0c0-5.514-4.486-10-10-10S2,6.486,2,12s4.486,10,10,10,10-4.486,10-10Z" />
        </svg>
        <svg class="d-none icon-invalid-circle" width="20" height="20" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="m23.121,6.151L17.849.878c-.567-.566-1.321-.878-2.121-.878h-7.455c-.8,0-1.554.312-2.122.879L.879,6.151c-.566.567-.879,1.32-.879,2.121v7.456c0,.801.312,1.554.879,2.121l5.272,5.273c.567.566,1.321.878,2.121.878h7.455c.8,0,1.554-.312,2.122-.879l5.271-5.272c.566-.567.879-1.32.879-2.121v-7.456c0-.801-.313-1.554-.879-2.121Zm-1.121,9.577c0,.263-.106.521-.293.707l-5.271,5.271c-.19.189-.442.294-.709.294h-7.455c-.267,0-.519-.104-.708-.293l-5.271-5.272c-.187-.187-.293-.444-.293-.707v-7.456c0-.263.106-.521.293-.707L7.563,2.294c.19-.189.442-.294.709-.294h7.455c.267,0,.519.104.708.293l5.271,5.272c.187.187.293.444.293.707v7.456Zm-9-2.728h-2v-7h2v7Zm.5,3.5c0,.828-.672,1.5-1.5,1.5s-1.5-.672-1.5-1.5.672-1.5,1.5-1.5,1.5.672,1.5,1.5Z" />
        </svg>
        2
        </span>
        <span class="icon-valid"></span>
        <span class="icon-invalid"></span>
        <span class="name">{{__('form.contactDetailsTitle')}}</span>
      </div>
      <div class="step clickFleche">
        <span class="number clickCircle">
        <svg class="d-none icon-valid-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
          <path d="m16.298,8.288l1.404,1.425-5.793,5.707c-.387.387-.896.58-1.407.58s-1.025-.195-1.416-.585l-2.782-2.696,1.393-1.437,2.793,2.707,5.809-5.701Zm7.702,3.712c0,6.617-5.383,12-12,12S0,18.617,0,12,5.383,0,12,0s12,5.383,12,12Zm-2,0c0-5.514-4.486-10-10-10S2,6.486,2,12s4.486,10,10,10,10-4.486,10-10Z" />
        </svg>
        <svg class="d-none icon-invalid-circle" width="20" height="20" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="m23.121,6.151L17.849.878c-.567-.566-1.321-.878-2.121-.878h-7.455c-.8,0-1.554.312-2.122.879L.879,6.151c-.566.567-.879,1.32-.879,2.121v7.456c0,.801.312,1.554.879,2.121l5.272,5.273c.567.566,1.321.878,2.121.878h7.455c.8,0,1.554-.312,2.122-.879l5.271-5.272c.566-.567.879-1.32.879-2.121v-7.456c0-.801-.313-1.554-.879-2.121Zm-1.121,9.577c0,.263-.106.521-.293.707l-5.271,5.271c-.19.189-.442.294-.709.294h-7.455c-.267,0-.519-.104-.708-.293l-5.271-5.272c-.187-.187-.293-.444-.293-.707v-7.456c0-.263.106-.521.293-.707L7.563,2.294c.19-.189.442-.294.709-.294h7.455c.267,0,.519.104.708.293l5.271,5.272c.187.187.293.444.293.707v7.456Zm-9-2.728h-2v-7h2v7Zm.5,3.5c0,.828-.672,1.5-1.5,1.5s-1.5-.672-1.5-1.5.672-1.5,1.5-1.5,1.5.672,1.5,1.5Z" />
        </svg>
        3
        </span>
        <span class="icon-valid"></span>
        <span class="icon-invalid"></span>
        <span class="name">{{__('form.contactsTitle')}}</span>
      </div>
      <div class="step clickFleche">
        <span class="number clickCircle">
        <svg class="d-none icon-valid-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
          <path d="m16.298,8.288l1.404,1.425-5.793,5.707c-.387.387-.896.58-1.407.58s-1.025-.195-1.416-.585l-2.782-2.696,1.393-1.437,2.793,2.707,5.809-5.701Zm7.702,3.712c0,6.617-5.383,12-12,12S0,18.617,0,12,5.383,0,12,0s12,5.383,12,12Zm-2,0c0-5.514-4.486-10-10-10S2,6.486,2,12s4.486,10,10,10,10-4.486,10-10Z" />
        </svg>
        <svg class="d-none icon-invalid-circle" width="20" height="20" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="m23.121,6.151L17.849.878c-.567-.566-1.321-.878-2.121-.878h-7.455c-.8,0-1.554.312-2.122.879L.879,6.151c-.566.567-.879,1.32-.879,2.121v7.456c0,.801.312,1.554.879,2.121l5.272,5.273c.567.566,1.321.878,2.121.878h7.455c.8,0,1.554-.312,2.122-.879l5.271-5.272c.566-.567.879-1.32.879-2.121v-7.456c0-.801-.313-1.554-.879-2.121Zm-1.121,9.577c0,.263-.106.521-.293.707l-5.271,5.271c-.19.189-.442.294-.709.294h-7.455c-.267,0-.519-.104-.708-.293l-5.271-5.272c-.187-.187-.293-.444-.293-.707v-7.456c0-.263.106-.521.293-.707L7.563,2.294c.19-.189.442-.294.709-.294h7.455c.267,0,.519.104.708.293l5.271,5.272c.187.187.293.444.293.707v7.456Zm-9-2.728h-2v-7h2v7Zm.5,3.5c0,.828-.672,1.5-1.5,1.5s-1.5-.672-1.5-1.5.672-1.5,1.5-1.5,1.5.672,1.5,1.5Z" />
        </svg>
        4
        </span>
        <span class="icon-valid"></span>
        <span class="icon-invalid"></span>
        <span class="name">{{__('form.productsAndServiceTitle')}}</span>
      </div>
      <div class="step clickFleche">
        <span class="number clickCircle">
        <svg class="d-none icon-valid-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
          <path d="m16.298,8.288l1.404,1.425-5.793,5.707c-.387.387-.896.58-1.407.58s-1.025-.195-1.416-.585l-2.782-2.696,1.393-1.437,2.793,2.707,5.809-5.701Zm7.702,3.712c0,6.617-5.383,12-12,12S0,18.617,0,12,5.383,0,12,0s12,5.383,12,12Zm-2,0c0-5.514-4.486-10-10-10S2,6.486,2,12s4.486,10,10,10,10-4.486,10-10Z" />
        </svg>
        <svg class="d-none icon-invalid-circle" width="20" height="20" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="m23.121,6.151L17.849.878c-.567-.566-1.321-.878-2.121-.878h-7.455c-.8,0-1.554.312-2.122.879L.879,6.151c-.566.567-.879,1.32-.879,2.121v7.456c0,.801.312,1.554.879,2.121l5.272,5.273c.567.566,1.321.878,2.121.878h7.455c.8,0,1.554-.312,2.122-.879l5.271-5.272c.566-.567.879-1.32.879-2.121v-7.456c0-.801-.313-1.554-.879-2.121Zm-1.121,9.577c0,.263-.106.521-.293.707l-5.271,5.271c-.19.189-.442.294-.709.294h-7.455c-.267,0-.519-.104-.708-.293l-5.271-5.272c-.187-.187-.293-.444-.293-.707v-7.456c0-.263.106-.521.293-.707L7.563,2.294c.19-.189.442-.294.709-.294h7.455c.267,0,.519.104.708.293l5.271,5.272c.187.187.293.444.293.707v7.456Zm-9-2.728h-2v-7h2v7Zm.5,3.5c0,.828-.672,1.5-1.5,1.5s-1.5-.672-1.5-1.5.672-1.5,1.5-1.5,1.5.672,1.5,1.5Z" />
        </svg>
        5
        </span>
        <span class="icon-valid"></span>
        <span class="icon-invalid"></span>
        <span class="name">{{__('form.rbqTitle')}}</span>
      </div>
      <div class="step clickFleche">
        <span class="number clickCircle">
        <svg class="d-none icon-valid-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
          <path d="m16.298,8.288l1.404,1.425-5.793,5.707c-.387.387-.896.58-1.407.58s-1.025-.195-1.416-.585l-2.782-2.696,1.393-1.437,2.793,2.707,5.809-5.701Zm7.702,3.712c0,6.617-5.383,12-12,12S0,18.617,0,12,5.383,0,12,0s12,5.383,12,12Zm-2,0c0-5.514-4.486-10-10-10S2,6.486,2,12s4.486,10,10,10,10-4.486,10-10Z" />
        </svg>
        <svg class="d-none icon-invalid-circle" width="20" height="20" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
          <path d="m23.121,6.151L17.849.878c-.567-.566-1.321-.878-2.121-.878h-7.455c-.8,0-1.554.312-2.122.879L.879,6.151c-.566.567-.879,1.32-.879,2.121v7.456c0,.801.312,1.554.879,2.121l5.272,5.273c.567.566,1.321.878,2.121.878h7.455c.8,0,1.554-.312,2.122-.879l5.271-5.272c.566-.567.879-1.32.879-2.121v-7.456c0-.801-.313-1.554-.879-2.121Zm-1.121,9.577c0,.263-.106.521-.293.707l-5.271,5.271c-.19.189-.442.294-.709.294h-7.455c-.267,0-.519-.104-.708-.293l-5.271-5.272c-.187-.187-.293-.444-.293-.707v-7.456c0-.263.106-.521.293-.707L7.563,2.294c.19-.189.442-.294.709-.294h7.455c.267,0,.519.104.708.293l5.271,5.272c.187.187.293.444.293.707v7.456Zm-9-2.728h-2v-7h2v7Zm.5,3.5c0,.828-.672,1.5-1.5,1.5s-1.5-.672-1.5-1.5.672-1.5,1.5-1.5,1.5.672,1.5,1.5Z" />
        </svg>
        6
        </span>
        <span class="icon-valid"></span>
        <span class="icon-invalid"></span>
        <span class="name">{{__('form.attachmentFilesTitle')}}</span>
      </div>
    </div>
  </div><!-- FIN PROGRESS BAR-->

  <!--IDENTIFICATION-->
  <div class="container bg-white rounded my-2 form-section d-none" id="identification-section">
    <div class="row d-none d-md-block">
      <div class="col-12 rounded-top fond-image fond-identification"></div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <h1>{{__('form.identificationTitle')}}</h1>
      </div>
    </div>
    <div class="row px-3">
      <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
        <h2 class="text-center h4">{{__('form.identificationCompanySection')}}</h2>
        <div class="d-flex flex-column justify-content-between h-100">
          <div class="text-start">
            <div class="form-floating mb-3">
              <input type="text" name="neq" id="neq" class="form-control" placeholder="" value="{{ old('neq') }}" maxlength="10">
              <label for="neq">{{__('form.neqLabel')}}</label>
              <div class="invalid-feedback" id="neqInvalidStart" style="display: none;">{{__('validation.starts_with', ['attribute' => 'NEQ', 'values' => '11, 22, 33 ou 88'])}}</div>
              <div class="invalid-feedback" id="neqInvalidCharacters" style="display: none;">{{__('form.identificationValidationNEQOnlyDigits')}}</div>
              <div class="invalid-feedback" id="neqInvalidAmount" style="display: none;">{{__('form.identificationValidationNEQAmount')}}</div>
              <div class="invalid-feedback" id="neqInvalidExist" style="display: none;">{{__('form.identificationNeqExistValidation')}}</div>
            </div>
            @if($errors->has('neq'))
            <p>{{ $errors->first('neq') }}</p>
            @endif
          </div>
          <div class="text-start">
            <div class="form-floating mb-3">
              <input type="text" name="name" id="name" class="form-control" placeholder="" value="{{ old('name') }}" maxlength="64">
              <label for="name">{{__('form.companyNameLabel')}} <span class="required">*</span></label>
              <div id="nameStart"></br></div>
              <div class="valid-feedback" id="nameValid" style="display: none;"></br></div>
              <div class="invalid-feedback" id="nameInvalidEmpty" style="display: none;">{{__('validation.required', ['attribute' => 'Nom d\'entreprise'])}}</div>
            </div>
            @if($errors->has('name'))
            <p>{{ $errors->first('name') }}</p>
            @endif
          </div>
        </div>
      </div>
      <div class="col-12 col-md-8 d-flex flex-column justify-content-between">
        <h2 class="text-center h4">{{__('form.identificationAuthentificationSection')}}</h2>
        <div class="d-flex flex-column justify-content-between h-100">
          <div class="text-start">
            <div class="form-floating mb-3">
              <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" value="{{ old('email') }}" maxlength="64">
              <label for="email">{{__('form.emailLabel')}} <span class="required">*</span></label>
              <div class="invalid-feedback" id="emailInvalidEmpty" style="display: none;">{{__('validation.required', ['attribute' => 'Adresse courriel'])}}</div>
              <div class="invalid-feedback" id="emailInvalidFormat" style="display: none;">{{__('form.contactsEmailsValidationFormat')}}</div>
              <div class="invalid-feedback" id="emailInvalidUnique" style="display: none;">{{__('form.identificationValidationEmailUnique')}}</div>
            </div>
            @if($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
            @endif
          </div>
          <div class="text-start">
            <div class="row">
              <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
                <div class="form-floating mb-3">
                  <input type="password" name="password" id="password" class="form-control" placeholder="" maxlength="12">
                  <label for="password">{{__('form.passwordLabel')}} <span class="required">*</span></label>
                  <div id="passwordStart"></br></div>
                  <div class="valid-feedback" id="passwordValid" style="display: none;"></br></div>
                  <div class="invalid-feedback" id="passwordInvalidEmpty" style="display: none;">{{__('validation.required', ['attribute' => 'Mot de passe'])}}</div>
                  <div class="invalid-feedback" id="passwordInvalidAmount" style="display: none;">{{__('form.identificationValidationMDPAmount')}}</div>
                  <div class="invalid-feedback" id="passwordInvalidLowercase" style="display: none;">{{__('form.identificationValidationMDPLowercase')}}</div>
                  <div class="invalid-feedback" id="passwordInvalidUppercase" style="display: none;">{{__('form.identificationValidationMDPUppercase')}}</div>
                  <div class="invalid-feedback" id="passwordInvalidNumber" style="display: none;">{{__('form.identificationValidationMDPDigits')}}</div>
                  <div class="invalid-feedback" id="passwordInvalidSpecial" style="display: none;">{{__('form.identificationValidationMDPSpecial')}}</div>
                </div>
                @if($errors->has('password'))
                <p>{{ $errors->first('password') }}</p>
                @endif
              </div>
              <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
                <div class="form-floating mb-3">
                  <input type="password" name="password_confirmation" id="password_confirmation" placeholder="" class="form-control" maxlength="12">
                  <label for="password_confirmation">{{__('form.passwordConfirmLabel')}} <span class="required">*</span></label>
                  <div id="password_confirmationStart"></br></div>
                  <div class="valid-feedback" id="password_confirmationValid" style="display: none;"></br></div>
                  <div class="invalid-feedback" id="password_confirmationInvalidDifferent" style="display: none;">{{__('form.identificationValidationMDPConfirm')}}</div>
                </div>
                @if($errors->has('password_confirmation'))
                <p>{{ $errors->first('password_confirmation') }}</p>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center mb-2">
        <button id="identification-button" type="button" class="m-2 py-1 px-3 rounded button-darkblue next-button">{{__('global.next')}}</button>
      </div>
    </div>
  </div> <!--FIN IDENTIFICATION-->

  <!--PRODUIT ET SERVICE-->
  <div class="container bg-white rounded my-2 form-section d-none" id="productsServices-section">
    <div class="row d-none d-md-block">
      <div class="col-12 rounded-top fond-image fond-products_services"></div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <h1>{{__('form.productsAndServiceTitle')}}</h1>
      </div>
    </div>
    <div class="row px-3">
      <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
        <h2 class="text-center h4">{{__('form.productsAndServiceServices')}}</h2>
        <div class="text-center">
          <div class="form-floating mb-3">
            <input type="text" id="service-search" class="form-control" placeholder="">
            <label for="service-search">{{__('form.productsAndServiceCategoriesSearch')}}</label>
          </div>
        </div>
        <div>
          <div class="form-floating">
            <div class="form-control" placeholder="details" id="products-categories" style="height: 232px; overflow-x: hidden; overflow-y: auto;">
              <div class="mt-xl-0 mt-md-4" id="service-list">
              </div>
            </div>
            <label for="products-categories" class="labelbackground">{{__('form.productsAndServiceServicesCategorySelection')}}</label>
            <div class="note" id="results-count"><br></div>
          </div>
        </div>

      </div>
      <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
        <h2 class="text-center h4">{{__('form.productsAndServiceSelectedServicesList')}}</h2>
        <div>
          <div class="form-floating">
            <div class="form-control" placeholder="selected" id="products-selected" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
              <div class="mt-xl-0 mt-lg-4 mt-md-5" id="service-selected">
              </div>
            </div>
            <label for="products-selected" class="labelbackground">{{__('form.productsAndServiceServicesCategorySelected')}}</label>
            <div class="note"><br></div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
        <h2 class="text-center h4"><br></h2>
        <div class="text-center">
          <div class="form-floating">
            <textarea class="form-control" name="product_service_detail" placeholder="details" id="products-details" style="height: 308px; resize: none;" maxlength="500"></textarea>
            <label for="products-details" class="labelbackground">{{__('form.productsAndServiceCategoriesDetails')}}</label>
            <div class="note"><br></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center mb-2">
        <button type="button" class="m-2 py-1 px-3 rounded  previous-button">{{__('global.previous')}}</button>
        <button id="productsServices-button" type="button" class="m-2 py-1 px-3 rounded button-darkblue next-button">{{__('global.next')}}</button>
      </div>
    </div>
  </div> <!--FIN PRODUIT ET SERVICE-->

  <!--LICENCE RBQ-->
  <div class="container bg-white rounded my-2 form-section d-none" id="licence-section">
    <div class="row d-none d-md-block">
      <div class="col-12 rounded-top fond-image fond-rbq"></div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <h1>{{__('form.rbqTitle')}}</h1>
      </div>
    </div>
    <div class="row px-3 text-danger">{{__('form.rbqNotNecessary')}}</div>
    <div class="row px-3">
      <div class="col-12 col-md-4 d-flex flex-column">
        <h2 class="text-center h4">{{__('form.rbqLicenceSection')}}</h2>
        <div class="d-flex flex-column justify-content-between h-100">
          <div class="text-center">
            <div class="form-floating mb-3">
              <input type="text" name="licenceRbq" id="licenceRbq" value="{{ old('licenceRbq') }}" class="form-control" placeholder="" maxlength="10">
              <label for="licenceRbq">{{__('form.numberLabel')}}</label>
              <div class="text-start invalid-feedback licenceInvalidNumber" style="display: none;">{{__('form.rbqLicenceValidation')}}</div>
              <div class="text-start invalid-feedback licenceInvalidSize" style="display: none;">{{__('form.rbqLicenceValidationSize')}}</div>
            </div>
            @if($errors->has('licenceRbq'))
            <p>{{ $errors->first('licenceRbq') }}</p>
            @endif
          </div>
          <div class="text-center">
            <div class="form-floating mb-3">
              <select name="statusRbq" id="statusRbq" class="form-select" aria-label="">
                <option disabled selected value>{{__('form.choiceDefaultStatus')}}</option>
                <option value>{{__('global.none')}}</option>
                <option value="valid" {{ "valid" == old('statusRbq') ? 'selected' : null }}>{{__('form.choiceValid')}}</option>
                <option value="restrictedValid" {{ "restrictedValid" == old('statusRbq') ? 'selected' : null }}>{{__('form.choiceRestrictedValid')}}</option>
                <option value="invalid" {{ "invalid" == old('statusRbq') ? 'selected' : null }}>{{__('form.choiceInvalid')}}</option>
              </select>
              <label for="statusRbq">{{__('form.statusLabel')}}</label>
              <div class="text-start invalid-feedback statusInvalidRequired" style="display: none;">{{__('form.rbqStatusValidationRequired')}}</div>
              <div class="text-start invalid-feedback statusInvalidRequiredNot" style="display: none;">{{__('form.rbqStatusValidationRequiredNot')}}</div>
            </div>
            @if($errors->has('statusRbq'))
            <p>{{ $errors->first('statusRbq') }}</p>
            @endif
          </div>
          <div class="text-center">
            <div class="form-floating mb-3">
              <select name="typeRbq" id="typeRbq" class="form-select" aria-label="">
                <option disabled selected value>{{__('form.choiceDefaultType')}}</option>
                <option value>{{__('global.none')}}</option>
                <option value="entrepreneur" {{ "entrepreneur" == old('typeRbq') ? 'selected' : null }}>{{__('form.choiceEntrepreneur')}}</option>
                <option value="ownerBuilder" {{ "ownerBuilder" == old('typeRbq') ? 'selected' : null }}>{{__('form.choiceOwnerBuilder')}}</option>
              </select>
              <label for="typeRbq">{{__('form.typeLabel')}}</label>
              <div class="text-start invalid-feedback typeInvalidRequired" style="display: none;">{{__('form.rbqTypeValidationRequired')}}</div>
              <div class="text-start invalid-feedback typeInvalidRequiredNot" style="display: none;">{{__('form.rbqTypeValidationRequiredNot')}}</div>
            </div>
            @if($errors->has('typeRbq'))
            <p>{{ $errors->first('typeRbq') }}</p>
            @endif
          </div>
        </div>
      </div>
      <div class="col-12 col-md-8 d-flex flex-column justify-content-start">
        <h2 class="text-center h4">{{__('form.rbqCategoriesSection')}}</h2>
        <div class="text-center">
          <div class="form-floating mb-3">
            <div id="subcategories-container" class="form-control pt-2" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
              <div id="no-categories" class="d-block">
                {{__('form.rbqCategoriesUnselectedType')}}
              </div>
              <div id="entrepreneur-categories" class="d-none">
                <div class="fs-5 text-start fw-bold mb-2 title-border">{{__('form.rbqCategoriesGeneralEntrepreneur')}}</div>
                @foreach($workSubcategories as $workSubcategory)
                @if($workSubcategory->is_specialised == false)
                <div class="form-check pb-2">
                  <input
                    class="form-check-input mt-0 rbq-subcategories-check"
                    type="checkbox"
                    name="rbqSubcategories[]"
                    value="{{$workSubcategory->code}}"
                    id="flexCheckGen{{$workSubcategory->id}}Ent"
                    @if(!is_null(old('rbqSubcategories')))
                    @if(in_array($workSubcategory->code, old('rbqSubcategories')))
                  checked
                  @endif
                  @endif
                  >
                  <div class="d-flex">
                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckGen{{$workSubcategory->id}}Ent">
                      {{$workSubcategory->code}}
                    </label>
                    <label class="form-check-label text-start ps-2" for="flexCheckGen{{$workSubcategory->id}}Ent">
                      {{$workSubcategory->name}}
                    </label>
                  </div>
                </div>
                @endif
                @endforeach

                <div class="fs-5 text-start fw-bold mb-2 title-border">{{__('form.rbqCategoriesSpecialisedEntrepreneur')}}</div>
                @foreach($workSubcategories as $workSubcategory)
                @if($workSubcategory->is_specialised == true)
                <div key="spec{{$workSubcategory->id}}" class="form-check pb-2">
                  <input
                    class="form-check-input mt-0 rbq-subcategories-check"
                    type="checkbox"
                    name="rbqSubcategories[]"
                    value="{{$workSubcategory->code}}"
                    id="flexCheckSpec{{$workSubcategory->id}}Ent"
                    @if(!is_null(old('rbqSubcategories')))
                    @if(in_array($workSubcategory->code, old('rbqSubcategories')))
                  checked
                  @endif
                  @endif
                  >
                  <div class="d-flex">
                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckSpec{{$workSubcategory->id}}Ent">
                      {{$workSubcategory->code}}
                    </label>
                    <label class="form-check-label text-start ps-2" for="flexCheckSpec{{$workSubcategory->id}}Ent">
                      {{$workSubcategory->name}}
                    </label>
                  </div>
                </div>
                @endif
                @endforeach
              </div>

              <div id="ownerBuilder-categories" class="d-none">
                <div class="fs-5 text-start fw-bold mb-2 title-border">{{__('form.rbqCategoriesGeneralOwnerBuilder')}}</div>
                @foreach($workSubcategories as $workSubcategory)
                @if($workSubcategory->is_specialised == false && $workSubcategory->is_entrepreneur_only == false)
                <div class="form-check pb-2">
                  <input
                    class="form-check-input mt-0 rbq-subcategories-check"
                    type="checkbox"
                    name="rbqSubcategories[]"
                    value="{{$workSubcategory->code}}"
                    id="flexCheckGen{{$workSubcategory->id}}OB"
                    @if(!is_null(old('rbqSubcategories')))
                    @if(in_array($workSubcategory->code, old('rbqSubcategories')))
                  checked
                  @endif
                  @endif
                  >
                  <div class="d-flex">
                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckGen{{$workSubcategory->id}}OB">
                      {{$workSubcategory->code}}
                    </label>
                    <label class="form-check-label text-start ps-2" for="flexCheckGen{{$workSubcategory->id}}OB">
                      {{$workSubcategory->name}}
                    </label>
                  </div>
                </div>
                @endif
                @endforeach

                <div class="fs-5 text-start fw-bold mb-2 title-border">{{__('form.rbqCategoriesSpecialisedOwnerBuilder')}}</div>
                @foreach($workSubcategories as $workSubcategory)
                @if($workSubcategory->is_specialised == true && $workSubcategory->is_entrepreneur_only == false)
                <div key="spec{{$workSubcategory->id}}" class="form-check pb-2">
                  <input
                    class="form-check-input mt-0 rbq-subcategories-check"
                    type="checkbox"
                    name="rbqSubcategories[]"
                    value="{{$workSubcategory->code}}"
                    id="flexCheckSpec{{$workSubcategory->id}}OB"
                    @if(!is_null(old('rbqSubcategories')))
                    @if(in_array($workSubcategory->code, old('rbqSubcategories')))
                  checked
                  @endif
                  @endif
                  >
                  <div class="d-flex">
                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckSpec{{$workSubcategory->id}}OB">
                      {{$workSubcategory->code}}
                    </label>
                    <label class="form-check-label text-start ps-2" for="flexCheckSpec{{$workSubcategory->id}}OB">
                      {{$workSubcategory->name}}
                    </label>
                  </div>
                </div>
                @endif
                @endforeach
              </div>
            </div>
            @if($errors->has('rbqSubcategories'))
            <p>{{ $errors->first('rbqSubcategories') }}</p>
            @endif
            <div class="text-start invalid-feedback subcategorieInvalidRequired" style="display: none;">{{__('form.rbqSubcategorieValidationRequired')}}</div>
            <div class="text-start invalid-feedback subcategorieInvalidRequiredNot" style="display: none;">{{__('form.rbqSubcategorieValidationRequiredNot')}}</div>
          </div>
        </div>
      </div>
    </div>

    @if(!is_null(old('rbqSubcategories')))
    <div id="form-fail-rbq" hidden></div>
    @endif
    <div class="row">
      <div class="col-12 d-flex justify-content-center mb-2">
        <button type="button" class="m-2 py-1 px-3 rounded previous-button">{{__('global.previous')}}</button>
        <button id="rbqLicence-button" type="button" class="m-2 py-1 px-3 rounded button-darkblue next-button">{{__('global.next')}}</button>
      </div>
    </div>
  </div> <!--FIN LICENCE RBQ-->

  <!--COORDONNÉES-->
  <div class="container bg-white rounded my-2 form-section d-none" id="contactDetails-section">
    <div class="row d-none d-md-block">
      <div class="col-12 rounded-top fond-image fond-coordonnees"></div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <h1>{{__('form.contactDetailsTitle')}}</h1>
      </div>
    </div>
    <div class="row px-3">
      <div class="col-12 col-md-6 d-flex flex-column">
        <h2 class="text-center h4">{{__('form.contactDetailsAddressSection')}}</h2>
        <div class=" text-center d-flex flex-row">
          <div class="form-floating col-6 pe-2">
            <input type="text" name="contactDetailsCivicNumber" id="contactDetailsCivicNumber" class="form-control" value="{{ old('contactDetailsCivicNumber') }}" placeholder="" maxlength="8">
            <label for="contactDetailsCivicNumber" id="civicNumber">{{__('form.civicNumberLabel')}} <span class="required">*</span></label>
          </div>
          <div class="form-floating col-6">
            <input type="text" name="contactDetailsOfficeNumber" id="contactDetailsOfficeNumber" class="form-control" value="{{ old('contactDetailsOfficeNumber') }}" placeholder="" maxlength="8">
            <label for="contactDetailsOfficeNumber" id="officeNumber">{{__('form.officeNumber')}}</label>
          </div>
        </div>
        <div class="row mb-3">
          @if($errors->has('contactDetailsCivicNumber'))
          <p>{{ $errors->first('contactDetailsCivicNumber') }}</p>
          @endif
          @if($errors->has('contactDetailsOfficeNumber'))
          <p>{{ $errors->first('contactDetailsOfficeNumber') }}</p>
          @endif
          <div class="col-12">
            <div class="text-start invalid-feedback" id="invalidRequiredCivicNumber" style="display: none;">{{__('form.contactDetailsCNValidationRequired')}}</div>
            <div class="text-start invalid-feedback" id="invalidCivicNumber" style="display: none;">{{__('form.contactDetailsCNValidationAlphanum')}}</div>
            <div class="text-start invalid-feedback" id="invalidCivicNumberLength" style="display: none;">{{__('form.contactDetailsCNValidationLength')}}</div>
          </div>
          <div class="col-12">
            <div class="text-start invalid-feedback" id="invalidOfficeNumber" style="display: none;">{{__('form.contactDetailsONValidationAlphaNum')}}</div>
            <div class="text-start invalid-feedback" id="invalidOfficeNumberLength" style="display: none;">{{__('form.contactDetailsONValidationLenght')}}</div>
          </div>
        </div>
        <div class="text-center mb-4">
          <div class="form-floating">
            <input type="text" name="contactDetailsStreetName" id="contactDetailsStreetName" class="form-control" value="{{ old('contactDetailsStreetName') }}" placeholder="" maxlength="64">
            <label for="contactDetailsStreetName">{{__('form.streetName')}} <span class="required">*</span></label>
            <div class="text-start invalid-feedback" id="invalidRequiredStreetName" style="display: none;">{{__('form.contactDetailsStreetNameValidationRequired')}}</div>
            <div class="text-start invalid-feedback" id="invalidStreetName" style="display: none;">{{__('form.contactDetailsStreetNameValidationAlphaNumSC')}}</div>
            <div class="text-start invalid-feedback" id="invalidStreetNameLength" style="display: none;">{{__('form.contactDetailsStreetNameValidationLength')}}</div>
            @if($errors->has('contactDetailsStreetName'))
            <p>{{ $errors->first('contactDetailsStreetName') }}</p>
            @endif
          </div>
        </div>
        <div class="d-flex flex-column justify-content-between h-100">
          <div class="text-center d-flex flex-row">
            <div class="form-floating col-6 pe-2" id="div-city">
              <select name="contactDetailsCitySelect" id="contactDetailsCitySelect" class="form-select" aria-label=""></select>
              <input type="text" name="contactDetailsInputCity" id="contactDetailsInputCity" class="form-control d-none" value="{{ old('contactDetailsInputCity') }}" placeholder="" maxlength="64">
              <label for="contactDetailsCitySelect">{{__('form.city')}} <span class="required">*</span></label>
            </div>
            <div class="form-floating col-6">
              <select name="contactDetailsProvince" id="contactDetailsProvince" class="form-select" aria-label="">
                @foreach($provinces as $province)
                <option value="{{ $province->name }}"
                  {{ old('contactDetailsProvince', $selectedProvince ?? 'Québec') == $province->name ? 'selected' : '' }}>
                  {{ $province->name }}
                </option>
                @endforeach
              </select>
              <label for="contactDetailsProvince">{{__('form.province')}} <span class="required">*</span></label>
            </div>
          </div>
          <div class="row mb-3">
            @if($errors->has('contactDetailsInputCity'))
            <p>{{ $errors->first('contactDetailsInputCity') }}</p>
            @endif
            <div class="col-12">
              <div class="text-start invalid-feedback" id="invalidRequiredCity" style="display: none;">{{__('form.contactDetailsCityRequired')}}</div>
              <div class="text-start invalid-feedback" id="invalidCityLength" style="display: none;">{{__('form.contactDetailsCityLength')}}</div>
            </div>
          </div>
          <div class="text-center d-flex flex-row mb-4">
            <div class="form-floating col-8 pe-2">
              <select name="contactDetailsDistrictArea" id="contactDetailsDistrictArea" class="form-select" aria-label="">
              </select>
              <label for="contactDetailsDistrictArea">{{__('form.districtArea')}} <span class="required">*</span></label>
            </div>
            <div class="form-floating">
              <input type="text" name="contactDetailsPostalCode" id="contactDetailsPostalCode" class="form-control" value="{{ old('contactDetailsPostalCode') }}" placeholder="" maxlength="7">
              <label for="contactDetailsPostalCode" id="postalCode">{{__('form.postalCode')}} <span class="required">*</span></label>
              @if($errors->has('contactDetailsPostalCode'))
              <p>{{ $errors->first('contactDetailsPostalCode') }}</p>
              @endif
              <div class="text-start invalid-feedback" id="invalidRequiredPostalCode" style="display: none;">{{__('form.contactDetailsPostalCodeRequired')}}</div>
              <div class="text-start invalid-feedback" id="invalidPostalCodeFormat" style="display: none;">{{__('form.contactDetailsPostalCodeFormat')}}</div>
              <div class="text-start invalid-feedback" id="invalidPostalCodeLength" style="display: none;">{{__('form.contactDetailsPostalCodeLength')}}</div>
            </div>
          </div>

          <div class="text-center mb-3">
            <div class="form-floating">
              <input type="text" name="contactDetailsWebsite" id="contactDetailsWebsite" class="form-control" value="{{ old('contactDetailsWebsite') }}" placeholder="" maxlength="64">
              <label for="contactDetailsWebsite">{{__('form.website')}}</label>
              @if($errors->has('contactDetailsWebsite'))
              <p>{{ $errors->first('contactDetailsWebsite') }}</p>
              @endif
              <div class="text-start invalid-feedback" id="invalidWebsite" style="display: none;">{{__('form.contactDetailsWebsite')}}</div>
              <div class="text-start invalid-feedback" id="invalidWebsiteLength" style="display: none;">{{__('form.contactDetailsWebsiteLength')}}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 d-flex flex-column">
        <h2 class="text-center h4">{{__('form.contactDetailsPhoneNumbersSection')}}</h2>
        <div class="text-center d-flex flex-row">
          <div class="form-floating col-3">
            <select name="contactDetailsPhoneType" id="contactDetailsPhoneType" class="form-select" aria-label="">
              <option value="{{__('form.officeNumber')}}">{{__('form.officeNumber')}}</option>
              <option value="{{__('form.fax')}}">{{__('form.fax')}}</option>
              <option value="{{__('form.cellphone')}}">{{__('form.cellphone')}}</option>
            </select>
            <label for="contactDetailsPhoneType">{{__('form.typeLabel')}}</label>
          </div>
          <div class="form-floating col-5 px-2">
            <input type="text" name="contactDetailsPhoneNumber" id="contactDetailsPhoneNumber" class="form-control" placeholder="" maxlength="12">
            <label class="ms-2" for="contactDetailsPhoneNumber">{{__('form.numberLabel')}}</label>
          </div>
          <div class="form-floating col-3">
            <input type="text" name="contactDetailsPhoneExtension" id="contactDetailsPhoneExtension" class="form-control" placeholder="" maxlength="6">
            <label for="contactDetailsPhoneExtension">{{__('form.phoneExtension')}}</label>
          </div>
          <div class="col-1 d-flex align-items-center ">
            <svg id="add-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus-circle-fill button-add-darkblue" viewBox="0 0 16 16" style="cursor: pointer; padding-left:10px">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
            </svg>
          </div>
        </div>
        <div class="row mb-3">
          @if($errors->has('contactDetailsPhoneNumber'))
          <p>{{ $errors->first('contactDetailsPhoneNumber') }}</p>
          @endif
          @if($errors->has('contactDetailsPhoneExtension'))
          <p>{{ $errors->first('contactDetailsPhoneExtension') }}</p>
          @endif
          <div class="col-12 errorMessagesPhone">
            <div class="text-start invalid-feedback" id="invalidRequiredPhoneNumber" style="display: none;">{{__('form.contactDetailsPhoneNumberRequired')}}</div>
            <div class="text-start invalid-feedback" id="invalidPhoneNumberNumeric" style="display: none;">{{__('form.contactDetailsPhoneNumberNumeric')}}</div>
            <div class="text-start invalid-feedback" id="invalidPhoneNumberFormat" style="display: none;">{{__('form.contactDetailsPhoneNumberFormat')}}</div>
            <div class="text-start invalid-feedback" id="invalidPhoneExtension" style="display: none;">{{__('form.contactDetailsPhoneExtension')}}</div>
            <div class="text-start invalid-feedback" id="invalidPhoneExtensionLength" style="display: none;">{{__('form.contactDetailsPhoneExtensionLength')}}</div>
            <div class="text-start invalid-feedback" id="invalidAddPhoneNumber" style="display: none;">{{__('form.contactDetailsPhoneNumberAdd')}}</div>
          </div>
        </div>

        <div class="form-floating h-100 pb-4" id="div-phoneNumberList">
          <div class="form-control pt-2 h-100  mb-4" id="contactDetailsPhoneNumberList" style="overflow-x: hidden; overflow-y: auto;">
            <div class="fs-5 text-start title-border fw-bold" for="contactDetailsPhoneNumberList">{{__('form.phoneNumberList')}} <span class="required">*</span></div>
            <div class="row px-3">
              <div class="d-flex justify-content-between mt-2">
                <div class="col-2 fs-6">{{__('form.typeLabel')}}</div>
                <div class="col-6 fs-6 text-center" id="phoneNumber">{{__('form.phoneNumber')}}</div>
                <div class="col-2 fs-6 text-center">{{__('form.phoneExtension')}}</div>
                <div class="col-2 "></div>
              </div>
              <div class="d-flex flex-column justify-content-between" id="phoneNumberList">
                @if(!is_null(old('phoneNumbers')))
                @foreach(old('phoneNumbers') as $phoneNumber)
                <div class="row mb-2 align-items-center justify-content-between divPhone">
                  <div class="col-2 text-start phoneType">{{old('phoneTypes')[$loop->index]}}</div>
                  <input class="d-none" name="phoneTypes[]" value="{{old('phoneTypes')[$loop->index]}}" />
                  <div class="col-6 text-center phoneNumber">{{old('phoneNumbers')[$loop->index]}}</div>
                  <input class="d-none" name="phoneNumbers[]" value="{{old('phoneNumbers')[$loop->index]}}" />
                  <div class="col-2 text-center phoneExtension">{{old('phoneExtensions')[$loop->index]}}</div>
                  <input class="d-none" name="phoneExtensions[]" value="{{old('phoneExtensions')[$loop->index]}}" />
                  <div class="col-2 d-flex justify-content-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-x removePhone" viewBox="0 0 16 16" style="cursor:pointer;">
                      <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                  </div>
                </div>
                @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>
        <div class="text-start invalid-feedback" id="invalidListPhoneNumbers" style="display: none;">{{__('form.contactDetailsPhoneNumbersList')}}</div>
        @if(!is_null(old('phoneNumbers')))
        @foreach(old('phoneNumbers') as $phoneNumber)
        <div hidden>
          {{$phoneTypeIndex = "phoneTypes." . "$loop->index"}}
          {{$phoneNumberIndex = "phoneNumbers." . "$loop->index"}}
          {{$phoneExtensionIndex = "phoneExtensions." . "$loop->index"}}
        </div>
        @if($errors->has($phoneTypeIndex))
        <p class="m-0">{{ $errors->first($phoneTypeIndex) }}</p>
        @endif
        @if($errors->has($phoneNumberIndex))
        <p class="m-0">{{ $errors->first($phoneNumberIndex) }}</p>
        @endif
        @if($errors->has($phoneExtensionIndex))
        <p class="m-0">{{ $errors->first($phoneExtensionIndex) }}</p>
        @endif
        @endforeach
        @endif
        @if($errors->has('phoneNumbers'))
        <p>{{ $errors->first('phoneNumbers') }}</p>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center mb-3">
        <button type="button" class="m-2 py-1 px-3 rounded  previous-button">{{__('global.previous')}}</button>
        <button id="contactDetails-button" type="button" class="m-2 py-1 px-3 rounded button-darkblue next-button">{{__('global.next')}}</button>
      </div>
    </div>
  </div> <!--FIN COORDONNÉES-->

  <!--CONTACT-->
  <div class="container bg-white rounded my-2 form-section d-none" id="contacts-section">
    <div class="row d-none d-md-block">
      <div class="col-12 rounded-top fond-image fond-contacts"></div>
    </div>
    <div class="row">
      <div class="col-8 col-md-10 offset-2 offset-md-1 text-center">
        <h1>{{__('form.contactsTitle')}}</h1>
      </div>
      <div class="col-2 col-md-1 d-flex align-items-center justify-content-center">
        <button type="button" class="add-contact p-0">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill button-add-darkblue" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
          </svg>
        </button>
      </div>
    </div>

    <div id="contactsRow" class="row justify-content-center px-3">
      @if(!is_null(old('contactFirstNames')))
      @foreach(old('contactFirstNames') as $contactFirstName)
      <div hidden>
        {{$contactFirstNameIndex = "contactFirstNames." . "$loop->index"}}
        {{$contactLastNameIndex = "contactLastNames." . "$loop->index"}}
        {{$contactJobIndex = "contactJobs." . "$loop->index"}}
        {{$contactEmailIndex = "contactEmails." . "$loop->index"}}
        {{$contactTelType1Index = "contactTelTypes1." . "$loop->index"}}
        {{$contactTelNumber1Index = "contactTelNumbers1." . "$loop->index"}}
        {{$contactTelExtension1Index = "contactTelExtensions1." . "$loop->index"}}
        {{$contactTelType2Index = "contactTelTypes2." . "$loop->index"}}
        {{$contactTelNumber2Index = "contactTelNumbers2." . "$loop->index"}}
        {{$contactTelExtension2Index = "contactTelExtensions2." . "$loop->index"}}
      </div>

      <div id="referenceContact" class="col-12 col-lg-6 d-flex flex-column justify-content-between mb-2">
        <div class="rounded px-3 border">
          <div class="row">
            <h2 id="contactSubtitle1" class="col-10 col-sm-11 text-start h4">{{__('form.contactsSubtitle')}}</h2>
            <button type="button" class="col-2 col-sm-1 text-end delete-contact p-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
              </svg>
            </button>
          </div>
          <div class="row">
            <div class="col-12 col-lg-6 text-center mb-4">
              <div class="form-floating">
                <input type="text" name="contactFirstNames[]" id="contactFirstName1" class="form-control contact-input contact-name-input" placeholder="" maxlength="32" value="{{old('contactFirstNames')[$loop->index]}}">
                <label id="contactFirstNameLabel1" for="contactFirstName1">{{__('form.firstNameLabel')}} <span class="required">*</span></label>
              </div>
              @if($errors->has($contactFirstNameIndex))
              <p>{{ $errors->first($contactFirstNameIndex) }}</p>
              @endif
            </div>
            <div class="col-12 col-lg-6 text-center mb-4">
              <div class="form-floating">
                <input type="text" name="contactLastNames[]" id="contactLastName1" class="form-control contact-input contact-name-input" placeholder="" maxlength="32" value="{{old('contactLastNames')[$loop->index]}}">
                <label id="contactLastNameLabel1" for="contactLastName1">{{__('form.lastNameLabel')}} <span class="required">*</span></label>
              </div>
              @if($errors->has($contactLastNameIndex))
              <p>{{ $errors->first($contactLastNameIndex) }}</p>
              @endif
            </div>
          </div>
          <div class="text-center mb-4">
            <div class="form-floating">
              <input type="text" name="contactJobs[]" id="contactJob1" class="form-control contact-input contact-job-input" placeholder="" maxlength="32" value="{{old('contactJobs')[$loop->index]}}">
              <label id="contactJobLabel1" for="contactJob1">{{__('form.jobLabel')}}</label>
            </div>
            @if($errors->has($contactJobIndex))
            <p>{{ $errors->first($contactJobIndex) }}</p>
            @endif
          </div>
          <div class="text-center mb-4">
            <div class="form-floating">
              <input type="text" name="contactEmails[]" id="contactEmail1" class="form-control contact-input contact-email-input" placeholder="" maxlength="64" value="{{old('contactEmails')[$loop->index]}}">
              <label id="contactEmailLabel1" for="contactEmail1">{{__('form.emailLabel')}} <span class="required">*</span></label>
            </div>
            @if($errors->has($contactEmailIndex))
            <p>{{ $errors->first($contactEmailIndex) }}</p>
            @endif
          </div>
          <h2 class="h4">{{__('form.contactDetailsPhoneNumbersSection')}}</h2>
          <div class="mb-4">
            <div class="text-center d-flex flex-column flex-md-row mb-0">
              <div class="form-floating col-12 col-md-3">
                <select name="contactTelTypesA[]" id="contactTelTypeA1" class="form-select" aria-label="" value="{{old('contactTelTypesA')[$loop->index]}}">
                  <option value="{{__('form.officeNumber')}}">{{__('form.officeNumber')}}</option>
                  <option value="{{__('form.fax')}}">{{__('form.fax')}}</option>
                  <option value="{{__('form.cellphone')}}">{{__('form.cellphone')}}</option>
                </select>
                <label id="contactTelTypeLabelA1" for="contactTelTypeA1">{{__('form.typeLabel')}} <span class="required">*</span></label>
              </div>
              <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                <input type="text" name="contactTelNumbersA[]" id="contactTelNumberA1" class="form-control" placeholder="" maxlength="10" value="{{old('contactTelNumbersA')[$loop->index]}}">
                <label id="contactTelNumberLabelA1" class="my-4 my-md-0 ms-md-2" for="contactTelNumberA1">{{__('form.numberLabel')}} <span class="required">*</span></label>
              </div>
              <div class="form-floating col-12 col-md-3">
                <input type="text" name="contactTelExtensionsA[]" id="contactTelExtensionA1" class="form-control" placeholder="" maxlength="6" value="{{old('contactTelExtensionsA')[$loop->index]}}">
                <label id="contactTelExtensionLabelA1" for="contactTelExtensionA1">{{__('form.phoneExtension')}}</label>
              </div>
            </div>
            @if($errors->has($contactTelType1Index))
            <p class="m-0">{{ $errors->first($contactTelType1Index) }}</p>
            @endif
            @if($errors->has($contactTelNumber1Index))
            <p class="m-0">{{ $errors->first($contactTelNumber1Index) }}</p>
            @endif
            @if($errors->has($contactTelExtension1Index))
            <p class="m-0">{{ $errors->first($contactTelExtension1Index) }}</p>
            @endif
          </div>
          <h2 class="text-center d-md-none h4">{{__('form.phoneNumber')}}</h2>
          <div class="mb-4">
            <div class="text-center d-flex flex-column flex-md-row mb-0">
              <div class="form-floating col-12 col-md-3">
                <select name="contactTelTypesB[]" id="contactTelTypeB1" class="form-select" aria-label="" value="{{old('contactTelTypesB')[$loop->index]}}">
                  <option value="desktop">{{__('form.officeNumber')}}</option>
                  <option value="fax">{{__('form.fax')}}</option>
                  <option value="cellphone">{{__('form.cellphone')}}</option>
                </select>
                <label id="contactTelTypeLabelB1" for="contactTelTypeB1">{{__('form.typeLabel')}}</label>
              </div>
              <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                <input type="text" name="contactTelNumbersB[]" id="contactTelNumberB1" class="form-control" placeholder="" maxlength="10" value="{{old('contactTelNumbersB')[$loop->index]}}">
                <label id="contactTelNumberLabelB1" class="my-4 my-md-0 ms-md-2" for="contactTelNumberB1">{{__('form.numberLabel')}}</label>
              </div>
              <div class="form-floating col-12 col-md-3">
                <input type="text" name="contactTelExtensionsB[]" id="contactTelExtensionB1" class="form-control" placeholder="" maxlength="6" value="{{old('contactTelExtensionsB')[$loop->index]}}">
                <label id="contactTelExtensionLabelB1" for="contactTelExtensionB1">{{__('form.phoneExtension')}}</label>
              </div>
            </div>
            @if($errors->has($contactTelType1Index))
            <p class="m-0">{{ $errors->first($contactTelType1Index) }}</p>
            @endif
            @if($errors->has($contactTelNumber1Index))
            <p class="m-0">{{ $errors->first($contactTelNumber1Index) }}</p>
            @endif
            @if($errors->has($contactTelExtension1Index))
            <p class="m-0">{{ $errors->first($contactTelExtension1Index) }}</p>
            @endif
          </div>
        </div>
      </div>
      @endforeach
      @else
      <div id="referenceContact" class="col-12 col-lg-6 d-flex flex-column justify-content-between mb-2">
        <div class="row">

        </div>

        <div class="rounded pt-1 px-3 border">
          <div class="row">
            <h2 id="contactSubtitle1" class="col-10 col-sm-11 text-start h4">{{__('form.contactsSubtitle')}}</h2>
            <button type="button" class="col-2 col-sm-1 text-end delete-contact p-0">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
              </svg>
            </button>
          </div>
          <div class="row">
            <div class="col-12 col-lg-6 text-center mb-4">
              <div class="form-floating">
                <input type="text" name="contactFirstNames[]" id="contactFirstName1" class="form-control contact-input contact-name-input" placeholder="" maxlength="32">
                <label id="contactFirstNameLabel1" for="contactFirstName1">{{__('form.firstNameLabel')}} <span class="required">*</span></label>
                <div class="text-start invalid-feedback nameInvalidRequired" style="display: none;">{{__('form.contactsFirstNamesValidationRequired')}}</div>
                <div class="text-start invalid-feedback nameInvalidSymbols" style="display: none;">{{__('form.contactsNamesValidationSymbols')}}</div>
              </div>
            </div>
            <div class="col-12 col-lg-6 text-center mb-4">
              <div class="form-floating">
                <input type="text" name="contactLastNames[]" id="contactLastName1" class="form-control contact-input contact-name-input" placeholder="" maxlength="32">
                <label id="contactLastNameLabel1" for="contactLastName1">{{__('form.lastNameLabel')}} <span class="required">*</span></label>
                <div class="text-start invalid-feedback nameInvalidRequired" style="display: none;">{{__('form.contactsLastNamesValidationRequired')}}</div>
                <div class="text-start invalid-feedback nameInvalidSymbols" style="display: none;">{{__('form.contactsNamesValidationSymbols')}}</div>
              </div>
            </div>
          </div>
          <div class="text-center mb-4">
            <div class="form-floating">
              <input type="text" name="contactJobs[]" id="contactJob1" class="form-control contact-input contact-job-input" placeholder="" maxlength="32">
              <label id="contactJobLabel1" for="contactJob1">{{__('form.jobLabel')}}</label>
              <div class="text-start valid-feedback jobValid" style="display: none;"></br></div>
            </div>
          </div>
          <div class="text-center mb-4">
            <div class="form-floating">
              <input type="text" name="contactEmails[]" id="contactEmail1" class="form-control contact-input contact-email-input" placeholder="" maxlength="64">
              <label id="contactEmailLabel1" for="contactEmail1">{{__('form.emailLabel')}} <span class="required">*</span></label>
              <div class="text-start invalid-feedback emailInvalidRequired" style="display: none;">{{__('form.contactsEmailsValidationRequired')}}</div>
              <div class="text-start invalid-feedback emailInvalidFormat" style="display: none;">{{__('form.contactsEmailsValidationFormat')}}</div>
            </div>
          </div>
          <h2 class="h4">{{__('form.phoneNumber')}}</h2>
          <div class="d-flex flex-column mb-4 phone-container">
            <div class="text-center d-flex flex-column flex-md-row flew-mb-wrap">
              <div class="form-floating col-12 col-md-3">
                <select name="contactTelTypesA[]" id="contactTelTypeA1" class="form-select" aria-label="">
                  <option value="{{__('form.officeNumber')}}">{{__('form.officeNumber')}}</option>
                  <option value="{{__('form.fax')}}">{{__('form.fax')}}</option>
                  <option value="{{__('form.cellphone')}}">{{__('form.cellphone')}}</option>
                </select>
                <label id="contactTelTypeLabelA1" for="contactTelTypeA1">{{__('form.typeLabel')}} <span class="required">*</span></label>
              </div>
              <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                <input type="text" name="contactTelNumbersA[]" id="contactTelNumberA1" class="form-control contact-input contact-primary-phone-input" placeholder="" maxlength="12">
                <label id="contactTelNumberLabelA1" class="my-4 my-md-0 ms-md-2" for="contactTelNumberA1">{{__('form.numberLabel')}} <span class="required">*</span></label>
              </div>
              <div class="form-floating col-12 col-md-3">
                <input type="text" name="contactTelExtensionsA[]" id="contactTelExtensionA1" class="form-control contact-input contact-extension-input" placeholder="" maxlength="6">
                <label id="contactTelExtensionLabelA1" for="contactTelExtensionA1">{{__('form.phoneExtension')}}</label>
              </div>
            </div>
            <div class="text-start invalid-feedback phoneInvalidRequired" style="display: none;">{{__('form.contactsTelNumberValidationRequired')}}</div>
            <div class="text-start invalid-feedback phoneInvalidNumber" style="display: none;">{{__('form.contactsTelNumberValidation')}}</div>
            <div class="text-start invalid-feedback phoneInvalidSize" style="display: none;">{{__('form.contactsTelNumberValidationSize')}}</div>
            <div class="text-start invalid-feedback phoneInvalidExtension" style="display: none;">{{__('form.contactsTelExtensionValidation')}}</div>
          </div>

          <h2 class="text-center d-md-none h4">{{__('form.phoneNumber')}}</h2>
          <div class="d-flex flex-column mb-4 phone-container">
            <div class="text-center d-flex flex-column flex-md-row">
              <div class="form-floating col-12 col-md-3">
                <select name="contactTelTypesB[]" id="contactTelTypeB1" class="form-select" aria-label="">
                  <option value="{{__('form.officeNumber')}}">{{__('form.officeNumber')}}</option>
                  <option value="{{__('form.fax')}}">{{__('form.fax')}}</option>
                  <option value="{{__('form.cellphone')}}">{{__('form.cellphone')}}</option>
                </select>
                <label id="contactTelTypeLabelB1" for="contactTelTypeB1">{{__('form.typeLabel')}}</label>
              </div>
              <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                <input type="text" name="contactTelNumbersB[]" id="contactTelNumberB1" class="form-control contact-input contact-secondary-phone-input" placeholder="" maxlength="12">
                <label id="contactTelNumberLabelB1" class="my-4 my-md-0 ms-md-2" for="contactTelNumberB1">{{__('form.numberLabel')}}</label>
              </div>
              <div class="form-floating col-12 col-md-3">
                <input type="text" name="contactTelExtensionsB[]" id="contactTelExtensionB1" class="form-control contact-input contact-extension-input" placeholder="" maxlength="6">
                <label id="contactTelExtensionLabelB1" for="contactTelExtensionB1">{{__('form.phoneExtension')}}</label>
              </div>
            </div>
            <div class="text-start invalid-feedback phoneInvalidRequired" style="display: none;">{{__('form.contactsTelNumberValidationRequired')}}</div>
            <div class="text-start invalid-feedback phoneInvalidNumber" style="display: none;">{{__('form.contactsTelNumberValidation')}}</div>
            <div class="text-start invalid-feedback phoneInvalidSize" style="display: none;">{{__('form.contactsTelNumberValidationSize')}}</div>
            <div class="text-start invalid-feedback phoneInvalidExtension" style="display: none;">{{__('form.contactsTelExtensionValidation')}}</div>
          </div>
        </div>
      </div>
      @endif
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center mb-3">
        <button type="button" class="m-2 py-1 px-3 rounded previous-button">{{__('global.previous')}}</button><!--TODO::Mettre un nom significatif au Id-->
        <button id="contacts-button" type="button" class="m-2 py-1 px-3 rounded button-darkblue next-button">{{__('global.next')}}</button><!--TODO::Mettre un nom significatif au Id-->
      </div>
    </div>
  </div> <!--FIN CONTACT-->

  <!--PIÈCES JOINTES-->
  <div class="container bg-white rounded my-2 width-sm w-60 form-section d-none" id="attachments-section">
    <div class="row d-none d-md-block">
      <div class="col-12 rounded-top fond-image fond-attachment"></div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <h1>{{__('form.attachmentFilesTitle')}}</h1>
      </div>
    </div>
    <div class="row px-3 mb-3">
      <div class="col-12 d-flex flex-column justify-content-between mb-3">
        <h2 class="text-center h4">{{__('form.attachmentFilesSection')}}</h2>
      </div>
      <div class=" col-12 d-flex flex-column justify-content-between">
        <div class="row flex-row justify-content-between">
          <div class="col-10">
            <div>
              <input class="form-control" type="file" id="formFile" accept=".doc,.docx,.pdf,.jpg,.jpeg,.png,.bmp,.tiff,.txt,.rtf,.odt,.xls,.xlsx,.ppt,.pptx">
              <div>{{__('form.attachmentFileFormat')}}</div>
            </div>
            <div class="text-start invalid-feedback attachment" id="attachmentFileRequired" style="display: none;">{{__('form.attachmentFileRequired')}}</div>
            <div class="text-start invalid-feedback attachment" id="attachmentFileNameLength" style="display: none;">{{__('form.attachmentFileNameLength')}}</div>
            <div class="text-start invalid-feedback attachment" id="attachmentFileNameAlphaNum" style="display: none;">{{__('form.attachmentFileNameAlphaNum')}}</div>
            <div class="text-start invalid-feedback attachment" id="attachmentFileFormat" style="display: none;">{{__('form.attachmentFileFormat')}}</div>
            <div class="text-start invalid-feedback attachment" id="attachmentSameFileName" style="display: none;">{{__('form.attachmentSameFileName')}}</div>
            <div class="text-start invalid-feedback attachment" id="attachmentFilesExceedSize" style="display: none;">{{__('form.attachmentFilesExceedSize')}}</div>
          </div>
          <div class="col-2 text-center pt-1">
            <svg id="add-file" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus-circle-fill button-add-darkblue" width="30" height="30" viewBox="0 0 16 16" style="cursor: pointer;">
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
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-end inline-block">
        <p class="mb-0" id="totalSize">/<span id="maxSizeFiles">{{ $settings->file_max_size }}</span>Mo</p>
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
        <button type="button" class="m-2 py-1 px-3 rounded previous-button">{{__('global.previous')}}</button>
        <button id="submit-button" type="submit" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.submit')}}</button>
      </div>
    </div>
  </div> <!--FIN PIÈCES JOINTES-->

</form>
@endsection

@section('scripts')
<script>
  const oldCity = "{{ old('contactDetailsCitySelect') }}";
  const oldDistrictArea = "{{ old('contactDetailsDistrictArea') }}";
  const desktopString = "@lang('form.officeNumber')";
</script>
<script src="{{ asset('js/suppliersCreate/createValidationIdentification.js') }}"></script>
<script src="{{ asset('js/suppliersCreate/productsServices.js') }}"></script>
<script src="{{ asset('js/suppliersCreate/rbq.js') }} "></script>
<script src="{{ asset('js/suppliersCreate/contact.js') }} "></script>
<script src="{{ asset('js/progressBar.js') }} "></script>
<script src="{{ asset('js/suppliersCreate/contactDetails.js') }} "></script>
<script src="{{ asset('js/suppliersCreate/attachmentFiles.js') }} "></script>
<script src="{{ asset('js/suppliersCreate/formFinalValidation.js') }} "></script>
@endsection