@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/supplier.css') }}">
<link rel="stylesheet" href="{{ asset('css/progressBar.css') }}">
@endsection

@section('content')
<form method="post" action="{{ route('suppliers.store') }}" class="need-validation" enctype="multipart/form-data">
  @csrf
  <!--PROGRESS BAR-->
  <!--TODO::Attention, faire que la ligne blanche n'apparaisse pas dans la pointe-->
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
    <div class="container bg-white rounded my-2">
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
                <h2 class="text-center section-subtitle">{{__('form.identificationCompanySection')}}</h2>
                <div class="d-flex flex-column justify-content-between h-100">
                  <div class="text-start">
                      <div class="form-floating mb-3">
                          <input type="text" name="neq" id="neq" class="form-control" placeholder="" value="{{ old('neq') }}" maxlength="10">
                          <label for="neq">{{__('form.neqLabel')}}</label>
                          <div class="invalid-feedback" id="neqInvalidStart" style="display: none;">{{__('validation.starts_with', ['attribute' => 'NEQ', 'values' => '11, 22, 33 ou 88'])}}</div>
                          <div class="invalid-feedback" id="neqInvalidThird" style="display: none;">{{__('form.productsAndServiceValidationNEQ3rd')}}</div>
                          <div class="invalid-feedback" id="neqInvalidCharacters" style="display: none;">{{__('form.productsAndServiceValidationNEQOnlyDigits')}}</div>
                          <div class="invalid-feedback" id="neqInvalidAmount" style="display: none;">{{__('form.productsAndServiceValidationNEQAmount')}}</div>
                          <div class="invalid-feedback" id="neqInvalidExist" style="display: none;">{{__('form.identificationNeqExistValidation')}}</div>
                      </div>
                      @if($errors->has('neq'))
                        <p>{{ $errors->first('neq') }}</p>
                      @endif
                  </div>
                  <div class="text-start">
                      <div class="form-floating mb-3">
                          <input type="text" name="name" id="name" class="form-control" placeholder="" value="{{ old('name') }}" maxlength="64">
                          <label for="name">{{__('form.companyNameLabel')}}</label>
                          <div id="nameStart"></br></div>
                          <div class="valid-feedback" id="nameValid" style="display: none;"></br></div>
                          <div class="invalid-feedback" id="nameInvalidEmpty" style="display: none;">{{__('validation.required', ['attribute' => 'Nom d\'entreprise'])}}</div>
                      </div>
                      @if($errors->has('name'))
                        <p>{{ $errors->first('name') }}</p>
                      @endif
                  </div>
                </div>
            </div>
            <div class="col-12 col-md-8 d-flex flex-column justify-content-between">
                <h2 class="text-center section-subtitle">{{__('form.identificationAuthentificationSection')}}</h2>
                <div class="d-flex flex-column justify-content-between h-100">
                  <div class="text-start">
                      <div class="form-floating mb-3">
                          <input type="email" name="email" id="email" class="form-control"  placeholder="example@gmail.com" value="{{ old('email') }}" maxlength="64" required>
                          <label for="email">{{__('form.emailLabel')}}</label>
                          <div class="invalid-feedback" id="emailInvalidEmpty" style="display: none;">{{__('validation.required', ['attribute' => 'Adresse courriel'])}}</div>
                          <div class="invalid-feedback" id="emailInvalidStart" style="display: none;">{{__('form.productsAndServiceValidationEmailStartWithArobase')}}</div>
                          <div class="invalid-feedback" id="emailInvalidNoArobase" style="display: none;">{{__('form.productsAndServiceValidationEmailArobaseRequired')}}</div>
                          <div class="invalid-feedback" id="emailInvalidManyArobase" style="display: none;">{{__('form.productsAndServiceValidationEmailOneArobaseOnly')}}</div>
                          <div class="invalid-feedback" id="emailInvalidEmptyDomain" style="display: none;">{{__('form.productsAndServiceValidationEmailDomain')}}</div>
                          <div class="invalid-feedback" id="emailInvalidDomainFormat" style="display: none;">{{__('form.productsAndServiceValidationEmailDomainContainDot')}}</div>
                          <div class="invalid-feedback" id="emailInvalidDomainDot" style="display: none;">{{__('form.productsAndServiceValidationEmailDomainDotWrongPosition')}}</div>
                      </div>
                      @if($errors->has('email'))
                        <p>{{ $errors->first('email') }}</p>
                      @endif
                  </div>
                  <div class="text-start">
                      <div class="row">
                          <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
                              <div class="form-floating mb-3">
                                  <input type="password" name="password" id="password"  class="form-control" placeholder="" maxlength="12" required>
                                  <label for="password">{{__('form.passwordLabel')}}</label>
                                  <div id="passwordStart"></br></div>
                                  <div class="valid-feedback" id="passwordValid" style="display: none;"></br></div>
                                  <div class="invalid-feedback" id="passwordInvalidEmpty" style="display: none;">{{__('validation.required', ['attribute' => 'Mot de passe'])}}</div>
                                  <div class="invalid-feedback" id="passwordInvalidAmount" style="display: none;">{{__('form.productsAndServiceValidationMDPAmount')}}</div>
                                  <div class="invalid-feedback" id="passwordInvalidLowercase" style="display: none;">{{__('form.productsAndServiceValidationMDPLowercase')}}</div>
                                  <div class="invalid-feedback" id="passwordInvalidUppercase" style="display: none;">{{__('form.productsAndServiceValidationMDPUppercase')}}</div>
                                  <div class="invalid-feedback" id="passwordInvalidNumber" style="display: none;">{{__('form.productsAndServiceValidationMDPDigits')}}</div>
                                  <div class="invalid-feedback" id="passwordInvalidSpecial" style="display: none;">{{__('form.productsAndServiceValidationMDPSpecial')}}</div>
                              </div>
                              @if($errors->has('password'))
                                <p>{{ $errors->first('password') }}</p>
                              @endif
                          </div>
                          <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
                              <div class="form-floating mb-3">
                                  <input type="password" name="password_confirmation" required id="password_confirmation" placeholder="" class="form-control" maxlength="12">
                                  <label for="password_confirmation">{{__('form.passwordConfirmLabel')}}</label>
                                  <div id="password_confirmationStart"></br></div>
                                  <div class="valid-feedback" id="password_confirmationValid" style="display: none;"></br></div>
                                  <div class="invalid-feedback" id="password_confirmationInvalidDifferent" style="display: none;">{{__('form.productsAndServiceValidationMDPConfirm')}}</div>
                              </div>
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
                <button id="identification-button" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button><!--TODO::Mettre un nom significatif au Id-->
            </div>
        </div>
    </div>  <!--FIN IDENTIFICATION-->

  <!--PRODUIT ET SERVICE-->
  <!--NICE_TO_HAVE::Drag and drop pour les catégories-->
  <div class="container bg-white rounded my-2">
    <div class="row d-none d-md-block">
      <div class="col-12 rounded-top fond-image fond-products_services"></div>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="section-title">{{__('form.productsAndServiceTitle')}}</h1>
      </div>
    </div>
    <div class="row px-3">
      <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
        <h2 class="text-center section-subtitle">{{__('form.productsAndServiceCategories')}}</h2>
        <div class="text-center">
          <div class="form-floating mb-3">
            <input type="text" name="service-search" id="service-search" class="form-control" placeholder="">
            <label for="service-search">{{__('form.productsAndServiceCategoriesSearch')}}</label>
          </div>
        </div>
        <div class="text-center">
          <div class="form-floating mb-3">
            <textarea class="form-control" name="product_service_detail" placeholder="details" id="company-name" style="height: 160px; resize: none;" maxlength="500"></textarea>
            <label for="company-name" class="labelbackground">{{__('form.productsAndServiceCategoriesDetails')}}</label>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
        <h2 class="text-center section-subtitle">{{__('form.productsAndServiceServices')}}</h2>
        <div>
          <div class="form-floating mb-3">
            <div class="form-control" placeholder="details" id="company-name" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
              <div class="mt-lg-0 mt-md-4">
                @php
                  $totalDisplayed = 0; // Counter to track the number of displayed productServices
                @endphp
                @foreach($productServiceCategories as $productServiceCategory)
                  @if ($totalDisplayed >= 50)
                    @break
                  @endif
                  <div style="color: red;">{{$productServiceCategory->nature}}</div>
                  @foreach($productServiceSubCategories->where('nature', $productServiceCategory->nature) as $productServiceSubCategory)
                    @if ($totalDisplayed >= 50)
                      @break
                    @endif
                    <div style="color: blue;">{{$productServiceSubCategory->name}}</div>
                    @foreach($productServices->where('category_code', $productServiceSubCategory->code) as $productService)
                      @if ($totalDisplayed >= 50)
                        @break
                      @endif
                      <div class="row align-items-start mt-2">
                        <div class="col-1 col-md-1 d-flex flex-column justify-content-start">
                          <input class="form-check-input" type="checkbox" onclick="checkedbox(this)" id="category{{ $loop->index }}" value="">
                        </div>
                        <div class="col-3 col-md-3 d-flex flex-column justify-content-start">
                          <label class="form-check-label" for="category{{ $loop->index }}">{{$productService->code}}</label>
                        </div>
                        <div class="col-8 col-md-8 d-flex flex-column justify-content-start">
                          <label class="form-check-label" for="category{{ $loop->index }}">{{$productService->description}}</label>
                        </div>
                      </div>
                      @php
                        $totalDisplayed++; // Increment the counter
                      @endphp
                    @endforeach
                  @endforeach
                @endforeach
              </div>
            </div>
            <label for="company-name" class="labelbackground">{{__('form.productsAndServiceServicesCategorySelection')}}</label>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
        <h2 class="text-center section-subtitle">{{__('form.productsAndServiceSelectedServicesList')}}</h2>
        <div>
          <div class="form-floating mb-3">
            <div class="form-control" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
              <div class="row px-3">
                <div class="col-12 col-md-12 d-flex flex-column justify-content-between">
                  <label class="mb-2" id="selectedcategory1" for="category1" style="display:none;">Service d'entretien ménager</label>
                  <label class="mb-2" id="selectedcategory2" for="category2" style="display:none;">Service d'entretien de pelouse</label>
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
        <button onclick="fetchRBQ()" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button>
      </div>
    </div>
  </div> <!--FIN PRODUIT ET SERVICE-->

      <!--LICENCE RBQ-->
    <!--NICE_TO_HAVE::Formater automatiquement le numéro de licence RBQ-->
    <div class="container bg-white rounded my-2">
        <div class="row d-none d-md-block">
            <div class="col-12 rounded-top fond-image fond-rbq"></div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h1>{{__('form.rbqTitle')}}</h1>
            </div>
        </div>
        <div class="row px-3">
            <div class="col-12 col-md-4 d-flex flex-column">
                <h2 class="text-center">{{__('form.rbqLicenceSection')}}</h2>
                <div class="d-flex flex-column justify-content-between h-100">
                  <div class="text-center">
                      <div class="form-floating mb-3">
                          <input type="text" name="licenceRbq" id="licenceRbq" value="{{ old('licenceRbq') }}" class="form-control" placeholder="" maxlength="10">
                          <label for="licenceRbq">{{__('form.numberLabel')}}</label>
                          <div class="text-start invalid-feedback licenceInvalidNumber" style="display: none;">{{__('form.rbqLicenceValidation')}}</div>
                          <div class="text-start invalid-feedback licenceInvalidSize" style="display: none;">{{__('form.rbqLicenceValidationSize')}}</div>
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
                          <div class="text-start invalid-feedback statusInvalidRequired" style="display: none;">{{__('form.rbqStatusValidationRequired')}}</div>
                          <div class="text-start invalid-feedback statusInvalidRequiredNot" style="display: none;">{{__('form.rbqStatusValidationRequiredNot')}}</div>
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
                          <div class="text-start invalid-feedback typeInvalidRequired" style="display: none;">{{__('form.rbqTypeValidationRequired')}}</div>
                          <div class="text-start invalid-feedback typeInvalidRequiredNot" style="display: none;">{{__('form.rbqTypeValidationRequiredNot')}}</div>
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
                    <div id="subcategories-container" class="form-control pt-2" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
                      <div id="no-categories" class="d-block">
                        {{__('form.rbqCategoriesUnselectedType')}}
                      </div>
                      <div id="entrepreneur-categories" class="d-none">
                        <div class="fs-5 text-start fw-bold mb-2 title-border">{{__('form.rbqCategoriesGeneralEntrepreneur')}}</div>
                        @foreach($workSubcategories as $workSubcategory)
                          @if($workSubcategory->is_specialised == false)
                            <div class="form-check pb-2">
                              <input
                                class="form-check-input mt-0 rbq-subcategories-check"
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
                                class="form-check-input mt-0 rbq-subcategories-check"
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
                                  class="form-check-input mt-0 rbq-subcategories-check"
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
                                    class="form-check-input mt-0 rbq-subcategories-check"
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
                    <div class="text-start invalid-feedback subcategorieInvalidRequired" style="display: none;">{{__('form.rbqSubcategorieValidationRequired')}}</div>
                    <div class="text-start invalid-feedback subcategorieInvalidRequiredNot" style="display: none;">{{__('form.rbqSubcategorieValidationRequiredNot')}}</div>
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
        <button id="rbqLicence-button" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button>
      </div>
    </div>
  </div> <!--FIN LICENCE RBQ-->

   <!--COORDONNÉES-->
  <!--TODO::S'assurer que le champ rue que l'utilisateur va remplir lui même de mettre en MAJUSCULES-->
  <!--NICE_TO_HAVE::Lorsqu'on ajoute plusieurs # de téléphone les inputs de la section adresse se séprarent-->
  <!--Remarques:: Voir pour l'ordre de # civique, rue et bureau en format XL-->
  <!--TESTS:: Pour la validation des # de téléphone, j'ai testé beaucoup. J'ai peut-être oublié une façon que l'utilisateur peut en ajouter un même si le champ numéro n'est pas ok ou autre -->
  <!--Questions::
    - Pour validation pourquoi on utilise pas la classe bootstrap d-none au lieu de style="display: none;
    - Pour le site, est-ce qu'on veut que ca vérifie sur le oninput ou onblur quand l'utilisateur a fini d'entrer le site ?
    - Est-ce qu'on veut que les champs soit verts pour la validation(autocomplétion de l'adresse)
    - # Téléphone obligatoire ? Pas écrit dans le PDF.
    - Pour l'accessibilité est-ce qu'on garde le aria-label ? Qu'est-ce que les gens de la ville avaient dit déjà?
    - Pour l'expérience utilisateur, est-ce que je veux lui formater aussi s'il fait une faute du genre 555555-5555 ?
    -->
  <div class="container bg-white rounded my-2" id="contactDetails-section">
    <div class="row d-none d-md-block">
      <div class="col-12 rounded-top fond-image fond-coordonnees"></div> <!--TODO::Trouver une autre image de fond-->
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="section-title">{{__('form.contactDetailsTitle')}}</h1>
      </div>
    </div>
    <div class="row px-3">
      <div class="col-12 col-md-6 d-flex flex-column">
        <h2 class="text-center section-subtitle">{{__('form.contactDetailsAddressSection')}}</h2>
        <div class=" text-center d-flex flex-row">
          <div class="form-floating col-6 pe-2">
            <input type="text" name="contactDetailsCivicNumber" id="contactDetailsCivicNumber" class="form-control contactDetails-input" value="{{ old('contactDetailsCivicNumber') }}" oninput="validateCivicNumber('contactDetailsCivicNumber')" placeholder="" maxlength="8">
            <label for="contactDetailsCivicNumber" id="civicNumber">{{__('form.civicNumberLabel')}}</label>
          </div>
          <div class="form-floating col-6">
            <input type="text" name="contactDetailsOfficeNumber" id="contactDetailsOfficeNumber" class="form-control contactDetails-input" value="{{ old('contactDetailsOfficeNumber') }}" oninput="validateOfficeNumber('contactDetailsOfficeNumber')" placeholder="" maxlength="8">
            <label for="contactDetailsOfficeNumber" id="officeNumber">{{__('form.officeNumber')}}</label>
          </div>
        </div>
        <div class="row mb-4">
          @if($errors->has('contactDetailsCivicNumber'))
          <p>{{ $errors->first('contactDetailsCivicNumber') }}</p>
          @endif
          @if($errors->has('contactDetailsOfficeNumber'))
          <p>{{ $errors->first('contactDetailsOfficeNumber') }}</p>
          @endif
          <div class="col-12">
            <div class="text-start invalid-feedback" id="invalidRequiredCivicNumber" style="display: none;">{{__('form.contactDetailsCNValidationRequired')}}</div>
            <div class="text-start invalid-feedback" id="invalidCivicNumber" style="display: none;">{{__('form.contactDetailsCNValidationAlphanum')}}</div>
            <div class="text-start invalid-feedback" id="invalidCivicNumberLength" style="display: none;">{{__('form.contactDetailsCNValidationLength')}}</div>
          </div>
          <div class="col-12">
            <div class="text-start invalid-feedback" id="invalidOfficeNumber" style="display: none;">{{__('form.contactDetailsONValidationAlphaNum')}}</div>
            <div class="text-start invalid-feedback" id="invalidOfficeNumberLength" style="display: none;">{{__('form.contactDetailsONValidationLenght')}}</div>
          </div>
        </div>
        <div class="text-center mb-4">
          <div class="form-floating">
            <input type="text" name="contactDetailsStreetName" id="contactDetailsStreetName" class="form-control contactDetails-input" value="{{ old('contactDetailsStreetName') }}" oninput="validateStreetName('contactDetailsStreetName')" placeholder="" maxlength="64">
            <label for="contactDetailsStreetName">{{__('form.streetName')}}</label>
            <div class="text-start invalid-feedback" id="invalidRequiredStreetName" style="display: none;">{{__('form.contactDetailsStreetNameValidationRequired')}}</div>
            <div class="text-start invalid-feedback" id="invalidStreetName" style="display: none;">{{__('form.contactDetailsStreetNameValidationAlphaNumSC')}}</div>
            <div class="text-start invalid-feedback" id="invalidStreetNameLength" style="display: none;">{{__('form.contactDetailsStreetNameValidationLength')}}</div>
            @if($errors->has('contactDetailsStreetName'))
            <p>{{ $errors->first('contactDetailsStreetName') }}</p>
            @endif
          </div>
        </div>
        <div class="d-flex flex-column justify-content-between h-100">
          <div class="text-center d-flex flex-row">
            <div class="form-floating col-6 pe-2" id="div-city">
              <select name="contactDetailsCitySelect" id="contactDetailsCitySelect" class="form-select" onchange="selectedCity('contactDetailsCitySelect')" aria-label=""></select>
              <input type="text" name="contactDetailsInputCity" id="contactDetailsInputCity" class="form-control d-none contactDetails-input" value="{{ old('contactDetailsInputCity') }}" oninput="validateCity('contactDetailsInputCity')" placeholder="" maxlength="64">
              <label for="contactDetailsCitySelect">{{__('form.city')}}</label>
            </div>
            <div class="form-floating col-6">
              <select name="contactDetailsProvince" id="contactDetailsProvince" class="form-select" aria-label="">
                @foreach($provinces as $province)
                <option value="{{ $province->name }}"
                  {{ old('contactDetailsProvince', $selectedProvince ?? 'Québec') == $province->name ? 'selected' : '' }}>
                  {{ $province->name }}
                </option>
                @endforeach
              </select>
              <label for="contactDetailsProvince">{{__('form.province')}}</label>
            </div>
          </div>
          <div class="row mb-4">
              @if($errors->has('contactDetailsInputCity'))
                <p>{{ $errors->first('contactDetailsInputCity') }}</p>
              @endif
              <div class="col-12">
                <div class="text-start invalid-feedback" id="invalidRequiredCity" style="display: none;">{{__('form.contactDetailsCityRequired')}}</div>
                <div class="text-start invalid-feedback" id="invalidCityLength" style="display: none;">{{__('form.contactDetailsCityLength')}}</div>
              </div>
          </div>
          <div class="text-center d-flex flex-row">
            <div class="form-floating col-8 pe-2">
              <select name="contactDetailsDistrictArea" id="contactDetailsDistrictArea" class="form-select" onchange="selectedDA('contactDetailsDistrictArea')" aria-label="">
              </select>
              <label for="contactDetailsDistrictArea">{{__('form.districtArea')}}</label>
            </div>
            <div class="form-floating">
              <input type="text" name="contactDetailsPostalCode" id="contactDetailsPostalCode" class="form-control contactDetails-input" value="{{ old('contactDetailsPostalCode') }}" oninput="validatePostalCodeOnInput('contactDetailsPostalCode')"  onblur="formatPostalCodeOnBlur('contactDetailsPostalCode')" placeholder="" maxlength="7">
              <label for="contactDetailsPostalCode" id="postalCode">{{__('form.postalCode')}}</label>
            </div>
          </div>
          <div class="row mb-4">
            @if($errors->has('contactDetailsPostalCode'))
              <p>{{ $errors->first('contactDetailsPostalCode') }}</p>
            @endif
            <div class="col-12">
              <div class="text-start invalid-feedback" id="invalidRequiredPostalCode" style="display: none;">{{__('form.contactDetailsPostalCodeRequired')}}</div>
              <div class="text-start invalid-feedback" id="invalidPostalCodeFormat" style="display: none;">{{__('form.contactDetailsPostalCodeFormat')}}</div>
              <div class="text-start invalid-feedback" id="invalidPostalCodeLength" style="display: none;">{{__('form.contactDetailsPostalCodeLength')}}</div>
            </div>
          </div>
          <div class="text-center mb-4">
            <div class="form-floating">
              <input type="text" name="contactDetailsWebsite" id="contactDetailsWebsite" class="form-control contactDetails-input" value="{{ old('contactDetailsWebsite') }}" oninput="validateWebsiteOnBlur('contactDetailsWebsite')" placeholder="" maxlength="64">
              <label for="contactDetailsWebsite">{{__('form.website')}}</label>
              @if($errors->has('contactDetailsWebsite'))
              <p>{{ $errors->first('contactDetailsWebsite') }}</p>
              @endif
              <div class="text-start invalid-feedback" id="invalidWebsite" style="display: none;">{{__('form.contactDetailsWebsite')}}</div>
              <div class="text-start invalid-feedback" id="invalidWebsiteLength" style="display: none;">{{__('form.contactDetailsWebsiteLength')}}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 d-flex flex-column">
        <h2 class="text-center section-subtitle">{{__('form.contactDetailsphoneNumbersSection')}}</h2>
        <div class="text-center d-flex flex-row">
          <div class="form-floating col-3">
            <select name="contactDetailsPhoneType" id="contactDetailsPhoneType" class="form-select" aria-label="">
              <option value="{{__('form.officeNumber')}}">{{__('form.officeNumber')}}</option>
              <option value="{{__('form.fax')}}">{{__('form.fax')}}</option>
              <option value="{{__('form.cellphone')}}">{{__('form.cellphone')}}</option>
            </select>
            <label for="contactDetailsPhoneType">{{__('form.typeLabel')}}</label>
          </div>
          <div class="form-floating col-5 px-2">
            <input type="text" name="contactDetailsPhoneNumber" id="contactDetailsPhoneNumber" class="form-control contactDetails-input" oninput="validatePhoneNumberOnInput('contactDetailsPhoneNumber')" onblur="validatePhoneNumberOnBlur('contactDetailsPhoneNumber')"  placeholder="###-###-####" maxlength="12">
            <label class="ms-2" for="contactDetailsPhoneNumber">{{__('form.numberLabel')}}</label>
          </div>
          <div class="form-floating col-3">
            <input type="text" name="contactDetailsPhoneExtension" id="contactDetailsPhoneExtension" class="form-control contactDetails-input" oninput="validatePhoneExtension('contactDetailsPhoneExtension')" placeholder="" maxlength="6">
            <label for="contactDetailsPhoneExtension">{{__('form.phoneExtension')}}</label>
          </div>
          <div class="col-1 d-flex align-items-center ">
            <svg id="add-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="cursor: pointer; padding-left:10px">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
            </svg>
          </div>
        </div>
        <div class="row mb-4">
          @if($errors->has('contactDetailsPhoneNumber'))
            <p>{{ $errors->first('contactDetailsPhoneNumber') }}</p>
          @endif
          @if($errors->has('contactDetailsPhoneExtension'))
            <p>{{ $errors->first('contactDetailsPhoneExtension') }}</p>
          @endif
          <div class="col-12 errorMessagesPhone">
            <div class="text-start invalid-feedback" id="invalidRequiredPhoneNumber" style="display: none;">{{__('form.contactDetailsPhoneNumberRequired')}}</div>
            <div class="text-start invalid-feedback" id="invalidPostalPhoneNumberNumeric" style="display: none;">{{__('form.contactDetailsPhoneNumberNumeric')}}</div>
            <div class="text-start invalid-feedback" id="invalidPhoneNumberFormat" style="display: none;">{{__('form.contactDetailsPhoneNumberFormat')}}</div>
            <div class="text-start invalid-feedback" id="invalidPostalPhoneExtension" style="display: none;">{{__('form.contactDetailsPhoneExtension')}}</div>
            <div class="text-start invalid-feedback" id="invalidPhoneExtensionLength" style="display: none;">{{__('form.contactDetailsPhoneExtensionLength')}}</div>
            <div class="text-start invalid-feedback" id="invalidAddPhoneNumber" style="display: none;">{{__('form.contactDetailsPhoneNumberAdd')}}</div>
          </div>
        </div>

        <div class="form-floating h-100 pb-4" id="div-phoneNumberList">
          <div class="form-control pt-2 h-100 mb-4" id="contactDetailsPhoneNumberList" style="overflow-x: hidden; overflow-y: auto;">
            <div class="fs-5 text-start title-border fw-bold" for="contactDetailsPhoneNumberList">{{__('form.phoneNumberList')}}</div>
            <div class="row px-3">
              <div class="d-flex justify-content-between mt-2">
                <div class="col-2 fs-6">{{__('form.typeLabel')}}</div>
                <div class="col-6 fs-6 text-center" id="phoneNumber">{{__('form.phoneNumber')}}</div>
                <div class="col-2 fs-6 text-center">{{__('form.phoneExtension')}}</div>
                <div class="col-2 "></div>
              </div>
              <div class="d-flex flex-column justify-content-between" id="phoneNumberList">
                <!-- La vérification back-end des #tel doit vérifier tous ceux entrés ici -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center mb-3">
        <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button><!--TODO::Mettre un nom significatif au Id-->
        <button onclick="validateContactDetailsAll()" id="test" type="submit" class="m-2 py-1 px-3 rounded button-darkblue">suivant section</button><!--TODO::Mettre un nom significatif au Id-->
      </div>
    </div>
  </div> <!--FIN COORDONÉES-->

    <!--CONTACT-->
    <!--NICE_TO_HAVE::Formater automatiquement le numéro de tel sous le format 000-000-0000-->
    <div class="container bg-white rounded my-2">
        <div class="row d-none d-md-block">
            <div class="col-12 rounded-top fond-image fond-contacts"></div> <!--TODO::Trouver une autre image de fond-->
        </div>
        <div class="row">
            <div class="col-8 col-md-10 offset-2 offset-md-1 text-center">
                <h1 class="section-title">{{__('form.contactsTitle')}}</h1>
            </div>
            <div class="col-2 col-md-1 d-flex align-items-center justify-content-center">
                <button type="button" class="add-contact p-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="contactsRow" class="row justify-content-center px-3">
            @if(!is_null(old('contactFirstNames')))
                @foreach(old('contactFirstNames') as $contactFirstName)
                    <div hidden>
                        {{$contactFirstNameIndex = "contactFirstNames." . "$loop->index"}}
                        {{$contactLastNameIndex = "contactLastNames." . "$loop->index"}}
                        {{$contactJobIndex = "contactJobs." . "$loop->index"}}
                        {{$contactEmailIndex = "contactEmails." . "$loop->index"}}
                        {{$contactTelType1Index = "contactTelTypes1." . "$loop->index"}}
                        {{$contactTelNumber1Index = "contactTelNumbers1." . "$loop->index"}}
                        {{$contactTelExtension1Index = "contactTelExtensions1." . "$loop->index"}}
                        {{$contactTelType2Index = "contactTelTypes2." . "$loop->index"}}
                        {{$contactTelNumber2Index = "contactTelNumbers2." . "$loop->index"}}
                        {{$contactTelExtension2Index = "contactTelExtensions2." . "$loop->index"}}
                    </div>

                    <div id="referenceContact" class="col-12 col-lg-6 d-flex flex-column justify-content-between mb-2">
                        <div class="rounded px-3 border">
                            <div class="row">
                                <h2 id="contactSubtitle1" class="col-11 text-start section-subtitle">{{__('form.contactsSubtitle')}}</h2>
                                <button type="button" class="col-1 text-end delete-contact p-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-6 text-center mb-4">
                                    <div class="form-floating">
                                        <input type="text" name="contactFirstNames[]" id="contactFirstName1" class="form-control contact-input contact-name-input" placeholder="" maxlength="32" value="{{old('contactFirstNames')[$loop->index]}}" required>
                                        <label id="contactFirstNameLabel1" for="contactFirstName1">{{__('form.firstNameLabel')}}</label>
                                    </div>
                                    @if($errors->has($contactFirstNameIndex))
                                        <p>{{ $errors->first($contactFirstNameIndex) }}</p>
                                    @endif
                                </div>
                                <div class="col-12 col-lg-6 text-center mb-4">
                                    <div class="form-floating">
                                        <input type="text" name="contactLastNames[]" id="contactLastName1" class="form-control contact-input contact-name-input" placeholder="" maxlength="32" value="{{old('contactLastNames')[$loop->index]}}">
                                        <label id="contactLastNameLabel1" for="contactLastName1">{{__('form.lastNameLabel')}}</label>
                                    </div>
                                    @if($errors->has($contactLastNameIndex))
                                        <p>{{ $errors->first($contactLastNameIndex) }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center mb-4">
                                <div class="form-floating">
                                    <input type="text" name="contactJobs[]" id="contactJob1" class="form-control contact-input contact-job-input" placeholder="" maxlength="32" value="{{old('contactJobs')[$loop->index]}}">
                                    <label id="contactJobLabel1" for="contactJob1">{{__('form.jobLabel')}}</label>
                                </div>
                                @if($errors->has($contactJobIndex))
                                    <p>{{ $errors->first($contactJobIndex) }}</p>
                                @endif
                            </div>
                            <div class="text-center mb-4">
                                <div class="form-floating">
                                    <input type="text" name="contactEmails[]" id="contactEmail1" class="form-control contact-input contact-email-input" placeholder="" maxlength="64" value="{{old('contactEmails')[$loop->index]}}">
                                    <label id="contactEmailLabel1" for="contactEmail1">{{__('form.emailLabel')}}</label>
                                </div>
                                @if($errors->has($contactEmailIndex))
                                    <p>{{ $errors->first($contactEmailIndex) }}</p>
                                @endif
                            </div>
                            <h2 class="text-center section-subtitle">{{__('form.contactDetailsPhoneNumbersSection')}}</h2>
                            <div class="mb-4">
                                <div class="text-center d-flex flex-column flex-md-row mb-0">
                                    <div class="form-floating col-12 col-md-3">
                                        <select name="contactTelTypesA[]" id="contactTelTypeA1" class="form-select" aria-label="" value="{{old('contactTelTypesA')[$loop->index]}}">
                                            <option value="desktop">{{__('form.officeNumber')}}</option>
                                            <option value="fax">{{__('form.fax')}}</option>
                                            <option value="cellphone">{{__('form.cellphone')}}</option>
                                        </select>
                                        <label id="contactTelTypeLabelA1" for="contactTelTypeA1">{{__('form.typeLabel')}}</label>
                                    </div>
                                    <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                                        <input type="text" name="contactTelNumbersA[]" id="contactTelNumberA1" class="form-control" placeholder="" maxlength="10" value="{{old('contactTelNumbersA')[$loop->index]}}">
                                        <label id="contactTelNumberLabelA1" class="my-4 my-md-0 ms-md-2" for="contactTelNumberA1">{{__('form.numberLabel')}}</label>
                                    </div>
                                    <div class="form-floating col-12 col-md-3">
                                        <input type="text" name="contactTelExtensionsA[]" id="contactTelExtensionA1" class="form-control" placeholder="" maxlength="6" value="{{old('contactTelExtensionsA')[$loop->index]}}">
                                        <label id="contactTelExtensionLabelA1" for="contactTelExtensionA1">{{__('form.phoneExtension')}}</label>
                                    </div>
                                </div>
                                @if($errors->has($contactTelType1Index))
                                    <p class="m-0">{{ $errors->first($contactTelType1Index) }}</p>
                                @endif
                                @if($errors->has($contactTelNumber1Index))
                                    <p class="m-0">{{ $errors->first($contactTelNumber1Index) }}</p>
                                @endif
                                @if($errors->has($contactTelExtension1Index))
                                    <p class="m-0">{{ $errors->first($contactTelExtension1Index) }}</p>
                                @endif
                            </div>
                            <h2 class="text-center section-subtitle d-md-none">{{__('form.phoneNumber')}}</h2>
                            <div class="mb-4">
                              <div class="text-center d-flex flex-column flex-md-row mb-0">
                                  <div class="form-floating col-12 col-md-3">
                                      <select name="contactTelTypesB[]" id="contactTelTypeB1" class="form-select" aria-label="" value="{{old('contactTelTypesB')[$loop->index]}}">
                                          <option value="desktop">{{__('form.officeNumber')}}</option>
                                          <option value="fax">{{__('form.fax')}}</option>
                                          <option value="cellphone">{{__('form.cellphone')}}</option>
                                      </select>
                                      <label id="contactTelTypeLabelB1" for="contactTelTypeB1">{{__('form.typeLabel')}}</label>
                                  </div>
                                  <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                                      <input type="text" name="contactTelNumbersB[]" id="contactTelNumberB1" class="form-control" placeholder="" maxlength="10" value="{{old('contactTelNumbersB')[$loop->index]}}">
                                      <label id="contactTelNumberLabelB1" class="my-4 my-md-0 ms-md-2" for="contactTelNumberB1">{{__('form.numberLabel')}}</label>
                                  </div>
                                  <div class="form-floating col-12 col-md-3">
                                      <input type="text" name="contactTelExtensionsB[]" id="contactTelExtensionB1" class="form-control" placeholder="" maxlength="6" value="{{old('contactTelExtensionsB')[$loop->index]}}">
                                      <label id="contactTelExtensionLabelB1" for="contactTelExtensionB1">{{__('form.phoneExtension')}}</label>
                                  </div>
                              </div>
                              @if($errors->has($contactTelType1Index))
                                  <p class="m-0">{{ $errors->first($contactTelType1Index) }}</p>
                              @endif
                              @if($errors->has($contactTelNumber1Index))
                                  <p class="m-0">{{ $errors->first($contactTelNumber1Index) }}</p>
                              @endif
                              @if($errors->has($contactTelExtension1Index))
                                  <p class="m-0">{{ $errors->first($contactTelExtension1Index) }}</p>
                              @endif
                          </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div id="referenceContact" class="col-12 col-lg-6 d-flex flex-column justify-content-between mb-2">
                    <div class="row">

                    </div>

                    <div class="rounded pt-1 px-3 border">
                        <div class="row">
                            <h2 id="contactSubtitle1" class="col-11 text-start section-subtitle">{{__('form.contactsSubtitle')}}</h2>
                            <button type="button" class="col-1 text-end delete-contact p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 text-center mb-4">
                                <div class="form-floating">
                                    <input type="text" name="contactFirstNames[]" id="contactFirstName1" class="form-control contact-input contact-name-input" placeholder="" maxlength="32" required>
                                    <label id="contactFirstNameLabel1" for="contactFirstName1">{{__('form.firstNameLabel')}}</label>
                                    <div class="text-start invalid-feedback nameInvalidRequired" style="display: none;">{{__('form.contactsFirstNamesValidationRequired')}}</div>
                                    <div class="text-start invalid-feedback nameInvalidSymbols" style="display: none;">{{__('form.contactsNamesValidationSymbols')}}</div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 text-center mb-4">
                                <div class="form-floating">
                                    <input type="text" name="contactLastNames[]" id="contactLastName1" class="form-control contact-input contact-name-input" placeholder="" maxlength="32" required>
                                    <label id="contactLastNameLabel1" for="contactLastName1">{{__('form.lastNameLabel')}}</label>
                                    <div class="text-start invalid-feedback nameInvalidRequired" style="display: none;">{{__('form.contactsLastNamesValidationRequired')}}</div>
                                    <div class="text-start invalid-feedback nameInvalidSymbols" style="display: none;">{{__('form.contactsNamesValidationSymbols')}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mb-4">
                            <div class="form-floating">
                                <input type="text" name="contactJobs[]" id="contactJob1" class="form-control contact-input contact-job-input" placeholder="" maxlength="32" required>
                                <label id="contactJobLabel1" for="contactJob1">{{__('form.jobLabel')}}</label>
                                <div class="text-start valid-feedback jobValid" style="display: none;"></br></div>
                                <div class="text-start invalid-feedback jobInvalidRequired" style="display: none;">{{__('form.contactsJobsValidationRequired')}}</div>
                            </div>
                        </div>
                        <div class="text-center mb-4">
                            <div class="form-floating">
                                <input type="text" name="contactEmails[]" id="contactEmail1" class="form-control contact-input contact-email-input" placeholder="" maxlength="64" required>
                                <label id="contactEmailLabel1" for="contactEmail1">{{__('form.emailLabel')}}</label>
                                <div class="text-start invalid-feedback emailInvalidRequired" style="display: none;">{{__('form.contactsEmailsValidationRequired')}}</div>
                                <div class="text-start invalid-feedback emailInvalidFormat" style="display: none;">{{__('form.contactsEmailsValidationFormat')}}</div>
                            </div>
                        </div>
                        <h2 class="text-center section-subtitle">{{__('form.phoneNumber')}}</h2>
                        <div class="d-flex flex-column mb-4 phone-container">
                            <div class="text-center d-flex flex-column flex-md-row flew-mb-wrap">
                                <div class="form-floating col-12 col-md-3">
                                    <select name="contactTelTypesA[]" id="contactTelTypeA1" class="form-select" aria-label="">
                                        <option value="desktop">{{__('form.officeNumber')}}</option>
                                        <option value="fax">{{__('form.fax')}}</option>
                                        <option value="cellphone">{{__('form.cellphone')}}</option>
                                    </select>
                                    <label id="contactTelTypeLabelA1" for="contactTelTypeA1">{{__('form.typeLabel')}}</label>
                                </div>
                                <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                                    <input type="text" name="contactTelNumbersA[]" id="contactTelNumberA1" class="form-control contact-input contact-primary-phone-input" placeholder="" maxlength="10" required>
                                    <label id="contactTelNumberLabelA1" class="my-4 my-md-0 ms-md-2" for="contactTelNumberA1">{{__('form.numberLabel')}}</label>
                                </div>
                                <div class="form-floating col-12 col-md-3">
                                    <input type="text" name="contactTelExtensionsA[]" id="contactTelExtensionA1" class="form-control contact-input contact-extension-input" placeholder="" maxlength="6">
                                    <label id="contactTelExtensionLabelA1" for="contactTelExtensionA1">{{__('form.phoneExtension')}}</label>
                                </div>
                            </div>
                            <div class="text-start invalid-feedback phoneInvalidRequired" style="display: none;">{{__('form.contactsTelNumberValidationRequired')}}</div>
                            <div class="text-start invalid-feedback phoneInvalidNumber" style="display: none;">{{__('form.contactsTelNumberValidation')}}</div>
                            <div class="text-start invalid-feedback phoneInvalidSize" style="display: none;">{{__('form.contactsTelNumberValidationSize')}}</div>
                            <div class="text-start invalid-feedback phoneInvalidExtension" style="display: none;">{{__('form.contactsTelExtensionValidation')}}</div>
                        </div>

                        <h2 class="text-center section-subtitle d-md-none">{{__('form.phoneNumber')}}</h2>
                        <div class="d-flex flex-column mb-4 phone-container">
                            <div class="text-center d-flex flex-column flex-md-row">
                                <div class="form-floating col-12 col-md-3">
                                    <select name="contactTelTypesB[]" id="contactTelTypeB1" class="form-select" aria-label="">
                                        <option value="desktop">{{__('form.officeNumber')}}</option>
                                        <option value="fax">{{__('form.fax')}}</option>
                                        <option value="cellphone">{{__('form.cellphone')}}</option>
                                    </select>
                                    <label id="contactTelTypeLabelB1" for="contactTelTypeB1">{{__('form.typeLabel')}}</label>
                                </div>
                                <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                                    <input type="text" name="contactTelNumbersB[]" id="contactTelNumberB1" class="form-control contact-input contact-secondary-phone-input" placeholder="" maxlength="10">
                                    <label id="contactTelNumberLabelB1" class="my-4 my-md-0 ms-md-2" for="contactTelNumberB1">{{__('form.numberLabel')}}</label>
                                </div>
                                <div class="form-floating col-12 col-md-3">
                                    <input type="text" name="contactTelExtensionsB[]" id="contactTelExtensionB1" class="form-control contact-input contact-extension-input" placeholder="" maxlength="6">
                                    <label id="contactTelExtensionLabelB1" for="contactTelExtensionB1">{{__('form.phoneExtension')}}</label>
                                </div>
                            </div>
                            <div class="text-start invalid-feedback phoneInvalidNumber" style="display: none;">{{__('form.contactsTelNumberValidation')}}</div>
                            <div class="text-start invalid-feedback phoneInvalidSize" style="display: none;">{{__('form.contactsTelNumberValidationSize')}}</div>
                            <div class="text-start invalid-feedback phoneInvalidExtension" style="display: none;">{{__('form.contactsTelExtensionValidation')}}</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
                <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button><!--TODO::Mettre un nom significatif au Id-->
                <button id="contacts-button" type="submit" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button><!--TODO::Mettre un nom significatif au Id-->
            </div>
        </div>
    </div> <!--FIN CONTACT-->

  <!--PIÈCES JOINTES-->

</form>
@endsection

@section('scripts')
<script src="{{ asset('js/suppliersCreate/createValidationIdentification.js') }}"></script>
<script src="{{ asset('js/suppliersCreate/produitsServices.js') }}"></script>
<script src="{{ asset('js/suppliersCreate/rbq.js') }} "></script>
<script src="{{ asset('js/suppliersCreate/contact.js') }} "></script>
<script src="{{ asset('js/progressBar.js') }} "></script>
<script src="{{ asset('js/suppliersCreate/contactDetails.js') }} "></script>
<script>
  const oldCity = "{{ old('contactDetails-city') }}";
  const oldDistrictArea = "{{ old('contactDetailsDistrictArea') }}";
</script>
@endsection

