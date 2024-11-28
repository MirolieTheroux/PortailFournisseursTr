@extends('layouts.app')

@section('title', __('global.login'))

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection


@section('content')
<div class="row h-100 bg-image-login mx-0">
  <div class="col-6 d-none d-md-flex align-items-center justify-content-center h-100 bg-grey-transparent">
    <h1 class="text-white fw-bold">{{__('login.platform')}}<br>{{__('login.suppliers')}}</h1>
  </div>
  <div class="col-12 col-md-6 d-flex align-items-center justify-content-center h-100 bg-grey-transparent-gradient py-3">
    <div class="row w-100">
      <div id="connexion-form" class="offset-md-1 offset-lg-2 offset-xl-3 col-12 col-md-10 col-lg-8 col-xl-6 bg-white rounded-custom">
        <h3 class="d-none d-md-block mt-3 text-center">{{__('login.passwordReset')}}</h3>
        <form method="POST" action="/password/reset" class="form d-flex flex-column mx-3 need-validation"  enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="text-start">
                <div id="neqContainer">
                    <div class="form-floating">
                        <input type="password" name="password" id="password" class="form-control" placeholder="" maxlength="12">
                        <label for="password">{{__('form.passwordLabel')}}</label>
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
            </div>
            <div class="col-12 d-flex flex-column justify-content-between">
                <div class="form-floating mt-3">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="" maxlength="12">
                    <label for="password_confirmation">{{__('form.passwordConfirmLabel')}}</label>
                    <div id="password_confirmationStart"></br></div>
                    <div class="valid-feedback" id="password_confirmationValid" style="display: none;"></br></div>
                    <div class="invalid-feedback" id="password_confirmationInvalidDifferent" style="display: none;">{{__('form.identificationValidationMDPConfirm')}}</div>
                </div>
                @if($errors->has('password_confirmation'))
                    <p>{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>
            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-center mb-3">
                    <button type="submit" class="py-1 px-3 rounded button-darkblue">{{__('login.passwordReset')}}</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/login/resetPassword.js') }}"></script>
@endsection