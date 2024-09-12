@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/supplier.css') }}">
@endsection

@section('content')
<form method="post" action="">
@csrf
    <!--IDENTIFICATION-->
    <div class="container bg-white rounded my-2" style="display:none">
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
                </div>
                <div class="text-center">
                    <label for="company-name">{{__('form.companyNameLabel')}}</label>
                    <div class="input-group mb-3">
                        <input type="text" name="company-name" id="company-name" class="form-control" maxlength="64">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 d-flex flex-column justify-content-between">
                <h2 class="text-center">{{__('form.identificationAuthentificationSection')}}</h2>
                <div class="text-center">
                    <label for="company-email">{{__('form.emailLabel')}}</label>
                    <div class="input-group mb-3">
                        <input type="text" name="company-email" id="company-email" class="form-control" placeholder="example@gmail.com" maxlength="64">
                    </div>
                </div>
                <div class="container-fluid text-center d-md-flex justify-content-between align-items-end p-0">
                    <div class="col-12 col-md-6 pe-md-3">
                        <label for="company-name">{{__('form.passwordLabel')}}</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" maxlength="12">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 ps-md-3">
                        <label for="company-name">{{__('form.passwordConfirmLabel')}}</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password-confirm" id="password-confirm" class="form-control" maxlength="12">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button>
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button>
            </div>
        </div>
    </div>  <!--FIN IDENTIFICATION-->  

    
    <!--PRODUIT ET SERVICE-->
    <div class="container bg-white rounded my-2">
        <div class="row d-none d-md-block">
            <div class="col-12 rounded-top fond-image fond-products_services"></div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-12 text-center">
                <h1 class="section-title">Produits et Services Offerts</h1>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">Catégorie</h2>
                <div class="text-center">
                    
                    <div class="form-floating mb-3">
                        <select name="product-category" id="product-category" class="form-select" aria-label="">
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                        </select>
                        <label for="product-category">Liste des catégories</label>
                    </div>
                </div>
                <div class="text-center">
                    <div class="form-floating mb-3">
                        <input type="text" name="service-search" id="service-search" class="form-control" placeholder="">
                        <label for="service-search">Recherche d'un service</label>
                    </div>
                </div>
                <div class="text-center">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="" id="company-name" style="height: 160px; resize: none;" maxlength="128"></textarea>
                        <label for="company-name">Détails et spécifications</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">Services</h2>
                <div class="text-center">
                    <label for="company-email" class="form-label">Adresse courriel</label>
                    <div class="input-group mb-3">
                        <input type="text" name="company-email" id="company-email" class="form-control" placeholder="example@gmail.com">
                    </div>
                </div>
                <div class="container-fluid text-center d-md-flex justify-content-between align-items-end p-0">
                    <div class="col-12 col-md-6 pe-md-3">
                        <label for="company-name" class="form-label">Mot de passe</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 ps-md-3">
                        <label for="company-name" class="form-label">Confirmer</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password-confirm" id="password-confirm" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">Liste des services choisis</h2>
                <div class="text-center">
                    <label for="company-email" class="form-label">Adresse courriel</label>
                    <div class="input-group mb-3">
                        <input type="text" name="company-email" id="company-email" class="form-control" placeholder="example@gmail.com">
                    </div>
                </div>
                <div class="container-fluid text-center d-md-flex justify-content-between align-items-end p-0">
                    <div class="col-12 col-md-6 pe-md-3">
                        <label for="company-name" class="form-label">Mot de passe</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 ps-md-3">
                        <label for="company-name" class="form-label">Confirmer</label>
                        <div class="input-group mb-3">
                            <input type="password" name="password-confirm" id="password-confirm" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">Annuler</button>
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">Suivant</button>
            </div>
        </div>
    </div> <!--FIN PRODUIT ET SERVICE-->


    <!--LICENCE RBQ-->
    
    <!--COORDONNÉES-->
    
    <!--CONTACT-->
    
    <!--PIÈCES JOINTES-->

</form>
@endsection