@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/documentation.css') }}">
@endsection

@section('mobile-navbar')
<div class="w-100 border-top border-dark">
  <div class="text-center w-100 p-2 fw-bolder">Documentation</div>
  <div id="login-nav-button-mobile" class="text-center w-100 p-2">Connexion</div>
  <div id="singup-nav-button-mobile" class="text-center w-100 p-2">Inscription</div>
  <div id="home-nav-button-mobile" class="text-center w-100 p-2">Page d'accueil</div>
  <div id="update-nav-button-mobile" class="text-center w-100 p-2">Modifier le dossier</div>
  <div id="delete-nav-button-mobile" class="text-center w-100 p-2">Retirer le dossier</div>
</div>
@endsection

@section('content')
<div class="container-fluid d-flex flex-column h-100">
  <div class="row h-100">
    <div class="d-none d-md-block col-2 bg-white h-100 full-viewport sticky-under-navbar d-flex flex-column justify-content-start">
      <div id="login-nav-button" class="text-center rounded py-1 mt-2 doc-nav-button">Connexion</div>
      <div id="singup-nav-button" class="text-center rounded py-1 mt-2 doc-nav-button">Inscription</div>
      <div id="home-nav-button" class="text-center rounded py-1 mt-2 doc-nav-button">Page d'accueil</div>
      <div id="update-nav-button" class="text-center rounded py-1 mt-2 doc-nav-button">Modifier le dossier</div>
      <div id="delete-nav-button" class="text-center rounded py-1 mt-2 doc-nav-button">Retirer le dossier</div>
    </div>
    <div class="col-10 h-100 px-5">
      <h1 class="text-center">Documentation</h1>
      <div id="doc-section-login" class="doc-section">
        <h2 class="text-start">Page de connexion</h2>
        <h3 class="text-start">Connexion - Entreprise</h3>
        <div class="d-flex w-100 justify-content-center">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/test_video_doc.mp4') }}" type="video/mp4"><!--TODO::Refaire le vidéo en navigation in private et quand le formulaire sera fini-->
            Your browser does not support the video tag.
          </video>
        </div>
        <h3 class="text-start">Connexion - Particulier</h3>
      </div>
      <div id="doc-section-singup" class="d-none doc-section">
        <h2 class="text-start">Formulaire d'inscription</h2>
        <h3 class="text-start">Section identification</h3>
        <div class="d-flex w-100 justify-content-center">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/test_video_doc.mp4') }}" type="video/mp4"><!--TODO::Refaire le vidéo en navigation in private et quand le formulaire sera fini-->
            Your browser does not support the video tag.
          </video>
        </div>
        <h3 class="text-start">Section coordonnée</h3>
        <h3 class="text-start">Section contacts</h3>
        <h3 class="text-start">Section produits et services</h3>
        <h3 class="text-start">Section licence RBQ</h3>
        <h3 class="text-start">Section pièces jointes</h3>
      </div>
    </div>
  </div>
</div>


@endsection



@section('scripts')
<script src="{{ asset('js/documentation/documentation.js') }} "></script>
@endsection
