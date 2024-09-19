@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/supplier.css') }}">
<link rel="stylesheet" href="{{ asset('css/progressBar.css') }}">
@endsection

@section('content')
<form method="post" action="{{ route('suppliers.store') }}" enctype="multipart/form-data">
@csrf
    <!--PROGRESS BAR-->
    <!--TODO::Attention, faire que la ligne blanche n'apparaisse pas dans la pointe-->
    <!--TODO::Attention, fait le ménage dans tes MediaQuery-->
    <div class="container-fluid d-flex justify-content-center">		
        <div class="arrow-steps mt-3">
            <div class="step current">
                <span class="number">1</span>
                <span class="name">{{__('form.identificationTitle')}}</span>
            </div>
            <div class="step">
                <span class="number">2</span>
                <span class="name">Produits et services</span><!--TODO::Fichier de langue-->
            </div>
            <div class="step">
                <span class="number">3</span>
                <span class="name">Licence RBQ</span><!--TODO::Fichier de langue-->
            </div>
            <div class="step">
                <span class="number">4</span>
                <span class="name">Coordonnées</span><!--TODO::Fichier de langue-->
            </div>
            <div class="step">
                <span class="number">5</span>
                <span class="name">Contacts</span><!--TODO::Fichier de langue-->
            </div>
            <div class="step">
                <span class="number">6</span>
                <span class="name">Pièces jointes</span><!--TODO::Fichier de langue-->
            </div>
        </div>
    </div><!-- FIN PROGRESS BAR-->

    <!--IDENTIFICATION-->  
    <!--TODO::Le titre de la section disparaît pour l'écran mobile-->
    <div class="d-none container bg-white rounded my-2">
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
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button><!--TODO::Mettre un nom significatif au Id-->
                <button id="test" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button><!--TODO::Mettre un nom significatif au Id-->
            </div>
        </div>
    </div>  <!--FIN IDENTIFICATION-->  

    
    <!--PRODUIT ET SERVICE-->
    <div class="d-none container bg-white rounded my-2">
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
                        <textarea class="form-control" placeholder="details" id="company-name" style="height: 160px; resize: none;" maxlength="500"></textarea>
                        <label for="company-name">Détails et spécifications</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">Services</h2>
                <div>
                    <div class="form-floating mb-3">
                        <div class="form-control" placeholder="details" id="company-name" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
                            <div class="form-check">
                                <div class="row align-items-center">
                                    <div class="col-1 col-md-1 d-flex flex-column justify-content-between">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    </div>
                                    <div class="col-3 col-md-4 d-flex flex-column justify-content-start">
                                        <label class="form-check-label" for="flexCheckDefault">05736535</label>
                                    </div>
                                    <div class="col-3 col-md-7 d-flex flex-column justify-content-start">
                                        <label class="form-check-label" for="flexCheckDefault">Service d'entretien ménager</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="company-name">Sélectionnez une catégorie</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">Liste des services choisis</h2>
                <div>
                    <div class="form-floating mb-3">
                        <div class="form-control" id="company-name" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
                            <div class="row px-3">
                                <div class="col-12 col-md-12 d-flex flex-column justify-content-between">
                                    <label class="" for="flexCheckDefault">Service d'entretien ménager</label>
                                </div>
                            </div>
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
    <div class="container bg-white rounded my-2">
        <div class="row d-none d-md-block">
            <div class="col-12 rounded-top fond-image fond-rbq"></div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-12 text-center">
                <h1>{{__('form.rbqTitle')}}</h1>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center">{{__('form.rbqLicenceSection')}}</h2>
                <div class="text-center">
                    <div class="form-floating mb-3">
                        <input type="text" name="licenceRbq" id="licenceRbq" class="form-control" placeholder="XXXX-XXXX-XX" maxlength="12">
                        <label for="licenceRbq">{{__('form.numberLabel')}}</label>
                    </div>
                    @if($errors->has('licenceRbq'))
                        <p>{{ $errors->first('licenceRbq') }}</p>
                    @endif
                </div>
                <div class="text-center">
                    <div class="form-floating mb-3">
                        <select name="statusRbq" id="statusRbq" class="form-select" aria-label="">
                            <option disabled selected value>{{__('form.choiceDefaultStatus')}}</option>
                            <option value="valid">{{__('form.choiceValid')}}</option>
                            <option value="restrictedValid">{{__('form.choiceRestrictedValid')}}</option>
                            <option value="invalid">Non valide</option>
                        </select>
                        <label for="statusRbq">{{__('form.choiceInvalid')}}</label>
                    </div>
                    @if($errors->has('statusRbq'))
                        <p>{{ $errors->first('statusRbq') }}</p>
                    @endif
                </div>
                <div class="text-center">
                    <div class="form-floating mb-3">
                        <select name="typeRbq" id="typeRbq" class="form-select" aria-label="">
                            <option disabled selected value>{{__('form.choiceDefaultType')}}</option>
                            <option value="entrepreneur">{{__('form.choiceEntrepreneur')}}</option>
                            <option value="ownerBuilder">{{__('form.choiceOwnerBuilder')}}</option>
                        </select>
                        <label for="typeRbq">{{__('form.typeLabel')}}</label>
                    </div>
                    @if($errors->has('typeRbq'))
                        <p>{{ $errors->first('typeRbq') }}</p>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-8 d-flex flex-column justify-content-between">
                <h2 class="text-center">{{__('form.rbqCategoriesSection')}}</h2>
                <div class="text-center">
                <div class="form-floating mb-3">
                        <div class="form-control pt-2" placeholder="details" id="company-name" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
                            <div class="fs-5 text-start fw-bold mb-2 title-border">Catégorie entrepreneur général</div>
                            <div class="form-check pb-2">
                                <input class="form-check-input mt-0" type="checkbox" value="" id="flexCheckDefault">
                                <div class="d-flex">
                                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckDefault">
                                        15.1.1
                                    </label>
                                    <label class="form-check-label text-start ps-2" for="flexCheckDefault">
                                        Systèmes de chauffage à air pulsé pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie
                                    </label>
                                </div>
                            </div>
                            <div class="form-check pb-2">
                                <input class="form-check-input mt-0" type="checkbox" value="" id="flexCheckDefault">
                                <div class="d-flex">
                                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckDefault">
                                        15.2
                                    </label>
                                    <label class="form-check-label text-start ps-2" for="flexCheckDefault">
                                        Systèmes de brûleurs au gaz naturel
                                    </label>
                                </div>
                            </div>
                            <div class="fs-5 text-start fw-bold mb-2 title-border">Catégorie entrepreneur spécialisé</div>
                            <div class="form-check pb-2">
                                <input class="form-check-input mt-0" type="checkbox" value="" id="flexCheckDefault">
                                <div class="d-flex">
                                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckDefault">
                                        15.2.1
                                    </label>
                                    <label class="form-check-label text-start ps-2" for="flexCheckDefault">
                                        Systèmes de brûleurs au gaz naturel pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie
                                    </label>
                                </div>
                            </div>
                            <div class="form-check pb-2">
                                <input class="form-check-input mt-0" type="checkbox" value="" id="flexCheckDefault">
                                <div class="d-flex">
                                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckDefault">
                                        15.3
                                    </label>
                                    <label class="form-check-label text-start ps-2" for="flexCheckDefault">
                                        Systèmes de brûleurs à l’huile
                                    </label>
                                </div>
                            </div>
                            <div class="form-check pb-2">
                                <input class="form-check-input mt-0" type="checkbox" value="" id="flexCheckDefault">
                                <div class="d-flex">
                                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckDefault">
                                        15.3.1
                                    </label>
                                    <label class="form-check-label text-start ps-2" for="flexCheckDefault">
                                        Systèmes de brûleurs à l’huile pour certains travaux qui ne sont pas réservés exclusivement aux maîtres mécaniciens en tuyauterie
                                    </label>
                                </div>
                            </div>
                        </div>
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
    </div>  <!--FIN LICENCE RBQ-->  
    
    <!--COORDONNÉES-->
    
    <!--CONTACT-->
    
    <!--PIÈCES JOINTES-->

</form>
@endsection