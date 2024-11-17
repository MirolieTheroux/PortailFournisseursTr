@extends('layouts.app')

@section('title', __('documentation.title'))

@section('css')
<link rel="stylesheet" href="{{ asset('css/documentation.css') }}">
@endsection

@section('mobile-navbar')
<!--NICE_TO_HAVE::- Peut-être diminuer les titres.-->
<div class="w-100 border-top border-dark">
  <div class="text-center w-100 p-2 fw-bolder">{{__('documentation.title')}}</div>
  <div id="login-nav-button-mobile" class="text-center w-100 p-2">{{__('documentation.login')}}</div>
  <div id="signup-nav-button-mobile" class="text-center w-100 p-2">{{__('documentation.signUp')}}</div>
  <div id="home-nav-button-mobile" class="text-center w-100 p-2">{{__('documentation.homePage')}}</div>
  <div id="update-nav-button-mobile" class="text-center w-100 p-2">{{__('documentation.updateAccount')}}</div>
  <div id="delete-nav-button-mobile" class="text-center w-100 p-2">{{__('documentation.deleteAccount')}}</div>
</div>
@endsection

@section('content')
<div class="container-fluid d-flex flex-column h-100">
  <div class="row h-100">
    <!--NICE_TO_HAVE::Box-Shadow pour le menu du côté.-->
    <div class="d-none d-lg-flex left-nav shadow-sm col-3 col-xl-2 bg-white h-100 flex-column justify-content-start">
      <div id="login-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.login')}}</div>
      <div id="signup-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.signUp')}}</div>
      <div id="home-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.homePage')}}</div>
      <div id="update-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.updateAccount')}}</div>
      <div id="delete-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.deleteAccount')}}</div>
    </div>

    <div class="col-10 h-100 px-5">
      <h1 class="text-center">{{__('documentation.title')}}</h1>
      <div id="doc-section-login" class="doc-section">
        <h2 class="text-start">{{__('documentation.loginPage')}}</h2>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/connexion.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
      </div>

      <div id="doc-section-signup" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.signUpForm')}}</h2>
        <h3 class="text-start">{{__('documentation.signUpAccess')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/inscription_acces.mp4') }}" type="video/mp4">
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.signUpNavigation')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/inscription_navigation.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.signUpComplexSection')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/inscription_section_complexe.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.signUpSubmit')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/inscription_soumettre.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
      </div>

      <div id="doc-section-home" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.homePage')}}</h2>
        <h3 class="text-start">{{__('documentation.signUpNavigation')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/accueil_navigation_web.mp4') }}" type="video/mp4">
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.mobileNavigation')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="250" height="400" controls>
            <source src="{{ asset('video/accueil_mobile.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
      </div>

      <div id="doc-section-update" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.updateAccount')}}</h2>
        <h3 class="text-start">{{__('documentation.sectionModification')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/accueil_modification.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.statusHistoryAcces')}}</h3>
        <p>Vidéo à venir</p>
      </div>

      <div id="doc-section-delete" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.deleteAccount')}}</h2>
        <h3 class="text-start">{{__('documentation.deactivateReactivate')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/accueil_desactivation_web.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection



@section('scripts')
<script src="{{ asset('js/documentation/documentation.js') }} "></script>
@endsection
