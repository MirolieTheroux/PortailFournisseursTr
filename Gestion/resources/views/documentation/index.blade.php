@extends('layouts.app')

@section('title', __('documentation.title'))

@section('css')
<link rel="stylesheet" href="{{ asset('css/documentation.css') }}">
@endsection

@section('content')
<div class="container-fluid d-flex flex-column h-100">
  <div class="row h-100">
    <div class="d-none d-lg-flex left-nav shadow-sm col-3 col-xl-2 bg-white h-100 flex-column justify-content-start">
      <div id="suppliersList-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.suppliersList')}}</div>
      <div id="supplierZoom-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.supplierZoom')}}</div>
      <div id="selectedSuppliersList-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.selectedSuppliersList')}}</div>
      
      @role(['admin'])
      <div id="usersList-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.usersList')}}</div>
      <div id="parametersManagement-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.parametersManagement')}}</div>
      <div id="emailsManagement-nav-button" class="text-start rounded px-3 py-1 mt-2 doc-nav-button">{{__('documentation.emailsManagement')}}</div>
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
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/zoom_historique.mp4') }}" type="video/mp4">
          </video>
        </div>
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

      <div id="doc-section-selectedSuppliersList" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.selectedSuppliersList')}}</h2>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/selectedList.mp4') }}" type="video/mp4">
          </video>
        </div>
      </div>

      @role(['admin'])
      <div id="doc-section-usersList" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.usersList')}}</h2>
        <h3 class="text-start">{{__('documentation.accesUsersList')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/user_acces_list.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.addUser')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/user_ajouter.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.updateUser')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/user_modifier.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
        <h3 class="text-start">{{__('documentation.deleteUser')}}</h3>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/user_supprimer.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
      </div>

      <div id="doc-section-parametersManagement" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.parametersManagement')}}</h2>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/parametres.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
      </div>

      <div id="doc-section-emailsManagement" class="d-none doc-section">
        <h2 class="text-start">{{__('documentation.emailsManagement')}}</h2>
        <div class="d-flex w-100 justify-content-center mb-3">
          <video width="700" height="400" controls>
            <source src="{{ asset('video/modele_courriel.mp4') }}" type="video/mp4">
              {{__('documentation.videoFail')}}
          </video>
        </div>
      </div>
      @endrole
    </div>
  </div>
</div>


@endsection



@section('scripts')
<script src="{{ asset('js/documentation/documentation.js') }} "></script>
@endsection
