@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/supplier.css') }}">
<link rel="stylesheet" href="{{ asset('css/progressBar.css') }}">
<script src="{{ asset('js/createValidation.js') }}"></script>
@endsection

@section('content')
<form method="post" action="{{ route('suppliers.store') }}" class="need-validation" novalidate enctype="multipart/form-data">
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
    <div class="container bg-white rounded my-2">
        <div class="row d-none d-md-block">
            <div class="col-12 rounded-top fond-image fond-identification"></div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-12 text-center">
                <h1 class="section-title">{{__('form.identificationTitle')}}</h1>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.identificationCompanySection')}}</h2>
                <div class="text-start">
                    <div class="form-floating mb-3">
                        <input type="text" pattern="[0-9]+" oninput="validateIdentificationNeq()" name="neq" id="neq" class="form-control is-valid" placeholder="" maxlength="10">
                        <label for="neq">{{__('form.neqLabel')}}</label>
                        <div class="valid-feedback" id="neqValid1">Le NEQ n'est pas obligatoire.</div>
                        <div class="invalid-feedback" id="neqInvalid1" style="display: none;">Le NEQ doit débuter par 11, 22, 33 ou 88!</div>
                        <div class="invalid-feedback" id="neqInvalid2" style="display: none;">Le troisième caractère doit être 4, 5, 6, 7, 8 ou 9!</div>
                        <div class="invalid-feedback" id="neqInvalid3" style="display: none;">Le NEQ doit être composé uniquement de chiffres!</div>
                        <div class="invalid-feedback" id="neqInvalid4" style="display: none;">Le NEQ doit être composé de 10 chiffres!</div>
                        <div class="invalid-feedback" id="neqInvalid5" style="display: none;">Le NEQ est déjà enregistrer pour un autre compte!</div>
                        <div class="valid-feedback" id="neqValid2" style="display: none;"></br></div>
                    </div>
                </div>
                <div class="text-center">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" id="name" class="form-control" placeholder="" maxlength="64">
                        <label for="name">{{__('form.companyNameLabel')}}</label>
                        @if($errors->has('name'))
                        <p>{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.identificationAuthentificationSection')}}</h2>
                <div class="text-center">
                    <div class="form-floating mb-3">
                        <input type="email" name="email" id="email" class="form-control" required placeholder="example@gmail.com" maxlength="64">
                        <label for="email">{{__('form.emailLabel')}}</label>
                        @if($errors->has('email'))
                        <p>{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                </div>
                <div class="text-center">
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
                            <div class="form-floating mb-3">
                                <input type="password" name="password" id="password" required class="form-control" placeholder="" maxlength="12">
                                <label for="password">{{__('form.passwordLabel')}}</label>
                                @if($errors->has('password'))
                                <p>{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
                            <div class="form-floating mb-3">
                                <input type="password" name="password_confirmation" required id="password_confirmation" placeholder="" class="form-control" maxlength="12">
                                <label for="password_confirmation">{{__('form.passwordConfirmLabel')}}</label>
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
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button><!--TODO::Mettre un nom significatif au Id-->
                <button id="test" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button><!--TODO::Mettre un nom significatif au Id-->
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
                <h1 class="section-title">{{__('form.productsAndServiceTitle')}}</h1>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.productsAndServiceCategories')}}</h2>
                <div class="text-center">
                    
                    <div class="form-floating mb-3">
                        <select name="product-category" id="product-category" class="form-select" aria-label="">
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="opel">Opel</option>
                            <option value="audi">Audi</option>
                        </select>
                        <label for="product-category">{{__('form.productsAndServiceCategoriesList')}}</label>
                    </div>
                </div>
                <div class="text-center">
                    <div class="form-floating mb-3">
                        <input type="text" name="service-search" id="service-search" class="form-control" placeholder="">
                        <label for="service-search">{{__('form.productsAndServiceCategoriesSearch')}}</label>
                    </div>
                </div>
                <div class="text-center">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="details" id="company-name" style="height: 160px; resize: none;" maxlength="500"></textarea>
                        <label for="company-name">{{__('form.productsAndServiceCategoriesDetails')}}</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.productsAndServiceServices')}}</h2>
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
                        <label for="company-name">{{__('form.productsAndServiceServicesCategorySelection')}}</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.productsAndServiceSelectedServicesList')}}</h2>
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
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button>
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button>
            </div>
        </div>
    </div> <!--FIN PRODUIT ET SERVICE-->


    <!--LICENCE RBQ-->
    
    <!--COORDONNÉES-->
    
    <!--CONTACT-->
    
    <!--PIÈCES JOINTES-->

</form>
@endsection