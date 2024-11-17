@extends('layouts.app')

@section('title', __('documentation.title'))

@section('css')
<link rel="stylesheet" href="{{ asset('css/documentation.css') }}">
@endsection

@section('content')
<div class="container-fluid d-flex flex-column h-100">
  <div class="row h-100">
    <!--NICE_TO_HAVE::Box-Shadow pour le menu du côté.-->
    <div class="d-none d-lg-flex left-nav shadow-sm col-3 col-xl-2 bg-white h-100 flex-column justify-content-start">
      <div id="suppliersList-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.suppliersList')}}</div>
      <div id="supplierZoom-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.supplierZoom')}}</div>
      <div id="selectedSuppliersList-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.selectedSuppliersList')}}</div>
      
      @role(['admin'])
      <div id="update-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.usersList')}}</div>
      <div id="delete-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.addUser')}}</div>
      <div id="update-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.updateUser')}}</div>
      <div id="delete-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.deleteUser')}}</div>
      <div id="update-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.parametersManagement')}}</div>
      <div id="delete-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.emailsManagement')}}</div>
      @endrole
    </div>

    <div class="col-10 h-100 px-5">
      <h1 class="text-center">{{__('documentation.title')}}</h1>
      <div id="doc-section-suppliersList" class="doc-section">
        <h2 class="text-start">{{__('documentation.suppliersList')}}</h2>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/listeFournisseur_filtres.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
      </div>

      <div id="doc-section-supplierZoom" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.supplierZoom')}}</h2>
        <h3 class="text-start">{{__('documentation.signUpNavigation')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/zoom_navigation_web.mp4') }}" type="video/mp4">
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.statusHistoryAcces')}}</h3>
        <p>Vidéo à venir</p>
        @role(['responsable', 'admin'])
        <h3 class="text-start">{{__('documentation.sectionModification')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/zoom_modification.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.acceptDenyRequest')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/zoom_accepter_refuser.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.deactivateReactivate')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/zoom_retirer_remettre.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.exportToFinance')}}</h3>
        <p>Vidéo à venir</p>
        @endrole
      </div>

      <div id="doc-section-home" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.homePage')}}</h2>
        <h3 class="text-start">{{__('documentation.signUpNavigation')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          {{-- <video width="700" height="400" controls>
            <source src="{{ asset('video/accueil_navigation_web.mp4') }}" type="video/mp4">
          </video> --}}
        </div>
        <h3 class="text-start">{{__('documentation.mobileNavigation')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          {{-- <video width="250" height="400" controls>
            <source src="{{ asset('video/accueil_mobile.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video> --}}
        </div>
      </div>

      <div id="doc-section-update" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.updateAccount')}}</h2>
        <h3 class="text-start">{{__('documentation.sectionModification')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          {{-- <video width="700" height="400" controls>
            <source src="{{ asset('video/accueil_modification.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video> --}}
        </div>
        <h3 class="text-start">{{__('documentation.statusHistoryAcces')}}</h3>
        <p>Vidéo à venir</p>
      </div>

      <div id="doc-section-delete" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.deleteAccount')}}</h2>
        <h3 class="text-start">{{__('documentation.deactivateReactivate')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          {{-- <video width="700" height="400" controls>
            <source src="{{ asset('video/accueil_desactivation_web.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video> --}}
        </div>
      </div>
    </div>
  </div>
</div>


@endsection



@section('scripts')
<script src="{{ asset('js/documentation/documentation.js') }} "></script>
@endsection
