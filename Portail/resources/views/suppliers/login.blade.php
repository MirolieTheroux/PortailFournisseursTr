@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="row h-100 bg-image-login">
  <div class="col-6 d-none d-md-flex align-items-center justify-content-center h-100 bg-grey-transparent">
    <h1 class="text-white fw-bold">{{__('login.platform')}}<br>{{__('login.suppliers')}}</h1>
  </div>
  <div class="col-12 col-md-6 d-flex align-items-center justify-content-center h-100 bg-grey-transparent-gradient py-3">
    <div class="row w-100">
      <div class="offset-md-1 offset-lg-2 offset-xl-3 col-12 col-md-10 col-lg-8 col-xl-6 bg-white rounded-custom">
        <!--TODO::Programer le changement de formulaire selon les réponses des employés de la ville-->
        <div class="row d-none d-md-flex">
          <div id="company-button" class="col-6 text-white bg-blue text-center fs-5 py-3 rounded-top-left">{{__('login.company')}}</div>
          <div id="particular-button" class="col-6 text-white bg-darkblue text-center fs-5 py-3 rounded-top-right">{{__('login.particular')}}</div>
        </div>
        <h3 class="d-md-none mt-3 text-center">{{__('login.platform')}} {{__('login.suppliers')}}</h3>
        <h3 class="d-none d-md-block mt-3 text-center">{{__('global.login')}}</h3>
        <form method="post" action="{{route('suppliers.login') }}" id="company-form" class="form d-flex flex-column mx-3">
        @csrf
          <div class="text-start">
            <div class="form-floating">
                <input type="text" name="id" id="id" class="form-control" placeholder="" value="{{ old('id') }}">
                <label for="neq">{{__('login.id')}}</label>
            </div>
            @if($errors->has('id'))
              <div class="invalid-feedback-custom">{{ $errors->first('id') }}</div>
            @endif
          </div>
          <div class="col-12 d-flex flex-column justify-content-between">
            <div class="form-floating mt-3">
                <input type="password" name="password" id="password"  class="form-control" placeholder="" value="{{ old('password') }}">
                <label for="password">{{__('form.passwordLabel')}}</label>
            </div>
            @if($errors->has('password'))
              <div class="invalid-feedback-custom">{{ $errors->first('password') }}</div>
            @endif
          </div>
          <div class="row mt-3">
            <div class="col-12 d-flex justify-content-center mb-3">
              <button type="submit" class="py-1 px-3 rounded button-darkblue">{{__('global.login')}}</button>
            </div>
          </div>
          <div class="row">
            <div class="col-12 d-flex justify-content-center text-center mb-3">
              <a class="singin-link" href="{{ route('suppliers.create') }}">{{__('login.signinLink')}}</a>
            </div>
          </div>
          <div class="row d-md-none">
            <!--TODO::Programer le changement de formulaire selon les réponses des employés de la ville-->
            <div class="col-12 d-flex justify-content-center text-center mb-3">
              <a class="singin-link" href="">{{__('login.imAParticular')}}</a>
              <a class="singin-link d-none" href="">{{__('login.imACompany')}}</a>
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
