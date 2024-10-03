@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/supplier.css') }}">
<link rel="stylesheet" href="{{ asset('css/progressBar.css') }}">
<script src="{{ asset('js/createValidation.js') }}"></script>
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
  <!--
      Remarques_Validations_Front_end::
        - Mettre le texte dans les fichiers de langue
        - Ne pas mettre de point d'exclamation dans les erreurs
        - Ne pas mettre de message de validation quand c'est bon
        - Ne pas mettre les erreurs quand la page load
        - Mettre le fichier de validation dans js/suppliersCreate/createValidationIdentification.js
        - Faire un fichier par section
        - Validation du courriel, valider la fin avec le premier point et la premiee section après le point
    -->
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
        <div class="text-start">
          <div class="form-floating mb-3">
            <input type="text" oninput="validateIdentificationNeq()" name="neq" id="neq" class="form-control" placeholder="" value="{{ old('neq') }}" maxlength="10">
            <label for="neq">{{__('form.neqLabel')}}</label>
            <div class="invalid-feedback" id="neqInvalid1" style="display: none;">Le NEQ doit débuter par 11, 22, 33 ou 88!</div>
            <div class="invalid-feedback" id="neqInvalid2" style="display: none;">Le troisième caractère doit être 4, 5, 6, 7, 8 ou 9!</div>
            <div class="invalid-feedback" id="neqInvalid3" style="display: none;">Le NEQ doit être composé uniquement de chiffres!</div>
            <div class="invalid-feedback" id="neqInvalid4" style="display: none;">Le NEQ doit être composé de 10 chiffres!</div>
            <div class="invalid-feedback" id="neqInvalid5" style="display: none;">Le NEQ est déjà enregistrer pour un autre compte!</div>
            <div id="neqValid"></br></div>

          </div>
        </div>
        <div class="text-start">
          <div class="form-floating mb-3">
            <input type="text" oninput="validateIdentificationName()" name="name" id="name" class="form-control is-invalid" placeholder="" value="{{ old('name') }}" maxlength="64">
            <label for="name">{{__('form.companyNameLabel')}}</label>
            <div class="valid-feedback" id="nameValid1" style="display: none;"></br></div>
            <div class="invalid-feedback" id="nameInvalid1" style="display: none;">Le nom d'entreprise est obligatoire!</div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-8 d-flex flex-column justify-content-between">
        <h2 class="text-center section-subtitle">{{__('form.identificationAuthentificationSection')}}</h2>
        <div class="text-start">
          <div class="form-floating mb-3">
            <input type="email" oninput="validateIdentificationEmail()" name="email" id="email" class="form-control" placeholder="example@gmail.com" value="{{ old('email') }}" maxlength="64">
            <label for="email">{{__('form.emailLabel')}}</label>
            <div class="valid-feedback" id="emailValid1" style="display: none;"></br></div>
            <div class="invalid-feedback" id="emailInvalid1">L'adresse courriel est obligatoire!</div>
            <div class="invalid-feedback" id="emailInvalid2" style="display: none;">L'adresse courriel ne peut commencer par @!</div>
            <div class="invalid-feedback" id="emailInvalid3" style="display: none;">L'adresse courriel doit contenir un @!</div>
            <div class="invalid-feedback" id="emailInvalid4" style="display: none;">L'adresse courriel doit contenir un nom de domaine!</div>
          </div>
        </div>
        <div class="text-start">
          <div class="row">
            <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
              <div class="form-floating mb-3">
                <input type="password" oninput="validateIdentificationPassword()" name="password" id="password" class="form-control" placeholder="" maxlength="12">
                <label for="password">{{__('form.passwordLabel')}}</label>
                <div class="valid-feedback" id="passwordValid1" style="display: none;"></br></div>
                <div class="invalid-feedback" id="passwordInvalid1">Le mot de passe est obligatoire!</div>
                <div class="invalid-feedback" id="passwordInvalid2" style="display: none;">Le mot de passe doit contenir entre 7 et 12 caractères!</div>
                <div class="invalid-feedback" id="passwordInvalid3" style="display: none;">Le mot de passe doit contenir une minuscule!</div>
                <div class="invalid-feedback" id="passwordInvalid4" style="display: none;">Le mot de passe doit contenir une majuscule!</div>
                <div class="invalid-feedback" id="passwordInvalid5" style="display: none;">Le mot de passe doit contenir un chiffre!</div>
                <div class="invalid-feedback" id="passwordInvalid6" style="display: none;">Le mot de passe doit contenir un caractère spécial!</div>
              </div>
            </div>
            <div class="col-12 col-md-6 d-flex flex-column justify-content-between">
              <div class="form-floating mb-3">
                <input type="password" oninput="validateIdentificationPasswordConfirmation()" name="password_confirmation" id="password_confirmation" placeholder="" class="form-control" maxlength="12">
                <label for="password_confirmation">{{__('form.passwordConfirmLabel')}}</label>
                <div class="valid-feedback" id="password_confirmationValid1" style="display: none;"></br></div>
                <div class="invalid-feedback" id="password_confirmationInvalid1">Le mot de passe est obligatoire!</div>
                <div class="invalid-feedback" id="password_confirmationInvalid2" style="display: none;">Le mot de passe n'est pas identique!</div>
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
  </div> <!--FIN IDENTIFICATION-->


  <!--PRODUIT ET SERVICE-->
  <!--Remarques-->
  <!-- Titre Produits et Services disparaît écran sm -->
  <!-- Responsive en bas de large (992px) les labels des inputs Recherche, Détails et Sélectionnez embarque sur le texte (contenu) -->
  <!-- Table productsservices est-ce que la description on veut mettre plus de caractères. (Même si dans le diagramme de classe c'est écrit 64) ?-->
  <!-- Table productsservices est-ce que le code on veut mettre moins de caractères selon le plus long dans la liste excel ? (Même si dans le diagramme de classe c'est écrit (8) ?-->
  <!-- Table productsservices est-ce qu'on a besoin du category_code (string) puisqu'on a déjà sa clé étrangère?-->
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
            <select name="product-category" id="product-category" class="form-select" aria-label="Default select example">
              <option selected></option>
              <optgroup label="Approvissionements">
                <option value="G1">G1 - Aérospatiale</option>
                <option value="G2">G2 - Matériel de climatisation et de réfrigération</option>
                <option value="G3">G3 - Armement</option>
              </optgroup>
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
              <div>
                <div class="row align-items-start">
                  <div class="col-1 col-md-1 d-flex flex-column justify-content-start">
                    <input class="form-check-input" type="checkbox" onclick="checkedbox(this)" id="category1" value="">
                  </div>
                  <div class="col-4 col-md-4 d-flex flex-column justify-content-start">
                    <label class="form-check-label" for="category1">05736535</label>
                  </div>
                  <div class="col-7 col-md-7 d-flex flex-column justify-content-start">
                    <label class="form-check-label" for="category1">Service d'entretien ménager</label>
                  </div>
                </div>
                <div class="row align-items-start">
                  <div class="col-1 col-md-1 d-flex flex-column justify-content-start">
                    <input class="form-check-input" type="checkbox" onclick="checkedbox(this)" id="category2" value="">
                  </div>
                  <div class="col-4 col-md-4 d-flex flex-column justify-content-start">
                    <label class="form-check-label" for="category2">09563559</label>
                  </div>
                  <div class="col-7 col-md-7 d-flex flex-column justify-content-start">
                    <label class="form-check-label" for="category2">Service d'entretien de pelouse</label>
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
        <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button>
      </div>
    </div>
  </div> <!--FIN PRODUIT ET SERVICE-->


  <!--LICENCE RBQ-->
  <!--TODO::Formater automatiquement le numéro de licence RBQ-->
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
  </div> <!--FIN LICENCE RBQ-->

  <!--COORDONNÉES-->
  <!--TODO::S'assurer que le champ rue que l'utilisateur va remplir lui même de mettre en MAJUSCULES-->
  <!--TODO::Mettre les messages d'erreur à la fin (voir contact nico)-->
  <!--Remarques:: Voir pour l'ordre de # civique, rue et bureau en format XL-->
  <div class="container bg-white rounded my-2" id="contactDetails-section">
    <div class="row d-none d-md-block">
      <div class="col-12 rounded-top fond-image fond-coordonnees"></div> <!--TODO::Trouver une autre image de fond-->
    </div>
    <div class="row">
      <div class="d-md-block col-12 text-center">
        <h1 class="section-title">{{__('form.contactDetailsTitle')}}</h1>
      </div>
    </div>
    <div class="row px-3">
      <div class="col-12 col-md-6 d-flex flex-column">
        <h2 class="text-center section-subtitle">{{__('form.contactDetailsAddressSection')}}</h2>
        <div class="d-none d-xxl-block">
          <div class="text-center d-flex flex-row mb-4 ">
            <div class="form-floating col-2">
              <input type="text" name="contactDetailsCivicNumber" id="contactDetailsCivicNumberXxl" class="form-control" value="{{ old('contactDetailsCivicNumber') }}" placeholder="" maxlength="8">
              <label for="contactDetailsCivicNumberXxl" id="civicNumber">{{__('form.civicNumberLabel')}}</label>
              @if($errors->has('contactDetailsCivicNumberXxl'))
              <p>{{ $errors->first('contactDetailsCivicNumberXxl') }}</p>
              @endif
            </div>
            <div class="form-floating col-8 px-2">
              <input type="text" name="contactDetailsStreetName" id="contactDetailsStreetNameXxl" class="form-control" value="{{ old('contactDetailsStreetName') }}" placeholder="" maxlength="64">
              <label class="ms-2" for="contactDetailsStreetNameXxl">{{__('form.streetName')}}</label>
              @if($errors->has('contactDetailsStreetNameXxl'))
              <p>{{ $errors->first('contactDetailsStreetNameXxl') }}</p>
              @endif
            </div>
            <div class="form-floating col-2">
              <input type="text" name="contactDetailsOfficeNumber" id="contactDetailsOfficeNumberXxl" class="form-control" value="{{ old('contactDetailsOfficeNumber') }}" placeholder="" maxlength="8">
              <label for="contactDetailsOfficeNumberXxl" id="officeNumber">{{__('form.officeNumber')}}</label>
              @if($errors->has('contactDetailsOfficeNumberXxl'))
              <p>{{ $errors->first('contactDetailsOfficeNumberXxl') }}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="d-xxl-none">
          <div class=" text-center d-flex flex-row mb-4">
            <div class="form-floating col-6 pe-2">
              <input type="text" name="contactDetailsCivicNumber" id="contactDetailsCivicNumber" class="form-control" value="{{ old('contactDetailsCivicNumber') }}" placeholder="" maxlength="8">
              <label for="contactDetailsCivicNumber" id="civicNumber">{{__('form.civicNumberLabel')}}</label>
              @if($errors->has('contactDetailsCivicNumber'))
              <p>{{ $errors->first('contactDetailsCivicNumber') }}</p>
              @endif
            </div>
            <div class="form-floating col-6">
              <input type="text" name="contactDetailsOfficeNumber" id="contactDetailsOfficeNumber" class="form-control" value="{{ old('contactDetailsOfficeNumber') }}" placeholder="" maxlength="8">
              <label for="contactDetailsOfficeNumber" id="officeNumber">{{__('form.officeNumber')}}</label>
              @if($errors->has('contactDetailsOfficeNumber'))
              <p>{{ $errors->first('contactDetailsOfficeNumber') }}</p>
              @endif
            </div>
          </div>
        </div>
        <div class="text-center mb-4 d-xxl-none">
          <div class="form-floating">
            <input type="text" name="contactDetailsStreetName" id="contactDetailsStreetName" class="form-control" value="{{ old('contactDetailsStreetName') }}" placeholder="" maxlength="64">
            <label class="ms-2" for="contactDetailsStreetName">{{__('form.streetName')}}</label>
            @if($errors->has('contactDetailsStreetName'))
            <p>{{ $errors->first('contactDetailsStreetName') }}</p>
            @endif
          </div>
        </div>
        <div class="d-flex flex-column justify-content-between h-100">
          <div class="text-center d-flex flex-row mb-4">
            <div class="form-floating col-6 pe-2" id="div-city">
              <select name="contactDetailsCitySelect" id="contactDetailsCitySelect" class="form-select" aria-label=""></select>
              <input type="text" name="contactDetailsInputCity" id="contactDetailsInputCity" class="form-control d-none" placeholder="" maxlength="64">
              @if($errors->has('contactDetailsInputCity'))
              <p>{{ $errors->first('contactDetailsInputCity') }}</p>
              @endif
              <label for="contactDetailsCitySelect">{{__('form.city')}}</label>
            </div>
            <div class="form-floating col-6">
              <select name="contactDetailsPovince" id="contactDetailsPovince" class="form-select" aria-label="">
                @foreach($provinces as $province)
                <option value="{{ $province->name }}"
                  {{ old('contactDetailsPovince', $selectedProvince ?? 'Québec') == $province->name ? 'selected' : '' }}>
                  {{ $province->name }}
                </option>
                @endforeach
              </select>
              <label for="contactDetailsPovince">{{__('form.province')}}</label>
            </div>
          </div>
          <div class="text-center d-flex flex-row mb-4">
            <div class="form-floating col-8 pe-2">
              <select name="contactDetailsDistrictArea" id="contactDetailsDistrictArea" class="form-select" aria-label="">
              </select>
              <label for="contactDetailsDistrictArea">{{__('form.districtArea')}}</label>
            </div>
            <div class="form-floating">
              <input type="text" name="contactDetailsPostalCode" id="contactDetailsPostalCode" class="form-control" value="{{ old('contactDetailsPostalCode') }}" placeholder="" maxlength="7">
              <label for="contactDetailsPostalCode" id="postalCode">{{__('form.postalCode')}}</label>
              @if($errors->has('contactDetailsPostalCode'))
              <p>{{ $errors->first('contactDetailsPostalCode') }}</p>
              @endif
            </div>
          </div>
          <div class="text-center mb-4">
            <div class="form-floating">
              <input type="text" name="contactDetailsWebsite" id="contactDetailsWebsite" class="form-control" value="{{ old('contactDetailsWebsite') }}" placeholder="" maxlength="64">
              <label for="contactDetailsWebsite">{{__('form.website')}}</label>
              @if($errors->has('contactDetailsWebsite'))
              <p>{{ $errors->first('contactDetailsWebsite') }}</p>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-6 d-flex flex-column">
        <h2 class="text-center section-subtitle">{{__('form.contactDetailsphoneNumbersSection')}}</h2>
        <div class="text-center d-flex flex-row mb-4">
          <div class="form-floating col-3">
            <select name="contactDetailsPhoneType" id="contactDetailsPhoneType" class="form-select" aria-label="">
              <option value="{{__('form.officeNumber')}}">{{__('form.officeNumber')}}</option>
              <option value="{{__('form.fax')}}">{{__('form.fax')}}</option>
              <option value="{{__('form.cellphone')}}">{{__('form.cellphone')}}</option>
            </select>
            <label for="contactDetailsPhoneType">{{__('form.typeLabel')}}</label>
          </div>
          <div class="form-floating col-5 px-2">
            <input type="text" name="contactDetailsPhoneNumber" id="contactDetailsPhoneNumber" class="form-control" placeholder="" maxlength="12">
            <label class="ms-2" for="contactDetailsPhoneNumber">{{__('form.numberLabel')}}</label>

          </div>
          <div class="form-floating col-3">
            <input type="text" name="contactDetailsPhoneExtension" id="contactDetailsPhoneExtension" class="form-control" placeholder="" maxlength="6">
            <label for="contactDetailsPhoneExtension">{{__('form.phoneExtension')}}</label>

          </div>
          <div class="col-1 d-flex align-items-center ">
            <svg id="add-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="cursor: pointer; padding-left:10px">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
            </svg>
          </div>

        </div>
        @if($errors->has('contactDetailsPhoneNumber'))
        <p>{{ $errors->first('contactDetailsPhoneNumber') }}</p>
        @endif
        @if($errors->has('contactDetailsPhoneExtension'))
        <p>{{ $errors->first('contactDetailsPhoneExtension') }}</p>
        @endif
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center mb-3">
        <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button><!--TODO::Mettre un nom significatif au Id-->
        <button type="submit" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button><!--TODO::Mettre un nom significatif au Id-->
      </div>
    </div>
  </div> <!--FIN COORDONÉES-->

  <!--CONTACT-->
  <!--TODO::Faire que les numéros des contacts soient relatif au dernier item et non au premier-->
  <!--TODO::Attention, le x n'apparait pas suite au validation Laravel-->
  <!--TODO::Attention, enlever x au 1 jsute quand seul-->
  <!--TODO::Formater automatiquement le numéro de tel (Voir se que Miro à fait)-->
  <!--TODO::Ajouter 2e numéro de tel-->

  <!--REMARQUE::Mettre les numéros de contact par rapport au précédent quand on en efface un. (Ex: 1,2,3,4. Présentement, quand on en efface, ça peut donner 1,4,6,9.-->
  <!--REMARQUE::Mettre les numéros de contact et le "X" dans la boite de contact en haut à gauche, un peu comme les labels des champs.-->
  <div class="container bg-white rounded my-2">
    <div class="row d-none d-md-block">
      <div class="col-12 rounded-top fond-image fond-contacts"></div> <!--TODO::Trouver une autre image de fond-->
    </div>
    <div class="row">
      <div class="d-none d-md-block col-10 offset-1 text-center">
        <h1 class="section-title">{{__('form.contactsTitle')}}</h1>
      </div>
      <div class="col-1 d-flex align-items-center justify-content-center">
        <button type="button" class="add-contact p-0">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
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
        {{$contactTelTypeIndex = "contactTelTypes." . "$loop->index"}}
        {{$contactTelNumberIndex = "contactTelNumbers." . "$loop->index"}}
        {{$contactTelExtensionIndex = "contactTelExtensions." . "$loop->index"}}
      </div>

      <div id="referenceContact" class="col-6 d-flex flex-column justify-content-between mb-2">
        <div class="row">
          <h2 id="contactSubtitle1" class="col-10 offset-1 text-center section-subtitle">{{__('form.contactsSubtitle')}} #{{$loop->index + 1}}</h2>
          <button type="button" class="col-1 delete-contact p-0 d-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
            </svg>
          </button>
        </div>

        <div class="rounded pt-3 px-3 border">
          <div class="row">
            <div class="col-6 text-center mb-4">
              <div class="form-floating">
                <input type="text" name="contactFirstNames[]" id="contactFirstName1" class="form-control" placeholder="" maxlength="32" value="{{old('contactFirstNames')[$loop->index]}}">
                <label id="contactFirstNameLabel1" for="contactFirstName1">{{__('form.firstNameLabel')}}</label>
              </div>
              @if($errors->has($contactFirstNameIndex))
              <p>{{ $errors->first($contactFirstNameIndex) }}</p>
              @endif
            </div>
            <div class="col-6 text-center mb-4">
              <div class="form-floating">
                <input type="text" name="contactLastNames[]" id="contactLastName1" class="form-control" placeholder="" maxlength="32" value="{{old('contactLastNames')[$loop->index]}}">
                <label id="contactLastNameLabel1" for="contactLastName1">{{__('form.lastNameLabel')}}</label>
              </div>
              @if($errors->has($contactLastNameIndex))
              <p>{{ $errors->first($contactLastNameIndex) }}</p>
              @endif
            </div>
          </div>
          <div class="text-center mb-4">
            <div class="form-floating">
              <input type="text" name="contactJobs[]" id="contactJob1" class="form-control" placeholder="" maxlength="32" value="{{old('contactJobs')[$loop->index]}}">
              <label id="contactJobLabel1" for="contactJob1">{{__('form.jobLabel')}}</label>
            </div>
            @if($errors->has($contactJobIndex))
            <p>{{ $errors->first($contactJobIndex) }}</p>
            @endif
          </div>
          <div class="text-center mb-4">
            <div class="form-floating">
              <input type="text" name="contactEmails[]" id="contactEmail1" class="form-control" placeholder="" maxlength="64" value="{{old('contactEmails')[$loop->index]}}">
              <label id="contactEmailLabel1" for="contactEmail1">{{__('form.emailLabel')}}</label>
            </div>
            @if($errors->has($contactEmailIndex))
            <p>{{ $errors->first($contactEmailIndex) }}</p>
            @endif
          </div>
          <h2 class="text-center section-subtitle">{{__('form.contactDetailsPhoneNumbersSection')}}</h2>
          <div class="mb-4">
            <div class="text-center d-flex flex-row mb-0">
              <div class="form-floating col-3">
                <select name="contactTelTypes[]" id="contactTelType1" class="form-select" aria-label="" value="{{old('contactTelTypes')[$loop->index]}}">
                  <option value="desktop">{{__('form.officeNumber')}}</option>
                  <option value="fax">{{__('form.fax')}}</option>
                  <option value="cellphone">{{__('form.cellphone')}}</option>
                </select>
                <label id="contactTelTypeLabel1" for="contactTelType1">{{__('form.typeLabel')}}</label>
              </div>
              <div class="form-floating col-6 px-2">
                <input type="text" name="contactTelNumbers[]" id="contactTelNumber1" class="form-control" placeholder="" maxlength="12" value="{{old('contactTelNumbers')[$loop->index]}}">
                <label id="contactTelNumberLabel1" class="ms-2" for="contactTelNumber1">{{__('form.phoneNumber')}}</label>
              </div>
              <div class="form-floating col-3">
                <input type="text" name="contactTelExtensions[]" id="contactTelExtension1" class="form-control" placeholder="" maxlength="6" value="{{old('contactTelExtensions')[$loop->index]}}">
                <label id="contactTelExtensionLabel1" for="contactTelExtension1">{{__('form.phoneExtension')}}</label>
              </div>
            </div>
            @if($errors->has($contactTelTypeIndex))
            <p class="m-0">{{ $errors->first($contactTelTypeIndex) }}</p>
            @endif
            @if($errors->has($contactTelNumberIndex))
            <p class="m-0">{{ $errors->first($contactTelNumberIndex) }}</p>
            @endif
            @if($errors->has($contactTelExtensionIndex))
            <p class="m-0">{{ $errors->first($contactTelExtensionIndex) }}</p>
            @endif
          </div>
        </div>
      </div>
      @endforeach
      @else
      <div id="referenceContact" class="col-6 d-flex flex-column justify-content-between mb-2">
        <div class="row">
          <h2 id="contactSubtitle1" class="col-10 offset-1 text-center section-subtitle">{{__('form.contactsSubtitle')}} #1</h2>
          <button type="button" class="col-1 delete-contact p-0 d-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
            </svg>
          </button>
        </div>

        <div class="rounded pt-3 px-3 border">
          <div class="row">
            <div class="col-6 text-center mb-4">
              <div class="form-floating">
                <input type="text" name="contactFirstNames[]" id="contactFirstName1" class="form-control" placeholder="" maxlength="32">
                <label id="contactFirstNameLabel1" for="contactFirstName1">{{__('form.firstNameLabel')}}</label>
              </div>
            </div>
            <div class="col-6 text-center mb-4">
              <div class="form-floating">
                <input type="text" name="contactLastNames[]" id="contactLastName1" class="form-control" placeholder="" maxlength="32">
                <label id="contactLastNameLabel1" for="contactLastName1">{{__('form.lastNameLabel')}}</label>
              </div>
            </div>
          </div>
          <div class="text-center mb-4">
            <div class="form-floating">
              <input type="text" name="contactJobs[]" id="contactJob1" class="form-control" placeholder="" maxlength="32">
              <label id="contactJobLabel1" for="contactJob1">{{__('form.jobLabel')}}</label>
            </div>
          </div>
          <div class="text-center mb-4">
            <div class="form-floating">
              <input type="text" name="contactEmails[]" id="contactEmail1" class="form-control" placeholder="" maxlength="64">
              <label id="contactEmailLabel1" for="contactEmail1">{{__('form.emailLabel')}}</label>
            </div>
          </div>
          <h2 class="text-center section-subtitle">{{__('form.phoneNumber')}}</h2>
          <div class="text-center d-flex flex-row mb-4">
            <div class="form-floating col-3">
              <select name="contactTelTypes[]" id="contactTelType1" class="form-select" aria-label="">
                <option value="desktop">{{__('form.officeNumber')}}</option>
                <option value="fax">{{__('form.fax')}}</option>
                <option value="cellphone">{{__('form.cellphone')}}</option>
              </select>
              <label id="contactTelTypeLabel1" for="contactTelType1">{{__('form.typeLabel')}}</label>
            </div>
            <div class="form-floating col-6 px-2">
              <input type="text" name="contactTelNumbers[]" id="contactTelNumber1" class="form-control" placeholder="" maxlength="12">
              <label id="contactTelNumberLabel1" class="ms-2" for="contactTelNumber1">{{__('form.numberLabel')}}</label>
            </div>
            <div class="form-floating col-3">
              <input type="text" name="contactTelExtensions[]" id="contactTelExtension1" class="form-control" placeholder="" maxlength="6">
              <label id="contactTelExtensionLabel1" for="contactTelExtension1">{{__('form.phoneExtension')}}</label>
            </div>
          </div>
        </div>
      </div>
      @endif
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
<script src="{{ asset('js/suppliersCreate/contact.js') }} "></script>
<script src="{{ asset('js/progressBar.js') }} "></script>
<script src="{{ asset('js/suppliersCreate/contactDetails.js') }} "></script>
@endsection