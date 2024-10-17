@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="row h-100 bg-image-login mx-0">
  <div class="col-6 d-none d-md-flex align-items-center justify-content-center h-100 bg-grey-transparent">
    <h1 class="text-white fw-bold">{{__('login.managing')}}<br>{{__('login.suppliers')}}</h1>
  </div>
  <div class="col-12 col-md-6 d-flex align-items-center justify-content-center h-100 bg-grey-transparent-gradient py-3">
    <div class="row w-100">
      <div class="offset-md-1 offset-lg-2 offset-xl-3 col-12 col-md-10 col-lg-8 col-xl-6 bg-white rounded-custom">
        <h3 class="d-md-none mt-3 text-center">{{__('login.managing')}} {{__('login.suppliers')}}</h3>
        <h3 class="d-none d-md-block mt-3 text-center">{{__('global.login')}}</h3>
        <form method="post" action="{{route('users.login') }}" id="company-form" class="form d-flex flex-column mx-3">
        @csrf
          <div class="text-start">
            <div class="form-floating">
                <input type="text" name="email" id="email" class="form-control" placeholder="" value="{{ old('email') }}">
                <label for="email">{{__('login.emailLabel')}}</label>
            </div>
            @if($errors->has('email'))
              <div class="invalid-feedback-custom">{{ $errors->first('email') }}</div>
            @endif
          </div>
          <div class="col-12 d-flex flex-column justify-content-between">
            <div class="form-floating mt-3">
                <input type="password" name="password" id="password"  class="form-control" placeholder="" value="{{ old('password') }}">
                <label for="password">{{__('login.passwordLabel')}}</label>
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
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@endsection