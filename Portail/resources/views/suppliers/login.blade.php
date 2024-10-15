@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="row h-100 bg-image-login">
  <div class="col-6 d-flex align-items-center justify-content-center h-100 bg-grey-transparent">
    <h1 class="text-white fw-bold">Portail<br>fournisseurs</h1>
  </div>
  <div class="col-6 d-flex align-items-center justify-content-center h-100 bg-grey-transparent-gradient p-0">
    <div class="row w-100">
      <div class="offset-3 col-6 bg-white rounded-custom">
        <div class="row">
          <div class="col-6 text-white bg-blue text-center fs-5 py-2 rounded-top-left">Entreprise</div>
          <div class="col-6 text-white bg-darkblue text-center fs-5 py-2 rounded-top-right">Particulier</div>
        </div>
        <form class="d-flex flex-column mx-3">
          <h3 class="mt-3 text-center">Connexion</h3>
          <div class="text-start">
            <div class="form-floating mb-3">
                <input type="text" name="neq" id="neq" class="form-control" placeholder="" value="{{ old('neq') }}" maxlength="10">
                <label for="neq">{{__('form.neqLabelShort')}}</label>
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
          <div class="col-12 d-flex flex-column justify-content-between">
            <div class="form-floating mb-3">
                <input type="password" name="password" id="password"  class="form-control" placeholder="" maxlength="12">
                <label for="password">{{__('form.passwordLabel')}}</label>
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
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
              <button type="button" class="py-1 px-3 rounded button-darkblue">{{__('global.login')}}</button>
            </div>
          </div>
          <div class="row">
            <div class="col-12 d-flex justify-content-center text-center mb-3">
              <a class="singin-link" href="">Soumettre une demande d'inscription</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
@endsection
