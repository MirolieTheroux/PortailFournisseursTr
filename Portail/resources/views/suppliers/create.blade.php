@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/supplier.css') }}">
@endsection

@section('content')
<form method="post" action="{{ route('suppliers.store') }}" enctype="multipart/form-data">
@csrf
    <!--IDENTIFICATION-->
    <div class="container bg-white rounded my-2">
        <div class="row d-none d-md-block">
            <div class="col-12 rounded-top fond-image fond-identification"></div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-12 text-center">
                <h1>{{__('form.identificationTitle')}}</h1>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center">{{__('form.identificationCompanySection')}}</h2>
                <div class="text-center">
                    <label for="neq">{{__('form.neqLabel')}}</label>
                    <div class="input-group mb-3">
                        <input type="text" name="neq" id="neq" class="form-control" placeholder="XXXXXXXXXX" maxlength="10">
                    </div>
                    @if($errors->has('neq'))
                        <p>{{ $errors->first('neq') }}</p>
                    @endif
                </div>
                <div class="text-center">
                    <label for="name">{{__('form.companyNameLabel')}}</label>
                    <div class="input-group mb-3">
                        <input type="text" name="name" id="name" class="form-control" maxlength="64">
                    </div>
                    @if($errors->has('name'))
                        <p>{{ $errors->first('name') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-8 d-flex flex-column justify-content-between">
                <h2 class="text-center">{{__('form.identificationAuthentificationSection')}}</h2>
                <div class="text-center">
                    <label for="email">{{__('form.emailLabel')}}</label>
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" maxlength="64">
                    </div>
                    @if($errors->has('email'))
                        <p>{{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="container-fluid text-center d-md-flex justify-content-between align-items-end p-0">
                    <div class="col-12 col-md-6 pe-md-3">
                        <label for="password">{{__('form.passwordLabel')}}</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" maxlength="12">
                        </div>
                        @if($errors->has('password'))
                            <p>{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <div class="col-12 col-md-6 ps-md-3">
                        <label for="password_confirmation">{{__('form.passwordConfirmLabel')}}</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" maxlength="12">
                        </div>
                        @if($errors->has('password_confirmation'))
                            <p>{{ $errors->first('password_confirmation') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button>
                <button type="submit" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button>
            </div>
        </div>
    </div>  <!--FIN IDENTIFICATION-->  

    
    <!--PRODUIT ET SERVICE-->
    
    <!--LICENCE RBQ-->
    
    <!--COORDONNÉES-->
    
    <!--CONTACT-->
    
    <!--PIÈCES JOINTES-->

</form>
@endsection