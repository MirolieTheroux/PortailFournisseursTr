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
                <span class="name">{{__('form.rbqTitle')}}</span>
            </div>
            <div class="step">
                <span class="number">4</span>
                <span class="name">{{__('form.contactDetailsTitle')}}</span>
            </div>
            <div class="step">
                <span class="number">5</span>
                <span class="name">{{__('form.contactsTitle')}}</span>
            </div>
            <div class="step">
                <span class="number">6</span>
                <span class="name">Pièces jointes</span><!--TODO::Fichier de langue-->
            </div>
        </div>
    </div><!-- FIN PROGRESS BAR-->

    <!--IDENTIFICATION-->  
    <div class="d-none container bg-white rounded my-2">
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
                <h2 class="text-center">{{__('form.identificationCompanySection')}}</h2>
                <div class="text-center">
                    <label for="neq">{{__('form.neqLabel')}}</label>
                    <div class="input-group mb-3">
                        <input type="text" name="neq" id="neq" class="form-control" placeholder="XXXXXXXXXX" maxlength="10" value="{{ old('neq') }}">
                    </div>
                    @if($errors->has('neq'))
                        <p>{{ $errors->first('neq') }}</p>
                    @endif
                </div>
                <div class="text-center">
                    <label for="name">{{__('form.companyNameLabel')}}</label>
                    <div class="input-group mb-3">
                        <input type="text" name="name" id="name" class="form-control" maxlength="64" value="{{ old('name') }}">
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
                        <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" maxlength="64" value="{{ old('email') }}">
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
                <button id="test" type="submit" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button><!--TODO::Mettre un nom significatif au Id-->
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
    <div class="d-none container bg-white rounded my-2">
        <div class="row d-none d-md-block">
            <div class="col-12 rounded-top fond-image fond-rbq"></div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-12 text-center">
                <h1>{{__('form.rbqTitle')}}</h1>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-12 col-md-4 d-flex flex-column">
                <h2 class="text-center">{{__('form.rbqLicenceSection')}}</h2>
                <div class="d-flex flex-column justify-content-between just h-100">
                  <div class="text-center">
                      <div class="form-floating mb-3">
                          <input type="text" name="licenceRbq" id="licenceRbq" value="{{ old('licenceRbq') }}" class="form-control" placeholder="" maxlength="12">
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
                              <option value="valid" {{ "valid" == old('statusRbq') ? 'selected' : null }}>{{__('form.choiceValid')}}</option>
                              <option value="restrictedValid" {{ "restrictedValid" == old('statusRbq') ? 'selected' : null }}>{{__('form.choiceRestrictedValid')}}</option>
                              <option value="invalid" {{ "invalid" == old('statusRbq') ? 'selected' : null }}>{{__('form.choiceInvalid')}}</option>
                          </select>
                          <label for="statusRbq">{{__('form.statusLabel')}}</label>
                      </div>
                      @if($errors->has('statusRbq'))
                          <p>{{ $errors->first('statusRbq') }}</p>
                      @endif
                  </div>
                  <div class="text-center">
                      <div class="form-floating mb-3">
                          <select name="typeRbq" id="typeRbq" class="form-select" aria-label="">
                              <option disabled selected value>{{__('form.choiceDefaultType')}}</option>
                              <option value="entrepreneur" {{ "entrepreneur" == old('typeRbq') ? 'selected' : null }}>{{__('form.choiceEntrepreneur')}}</option>
                              <option value="ownerBuilder" {{ "ownerBuilder" == old('typeRbq') ? 'selected' : null }}>{{__('form.choiceOwnerBuilder')}}</option>
                          </select>
                          <label for="typeRbq">{{__('form.typeLabel')}}</label>
                      </div>
                      @if($errors->has('typeRbq'))
                          <p>{{ $errors->first('typeRbq') }}</p>
                      @endif
                  </div>
                </div>
            </div>
            <div class="col-12 col-md-8 d-flex flex-column justify-content-start">
              <h2 class="text-center">{{__('form.rbqCategoriesSection')}}</h2>
                <div class="text-center">
                  <div class="form-floating mb-3">
                    <div class="form-control pt-2" placeholder="details" id="company-name" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
                    <div id="no-categories" class="d-block">
                      {{__('form.rbqCategoriesUnselectedType')}}
                    </div> 
                    <div id="entrepreneur-categories" class="d-none">
                        <div class="fs-5 text-start fw-bold mb-2 title-border">{{__('form.rbqCategoriesGeneralEntrepreneur')}}</div>
                        @foreach($workSubcategories as $workSubcategory)
                          @if($workSubcategory->is_specialised == false)
                            <div class="form-check pb-2">
                              <input 
                                class="form-check-input mt-0" 
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
                                class="form-check-input mt-0" 
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
                                class="form-check-input mt-0" 
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
                                class="form-check-input mt-0" 
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
                </div>
              </div>
            </div>
        </div>
        
        @if(!is_null(old('rbqSubcategories')))
          <div id="form-fail-rbq" hidden></div>
        @endif
        
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button>
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button>
            </div>
        </div>
    </div>  <!--FIN LICENCE RBQ-->  
    
    <!--COORDONNÉES-->
    <!--REMARQUES::
      - Le padding des labels numéro dans la section numéro de téléphone et de la rue dans la section adresse ne sont pas les même que le reste
      - Est-ce que la boite des numéros de téléphones devrait être là mais vide lors du loading de la page? Serait plus clair pour le user pourquoi il doit faire le plus
      - Au lieu de "# tel" ou "# téléphone", mettre "numéro de téléphone" pour éviter la confusion de certains users?
      - Dans la boite de la liste des téléphones, si possible, je pense que se serait plus beau d'aligner tous les textes (La lignes "Liste des # téléphone" est plus proche du bord)
      - Dans la liste des villes, est-ce que c'est possible de les afficher en ordre alphabétique? Car présentement, la recherche peut-être difficile pour les users qui savent pas qu'ils peuvent écrire
      - Pour les provinces et régions, je pense que se serait bon de faire des tables dans la BD pourqu'elles ne soient pas hardcoder. Y'a peu de chance que ça change mais ça pourrait
      - Il faudrait s'assurer d'utiliser le plus possible l'anglais dans les name, id, values, etc (Voir les provinces, région et type de téléphone)
      - Ne jamais mettre d'accent dans les name, id, values, etc (Voir les provinces, région et type de téléphone)
      - Il faudrait utiliser le fichier de langue même pour les listes d'éléments (Voir les provinces, région et type de téléphone)
      - Responsive :
        - Format (md) 
            - Les labels de no civic et du code postal se confonde avec le text écrit, est-ce qu'il faudrait qu'il aie leur propre ligne à ce moment là?
            - Le boutons pour ajouter les téléphones est très petit
        - Format (sm) et moins
            - La zone des numéros de téléphones qui ont été ajouter ne marche plus très bien, les éléments sont sur 3 lignes au lieu d'une
        - Format Cellulaire dans l'inspecteur
            - Les labels de no civic et du code postal se confonde avec le text écrit, est-ce qu'il faudrait qu'il aie leur propre ligne à ce moment là?
            - Le boutons pour ajouter les téléphones est très petit
    -->
    <div class="d-none container bg-white rounded my-2">
        <div class="row d-none d-md-block">
            <div class="col-12 rounded-top fond-image fond-coordonnees"></div> <!--TODO::Trouver une autre image de fond-->
        </div>
        <div class="row">
            <div class="d-none d-md-block col-12 text-center">
                <h1 class="section-title">{{__('form.contactDetailsTitle')}}</h1>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.contactDetailsAddressSection')}}</h2>
                <div class="text-center mb-4">
                    <div class="form-floating autocomplete-container" id="autocomplete-container">
                        <input type="text" name="contactDetails-searchAddress" id="contactDetails-searchAddress" class="form-control" placeholder="">
                        <label for="contactDetails-searchAddress">{{__('form.searchAddress')}}</label>
                    </div>
                </div>
                <div class="text-center d-flex flex-row mb-4">
                    <div class="form-floating col-3">
                        <input type="text" name="contactDetails-civicNumber" id="contactDetails-civicNumber" class="form-control" placeholder="">
                        <label for="contactDetails-civicNumber">{{__('form.civicNumberLabel')}}</label>
                    </div>
                    <div class="form-floating col-6 px-2">
                        <input type="text" name="contactDetails-streetName" id="contactDetails-streetName" class="form-control" placeholder="">
                        <label for="contactDetails-streetName">{{__('form.streetName')}}</label>
                    </div>
                    <div class="form-floating col-3">
                        <input type="text" name="contactDetails-officeNumber" id="contactDetails-officeNumber" class="form-control" placeholder="">
                        <label for="contactDetails-officeNumber">{{__('form.officeNumber')}}</label>
                    </div>
                </div>
                <div class="text-center d-flex flex-row mb-4">
                    <div class="form-floating col-6 pe-2" id="div-province">
                        <select name="contactDetails-city" id="contactDetails-citySelect" class="form-select" aria-label=""></select>
                        <input type="text" name="contactDetails-inputCity" id="contactDetails-inputCity" class="form-control d-none" placeholder="">
                        <label for="contactDetails-city">{{__('form.city')}}</label>
                    </div>
                    <div class="form-floating col-6">
                        <select name="contactDetails-province" id="contactDetails-province" class="form-select" aria-label="">
                            <option value="Alberta">Alberta</option>
                            <option value="Colombie-Britannique">Colombie-Britannique</option>
                            <option value="Île-du-Prince-Édouard">Île-du-Prince-Édouard</option>
                            <option value="Manitoba">Manitoba</option>
                            <option value="Nouveau-Brunswick">Nouveau-Brunswick</option>
                            <option value="Nouvelle-Écosse">Nouvelle-Écosse</option>
                            <option value="Nunavut">Nunavut</option>
                            <option value="Ontario">Ontario</option>
                            <option value="Québec" selected>Québec</option>
                            <option value="Saskatchewan">Saskatchewan</option>
                            <option value="Terre-Neuve-et-Labrador">Terre-Neuve-et-Labrador</option>
                            <option value="Territoires du Nord-Ouest">Territoires du Nord-Ouest</option>
                            <option value="Yukon">Yukon</option>
                        </select>
                        <label for="contactDetails-province">{{__('form.province')}}</label>
                    </div>
                </div>
                <div class="text-center d-flex flex-row mb-4">
                    <div class="form-floating col-8 pe-2">
                        <select name="contactDetails-region" id="contactDetails-region" class="form-select" aria-label="">
                            <option value="Abitibi-Témiscamingue">Abitibi-Témiscamingue (région 08)</option>
                            <option value="Bas-Saint-Laurent">Bas-Saint-Laurent (région 01)</option>
                            <option value="Capitale-Nationale">Capitale-Nationale (région 03)</option>
                            <option value="Centre-du-Québec">Centre-du-Québec (région 17)</option>
                            <option value="Chaudière-Appalaches">Chaudière-Appalaches (région 12)</option>
                            <option value="Côte-Nord">Côte-Nord (région 09)</option>
                            <option value="Estrie">Estrie (région 05)</option>
                            <option value="Gaspésie–Îles-de-la-Madeleine">Gaspésie–Îles-de-la-Madeleine (région 11)</option>
                            <option value="Lanaudière">Lanaudière (région 14)</option>
                            <option value="Laurentides">Laurentides (région 15)</option>
                            <option value="Laval">Laval (région 13)</option>
                            <option value="Mauricie">Mauricie (région 04)</option>
                            <option value="Nord-du-Québec">Nord-du-Québec (région 10)</option> 
                            <option value="Outaouais">Outaouais (région 07)</option>
                            <option value="Saguenay–Lac-Saint-Jean">Saguenay–Lac-Saint-Jean (région 02)</option>
                        </select>
                        <label for="contactDetails-region">{{__('form.region')}}</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" name="contactDetails-postalCode" id="contactDetails-postalCode" class="form-control" placeholder="">
                        <label for="contactDetails-postalCode">{{__('form.postalCode')}}</label>
                    </div>
                </div>  
                <div class="text-center mb-4">
                    <div class="form-floating">
                        <input type="text" name="contactDetails-website" id="contactDetails-website" class="form-control" placeholder="">
                        <label for="contactDetails-website">{{__('form.website')}}</label>
                    </div>
                </div>  
            </div>
            <div class="col-12 col-md-6 d-flex flex-column">
                <h2 class="text-center section-subtitle">{{__('form.contactDetailsTelNumbersSection')}}</h2>
                <div class="text-center d-flex flex-row mb-4">
                    <div class="form-floating col-3">
                        <select name="contactDetails-telType" id="contactDetails-telType" class="form-select" aria-label="">
                            <option value="Bureau">Bureau</option>
                            <option value="Télécopieur">Télécopieur</option>
                            <option value="Cellulaire">Cellulaire</option>
                        </select>
                        <label for="contactDetails-telType">{{__('form.telType')}}</label>
                    </div>
                    <div class="form-floating col-5 px-2">
                        <input type="text" name="contactDetails-telNumber" id="contactDetails-telNumber" class="form-control" placeholder="">
                        <label for="contactDetails-telNumber">{{__('form.telNumber')}}</label>
                    </div>
                    <div class="form-floating col-3">
                        <input type="text" name="contactDetails-telExtension" id="contactDetails-telExtension" class="form-control" placeholder="">
                        <label for="contactDetails-telExtension">{{__('form.telExtension')}}</label>
                    </div>
                    <div class="col-1 d-flex align-items-center justify-content-center">
                        <svg id="add-icon" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="cursor: pointer; margin-left: 20px">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                        </svg>
                    </div>
                </div>
                <div class="form-floating d-none" id="div-telNumberList">
                    <label for="contactDetails-telNumberList">{{__('form.telNumberList')}}</label>  
                    <div class="form-control" id="contactDetails-telNumberList" style="overflow-x: hidden; overflow-y: auto;" >
                       <div class="row px-3">
                            <div class="col-12 col-md-12 d-flex flex-column justify-content-between">
                                <div class="row align-items-center" id="telNumberList"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button><!--TODO::Mettre un nom significatif au Id-->
                <button id="test" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button><!--TODO::Mettre un nom significatif au Id-->
            </div>
        </div>
    </div> <!--FIN COORDONÉES-->

    <!--CONTACT-->
    <div class="container bg-white rounded my-2">
        <div class="row d-none d-md-block">
            <div class="col-12 rounded-top fond-image fond-coordonnees"></div> <!--TODO::Trouver une autre image de fond-->
        </div>
        <div class="row">
            <div class="d-none d-md-block col-10 offset-1 text-center">
                <h1 class="section-title">{{__('form.contactsTitle')}}</h1>
            </div>
            <div class="col-1 d-flex align-items-center justify-content-center">
                <svg id="add-contact" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="cursor: pointer; margin-left: 20px">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                </svg>
            </div>
        </div>
        <div class="row justify-content-center px-3">
            <div id="referenceContact" class="col-6 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.contactsSubtitle')}} #1</h2>
                <div class="rounded pt-3 px-3 border">
                    <div class="row">
                        <div class="col-6 text-center mb-4">
                            <div class="form-floating">
                                <input type="text" name="contact1-firstName" id="contact1-firstName" class="form-control" placeholder="">
                                <label for="contact1-firstName">{{__('form.firstNameLabel')}}</label>
                            </div>
                        </div>
                        <div class="col-6 text-center mb-4">
                            <div class="form-floating">
                                <input type="text" name="contact1-lastName" id="contact1-lastName" class="form-control" placeholder="">
                                <label for="contact1-lastName">{{__('form.lastNameLabel')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-4">
                        <div class="form-floating">
                            <input type="text" name="contact1-job" id="contact1-job" class="form-control" placeholder="">
                            <label for="contact1-job">{{__('form.jobLabel')}}</label>
                        </div>
                    </div>  
                    <div class="text-center mb-4">
                        <div class="form-floating">
                            <input type="text" name="contact1-job" id="contact1-email" class="form-control" placeholder="">
                            <label for="contact1-email">{{__('form.emailLabel')}}</label>
                        </div>
                    </div>  
                    <h2 class="text-center section-subtitle">{{__('form.contactDetailsTelNumbersSection')}}</h2>
                    <div class="text-center d-flex flex-row mb-4">
                        <div class="form-floating col-3">
                            <select name="contactDetails-telType" id="contactDetails-telType" class="form-select" aria-label="">
                                <option value="desktop">Bureau</option>
                                <option value="fax">Télécopieur</option>
                                <option value="cellphone">Cellulaire</option>
                            </select>
                            <label for="contact1-telType">{{__('form.telType')}}</label>
                        </div>
                        <div class="form-floating col-6 px-2">
                            <input type="text" name="contact1-telNumber" id="contact1-telNumber" class="form-control" placeholder="">
                            <label class="ms-2" for="contact1-telNumber">{{__('form.telNumber')}}</label>
                        </div>
                        <div class="form-floating col-3">
                            <input type="text" name="contact1-telExtension" id="contact1-telExtension" class="form-control" placeholder="">
                            <label for="contact1-telExtension">{{__('form.telExtension')}}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button><!--TODO::Mettre un nom significatif au Id-->
                <button id="test" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button><!--TODO::Mettre un nom significatif au Id-->
            </div>
        </div>
    </div> <!--FIN CONTACT-->

    <!--PIÈCES JOINTES-->

</form>
@endsection

@section('scripts')
<script src="{{ asset('js/suppliersCreate/rbq.js') }} "></script>
@endsection