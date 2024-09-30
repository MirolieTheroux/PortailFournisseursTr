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
        <span class="name">Coordonnées</span>
      </div>
      <div class="step">
        <span class="number">5</span>
        <span class="name">{{__('form.contactDetailsTitle')}}</span>
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
  </div> <!--FIN IDENTIFICATION-->


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
  <!--REMARQUES::
    Est-ce qu'on veut que les catégories soit aussi cliquables ou juste les checkboxes? 
    Essayer de mettre la boîte égale à la licence si temps?
    -->
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
                  <input class="form-check-input mt-0" type="checkbox" name="rbqSubcategories[]" value="{{$workSubcategory->code}}" id="flexCheckDefaultGen{{$workSubcategory->id}}Ent" @checked(old('rbqSubcategories', $workSubcategory->id))>
                  <div class="d-flex">
                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckDefault">
                      {{$workSubcategory->code}}
                    </label>
                    <label class="form-check-label text-start ps-2" for="flexCheckDefault">
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
                  <input class="form-check-input mt-0" type="checkbox" name="rbqSubcategories[]" value="{{$workSubcategory->code}}" id="flexCheckDefaultSpec{{$workSubcategory->id}}Ent">
                  <div class="d-flex">
                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckDefault">
                      {{$workSubcategory->code}}
                    </label>
                    <label class="form-check-label text-start ps-2" for="flexCheckDefault">
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
                  <input class="form-check-input mt-0" type="checkbox" name="rbqSubcategories[]" value="{{$workSubcategory->code}}" id="flexCheckDefaultGen{{$workSubcategory->id}}OB">
                  <div class="d-flex">
                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckDefault">
                      {{$workSubcategory->code}}
                    </label>
                    <label class="form-check-label text-start ps-2" for="flexCheckDefault">
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
                  <input class="form-check-input mt-0" type="checkbox" name="rbqSubcategories[]" value="{{$workSubcategory->code}}" id="flexCheckDefaultSpec{{$workSubcategory->id}}OB">
                  <div class="d-flex">
                    <label class="form-check-label text-start rbq-category-label-number" for="flexCheckDefault">
                      {{$workSubcategory->code}}
                    </label>
                    <label class="form-check-label text-start ps-2" for="flexCheckDefault">
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
    <div class="row">
      <div class="col-12 d-flex justify-content-center mb-2">
        <button type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.cancel')}}</button>
        <button type="submit" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.next')}}</button>
      </div>
    </div>
  </div> <!--FIN LICENCE RBQ-->

  <!--COORDONNÉES-->
  <div class="container bg-white rounded my-2" id="details-section">
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
            <input type="text" name="contactDetailsSearchAddress" id="contactDetailsSearchAddress" class="form-control" placeholder="">
            <label for="contactDetailsSearchAddress">{{__('form.searchAddress')}}</label>
          </div>
        </div>
        <div class="text-center d-flex flex-row mb-4">
          <div class="form-floating col-2">
            <input type="text" name="contactDetailsCivicNumber" id="contactDetailsCivicNumber" class="form-control" value="{{ old('contactDetailsCivicNumber') }}" placeholder="" maxlength="8">
            <label for="contactDetailsCivicNumber" id="civicNumber">{{__('form.civicNumberLabel')}}</label>
            @if($errors->has('contactDetailsCivicNumber'))
            <p>{{ $errors->first('contactDetailsCivicNumber') }}</p>
            @endif
          </div>
          <div class="form-floating col-8 px-2">
            <input type="text" name="contactDetailsStreetName" id="contactDetailsStreetName" class="form-control" value="{{ old('contactDetailsStreetName') }}" placeholder="" maxlength="64">
            <label class="ms-2" for="contactDetailsStreetName">{{__('form.streetName')}}</label>
            @if($errors->has('contactDetailsStreetName'))
            <p>{{ $errors->first('contactDetailsStreetName') }}</p>
            @endif
          </div>
          <div class="form-floating col-2">
            <input type="text" name="contactDetailsOfficeNumber" id="contactDetailsOfficeNumber" class="form-control" value="{{ old('contactDetailsOfficeNumber') }}" placeholder="" maxlength="8">
            <label for="contactDetailsOfficeNumber" id="officeNumber">{{__('form.officeNumber')}}</label>
            @if($errors->has('contactDetailsOfficeNumber'))
            <p>{{ $errors->first('contactDetailsOfficeNumber') }}</p>
            @endif
          </div>
        </div>
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
      <div class="col-md-6 d-flex flex-column">
        <h2 class="text-center section-subtitle">{{__('form.contactDetailsphoneNumbersSection')}}</h2>
        <div class="text-center d-flex flex-row mb-4">
          <div class="form-floating col-3">
            <select name="contactDetailsPhoneType" id="contactDetailsPhoneType" class="form-select" aria-label="">
              <option value="{{__('form.officeNumber')}}">{{__('form.officeNumber')}}</option>
              <option value="{{__('form.fax')}}">{{__('form.fax')}}</option>
              <option value="{{__('form.cellphone')}}">{{__('form.cellphone')}}</option>
            </select>
            <label for="contactDetailsPhoneType">{{__('form.phoneType')}}</label>
          </div>
          <div class="form-floating col-5 px-2">
            <input type="text" name="contactDetailsPhoneNumber" id="contactDetailsPhoneNumber" class="form-control" placeholder="" maxlength="12">
            <label class="ms-2" for="contactDetailsPhoneNumber">{{__('form.number')}}</label>
            @if($errors->has('contactDetailsPhoneNumber'))
            <p>{{ $errors->first('contactDetailsPhoneNumber') }}</p>
            @endif
          </div>
          <div class="form-floating col-3">
            <input type="text" name="contactDetailsPhoneExtension" id="contactDetailsPhoneExtension" class="form-control" placeholder="" maxlength="6">
            <label for="contactDetailsPhoneExtension">{{__('form.phoneExtension')}}</label>
            @if($errors->has('contactDetailsPhoneExtension'))
            <p>{{ $errors->first('contactDetailsPhoneExtension') }}</p>
            @endif
          </div>
          <div class="col-1 d-flex align-items-center justify-content-center">
            <svg id="add-icon" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="cursor: pointer; padding-left:10px">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
            </svg>
          </div>
        </div>
        <div class="form-floating " id="div-phoneNumberList">
          <div class="form-control pt-2" id="contactDetailsPhoneNumberList" style="overflow-x: hidden; overflow-y: auto;">
            <div class="fs-5 text-start title-border fw-bold" for="contactDetailsPhoneNumberList">{{__('form.phoneNumberList')}}</div>
            <div class="row px-3">
              <div class="d-flex justify-content-between mt-2">
                <div class="col-2 fs-6">{{__('form.phoneType')}}</div>
                <div class="col-6 fs-6 text-center" id="phoneNumber">{{__('form.phoneNumber')}}</div>
                <div class="col-2 fs-6 text-center">{{__('form.phoneExtension')}}</div>
                <div class="col-2 "></div>
              </div>
              <div class="d-flex flex-column justify-content-between"  id="phoneNumberList">
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
  <!--PIÈCES JOINTES-->

</form>
@endsection

@section('scripts')
<script src="{{ asset('js/suppliersCreate.js') }} "></script>
<script>
  const oldCity = "{{ old('contactDetails-city') }}";
  const oldDistrictArea = "{{ old('contactDetailsDistrictArea') }}";
</script>
@endsection