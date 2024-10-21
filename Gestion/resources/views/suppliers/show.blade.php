@extends('layouts.app')

@section('css')
@endsection

@section('title', 'Gestion - ' . $supplier->name)

@section('content')
<div class="container-fluid h-100">
  <div class="row h-100">
    <div class="col-2 bg-white h-100 full-viewport sticky-under-navbar d-flex flex-column justify-content-between">
      <h5 class="text-center py-2 fw-bold">{{$supplier->name}}</h5>
      <a>
        <h6 class="text-center py-2">{{__('zoom.requestStatus')}}</h6>
      </a>
      <a>
        <h6 class="text-center py-2">{{__('zoom.identification')}}</h6>
      </a>
      <a>
        <h6 class="text-center py-2">{{__('zoom.contactDetails')}}</h6>
      </a>
      <a>
        <h6 class="text-center py-2">{{__('zoom.productsAndServices')}}</h6>
      </a>
      <a>
        <h6 class="text-center py-2">{{__('zoom.rqbLicence')}}</h6>
      </a>
      <a>
        <h6 class="text-center py-2">{{__('zoom.attachmentFiles')}}</h6>
      </a>
      <a>
        <h6 class="text-center py-2">{{__('zoom.finance')}}</h6>
      </a>
    </div>

    <div class="col-10 h-100 px-5 d-flex align-items-center justify-content-center">
      <!--IDENTIFICATION-->
      <div class=" bg-white rounded my-2 form-section px-3 " id="identification-section">
        <div class="row">
          <div class="col-12 text-center">
            <h1>{{__('form.identificationTitle')}}</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-6 d-flex flex-column justify-content-between">
            <div class="d-flex flex-column justify-content-between h-100">
              <div class="text-start">
                <div class="form-floating mb-3">
                  <input type="text" name="neq" id="neq" class="form-control" placeholder="" value="{{ old('neq') }}" maxlength="10">
                  <label for="neq">{{__('form.neqLabel')}}</label>
                  <div class="invalid-feedback" id="neqInvalidStart" style="display: none;">{{__('validation.starts_with', ['attribute' => 'NEQ', 'values' => '11, 22, 33 ou 88'])}}</div>
                  <div class="invalid-feedback" id="neqInvalidThird" style="display: none;">{{__('form.identificationValidationNEQ3rd')}}</div>
                  <div class="invalid-feedback" id="neqInvalidCharacters" style="display: none;">{{__('form.identificationValidationNEQOnlyDigits')}}</div>
                  <div class="invalid-feedback" id="neqInvalidAmount" style="display: none;">{{__('form.identificationValidationNEQAmount')}}</div>
                  <div class="invalid-feedback" id="neqInvalidExist" style="display: none;">{{__('form.identificationNeqExistValidation')}}</div>
                </div>
                @if($errors->has('neq'))
                <p>{{ $errors->first('neq') }}</p>
                @endif
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="text-start">
              <div class="form-floating mb-3">
                <input type="text" name="name" id="name" class="form-control" placeholder="" value="{{ old('name') }}" maxlength="64">
                <label for="name">{{__('form.companyNameLabel')}}</label>
                <div class="valid-feedback" id="nameValid" style="display: none;"></div>
                <div class="invalid-feedback" id="nameInvalidEmpty" style="display: none;">{{__('validation.required', ['attribute' => 'Nom d\'entreprise'])}}</div>
              </div>
              @if($errors->has('name'))
              <p>{{ $errors->first('name') }}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="text-start">
            <div class="form-floating mb-3">
              <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" value="{{ old('email') }}" maxlength="64">
              <label for="email">{{__('form.emailLabel')}}</label>
              <div class="invalid-feedback" id="emailInvalidEmpty" style="display: none;">{{__('validation.required', ['attribute' => 'Adresse courriel'])}}</div>
              <div class="invalid-feedback" id="emailInvalidStart" style="display: none;">{{__('form.identificationValidationEmailStartWithArobase')}}</div>
              <div class="invalid-feedback" id="emailInvalidNoArobase" style="display: none;">{{__('form.identificationValidationEmailArobaseRequired')}}</div>
              <div class="invalid-feedback" id="emailInvalidManyArobase" style="display: none;">{{__('form.identificationValidationEmailOneArobaseOnly')}}</div>
              <div class="invalid-feedback" id="emailInvalidEmptyDomain" style="display: none;">{{__('form.identificationValidationEmailDomain')}}</div>
              <div class="invalid-feedback" id="emailInvalidDomainFormat" style="display: none;">{{__('form.identificationValidationEmailDomainContainDot')}}</div>
              <div class="invalid-feedback" id="emailInvalidDomainDot" style="display: none;">{{__('form.identificationValidationEmailDomainDotWrongPosition')}}</div>
              <div class="invalid-feedback" id="emailInvalidUnique" style="display: none;">{{__('form.identificationValidationEmailUnique')}}</div>
            </div>
            @if($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
            @endif
          </div>
        </div>
        <div class="row">
          <div class="col-12 d-flex justify-content-center mb-2">
            <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.edit')}}</button>
            <button id="identification-button" type="button" class="m-2 py-1 px-3 rounded button-darkblue next-button">{{__('global.save')}}</button>
          </div>
        </div>
      </div> <!--FIN IDENTIFICATION-->
    </div>
  </div>
</div>
@endsection

@section('scripts')
@endsection