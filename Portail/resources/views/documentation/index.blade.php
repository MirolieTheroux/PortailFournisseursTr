@extends('layouts.app')

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
    <div class="d-none d-md-block col-2 bg-white h-100 full-viewport sticky-under-navbar d-flex flex-column justify-content-start">
      <div id="login-nav-button" class="text-center rounded py-1 mt-2 doc-nav-button">{{__('documentation.login')}}</div>
      <div id="signup-nav-button" class="text-center rounded py-1 mt-2 doc-nav-button">{{__('documentation.signUp')}}</div>
      <div id="home-nav-button" class="text-center rounded py-1 mt-2 doc-nav-button">{{__('documentation.homePage')}}</div>
      <div id="update-nav-button" class="text-center rounded py-1 mt-2 doc-nav-button">{{__('documentation.updateAccount')}}</div>
      <div id="delete-nav-button" class="text-center rounded py-1 mt-2 doc-nav-button">{{__('documentation.deleteAccount')}}</div>
    </div>
    <div class="col-10 h-100 px-5">
      <h1 class="text-center">{{__('documentation.title')}}</h1>
      <div id="doc-section-login" class="doc-section">
        <h2 class="text-start">{{__('documentation.loginPage')}}</h2>
        <h3 class="text-start">{{__('documentation.login')}} - {{__('documentation.company')}}</h3>
        <div class="d-flex w-100 justify-content-center">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/test_video_doc.mp4') }}" type="video/mp4"><!--TODO::Refaire le vidéo en navigation in private et quand le formulaire sera fini-->
              {{__('documentation.videoFail')}}
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.login')}} - {{__('documentation.particular')}}</h3>
      </div>
      <div id="doc-section-signup" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.signUpForm')}}</h2>
        <h3 class="text-start">{{__('documentation.idSection')}}</h3>
        <div class="d-flex w-100 justify-content-center">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/test_video_doc.mp4') }}" type="video/mp4"><!--TODO::Refaire le vidéo en navigation in private et quand le formulaire sera fini-->
              {{__('documentation.videoFail')}}
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.contactDetailSection')}}</h3>
        <h3 class="text-start">{{__('documentation.contactsSection')}}</h3>
        <h3 class="text-start">{{__('documentation.productServiceSection')}}</h3>
        <h3 class="text-start">{{__('documentation.rbqSection')}}</h3>
        <h3 class="text-start">{{__('documentation.attachementSection')}}</h3>
      </div>
    </div>
  </div>
</div>


@endsection



@section('scripts')
<script src="{{ asset('js/documentation/documentation.js') }} "></script>
@endsection
