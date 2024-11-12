<!--//* NICE_TO_HAVE::(nice_to_have) lorsqu'on clique sur "modifier", ne pas afficher le bouton enregistrer si il n'y a pas de changement (sinon, je fais enregistrer et ça change la date sans modification)-->
<!--//* NICE_TO_HAVE::(À faire pour le portail fournisseur) Quand la personne arrive sur la page, si elle n'a pas rempli la section finance, elle pourrait avoir un bouton "Remplir mes informations de finances"-->
<!--//* NICE_TO_HAVE::Potentiel nice to have, est-ce qu'on veut laisser le invalid si la personne quitte le modal de refus et reviens après ?-->

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/suppliers/show.css') }}">
@endsection

@section('title', 'Gestion - ' . $supplier->name)
<!--//* NICE_TO_HAVE
  - Quand on arrive sur la fiche fournisseur mettre le statut demande sélectionné sur le côté.
-->
@section('content')
<div class="container-fluid h-100">
  <div class="row h-100">
    <!--NAVIGATION CÔTÉ-->
    <div class="left-nav shadow-sm col-2 bg-white h-100 full-viewport sticky-under-navbar d-flex flex-column justify-content-start">
      <h4 class="py-2 fw-bold">{{$supplier->name}}</h4>
      @role(['responsable', 'admin'])
        <button id="btnExport" type="" class="my-2 py-1 rounded button-darkblue">{{__('show.exportSupplierToFinance')}}</button>
        @if($supplier->latestNonModifiedStatus()->status == 'deactivated')
        <a id="btnDelete" href="{{route('suppliers.reactivate', ['supplier' => $supplier->id])}}" class="my-2 py-1 rounded button-darkblue text-center">{{__('show.reactivate')}}</a>
        @else
        <a id="btnDelete" href="{{route('suppliers.removeFromList', ['supplier' => $supplier->id])}}" class="my-2 py-1 rounded button-darkblue text-center">{{__('show.removeFromList')}}</a>
        @endif
      @endrole
      <div id="requestStatus-nav-button" class="py-1 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="m-2">
          <path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="m-2 d-none section-clicked">
          <path d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
        </svg>
        {{__('show.requestStatus')}}
      </div>
      <div id="identification-nav-button" class="py-1 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="m-2">
          <path d="M256 48l0 16c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32-14.3-32-32l0-16L64 48c-8.8 0-16 7.2-16 16l0 384c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16l0-384c0-8.8-7.2-16-16-16l-64 0zM0 64C0 28.7 28.7 0 64 0L320 0c35.3 0 64 28.7 64 64l0 384c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zM160 320l64 0c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16L96 416c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="m-2 d-none section-clicked">
          <path d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-384c0-35.3-28.7-64-64-64L64 0zm96 320l64 0c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16L96 416c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM144 64l96 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-96 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
        </svg>
        {{__('show.identification')}}
      </div>
      <div id="contactDetails-nav-button" class="py-1 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="m-2">
          <path d="M512 80c8.8 0 16 7.2 16 16l0 320c0 8.8-7.2 16-16 16L64 432c-8.8 0-16-7.2-16-16L48 96c0-8.8 7.2-16 16-16l448 0zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zM208 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm-32 32c-44.2 0-80 35.8-80 80c0 8.8 7.2 16 16 16l192 0c8.8 0 16-7.2 16-16c0-44.2-35.8-80-80-80l-64 0zM376 144c-13.3 0-24 10.7-24 24s10.7 24 24 24l80 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-80 0zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24l80 0c13.3 0 24-10.7 24-24s-10.7-24-24-24l-80 0z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="m-2 d-none section-clicked">
          <path d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm80 256l64 0c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16L80 384c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zm256-32l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
        </svg>
        {{__('show.contactDetails')}}
      </div>
      <div id="contacts-nav-button" class="py-1 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="m-2">
          <path d="M384 48c8.8 0 16 7.2 16 16l0 384c0 8.8-7.2 16-16 16L96 464c-8.8 0-16-7.2-16-16L80 64c0-8.8 7.2-16 16-16l288 0zM96 0C60.7 0 32 28.7 32 64l0 384c0 35.3 28.7 64 64 64l288 0c35.3 0 64-28.7 64-64l0-384c0-35.3-28.7-64-64-64L96 0zM240 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm-32 32c-44.2 0-80 35.8-80 80c0 8.8 7.2 16 16 16l192 0c8.8 0 16-7.2 16-16c0-44.2-35.8-80-80-80l-64 0zM512 80c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16s16-7.2 16-16l0-64zM496 192c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16s16-7.2 16-16l0-64c0-8.8-7.2-16-16-16zm16 144c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16s16-7.2 16-16l0-64z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="m-2 d-none section-clicked">
          <path d="M96 0C60.7 0 32 28.7 32 64l0 384c0 35.3 28.7 64 64 64l288 0c35.3 0 64-28.7 64-64l0-384c0-35.3-28.7-64-64-64L96 0zM208 288l64 0c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16l-192 0c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM512 80c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16s16-7.2 16-16l0-64zM496 192c-8.8 0-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16s16-7.2 16-16l0-64c0-8.8-7.2-16-16-16zm16 144c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 64c0 8.8 7.2 16 16 16s16-7.2 16-16l0-64z" />
        </svg>
        {{__('show.contacts')}}
      </div>
      <div id="productsServices-nav-button" class="py-1 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="m-2">
          <path d="m2,2.5c0-1.381,1.119-2.5,2.5-2.5s2.5,1.119,2.5,2.5-1.119,2.5-2.5,2.5-2.5-1.119-2.5-2.5Zm5,7.5c-.552,0-1,.447-1,1v4h-2c-1.103,0-2-.897-2-2v-3c0-1.103.897-2,2-2h10c.552,0,1-.447,1-1s-.448-1-1-1H4C1.794,6,0,7.794,0,10v3c0,1.474.81,2.75,2,3.444v6.556c0,.553.448,1,1,1s1-.447,1-1v-6h2v6c0,.553.448,1,1,1s1-.447,1-1v-12c0-.553-.448-1-1-1Zm17,9v2c0,1.654-1.346,3-3,3h-2c-.771,0-1.468-.301-2-.78-.532.48-1.229.78-2,.78h-2c-1.654,0-3-1.346-3-3v-2c0-1.654,1.346-3,3-3h.184c-.112-.314-.184-.648-.184-1v-2c0-1.654,1.346-3,3-3h2c1.654,0,3,1.346,3,3v2c0,.352-.072.686-.184,1h.184c1.654,0,3,1.346,3,3Zm-9-4c0,.552.449,1,1,1h2c.551,0,1-.448,1-1v-2c0-.552-.449-1-1-1h-2c-.551,0-1,.448-1,1v2Zm1,6v-2c0-.552-.449-1-1-1h-2c-.551,0-1,.448-1,1v2c0,.552.449,1,1,1h2c.551,0,1-.448,1-1Zm6-2c0-.552-.449-1-1-1h-2c-.551,0-1,.448-1,1v2c0,.552.449,1,1,1h2c.551,0,1-.448,1-1v-2Z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="m-2 d-none section-clicked">
          <path d="m2,2.5c0-1.381,1.119-2.5,2.5-2.5s2.5,1.119,2.5,2.5-1.119,2.5-2.5,2.5-2.5-1.119-2.5-2.5Zm3,12.5h-2v-5.5c0-.275.224-.5.5-.5h10.5v-3H3.5c-1.93,0-3.5,1.57-3.5,3.5v8.5h2v6h6v-13h-3v4Zm17.5,3h-3c-.828,0-1.5.672-1.5,1.5v4.5h6v-4.5c0-.828-.672-1.5-1.5-1.5Zm-8,0h-3c-.828,0-1.5.672-1.5,1.5v4.5h6v-4.5c0-.828-.672-1.5-1.5-1.5Zm-.5-2h6v-4.5c0-.828-.672-1.5-1.5-1.5h-3c-.828,0-1.5.672-1.5,1.5v4.5Z" />
        </svg>
        {{__('show.productsAndServices')}}
      </div>
      <div id="licence-nav-button" class="py-1 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="m-2">
          <path d="m19,3H5C2.243,3,0,5.243,0,8v8c0,2.757,2.243,5,5,5h14c2.757,0,5-2.243,5-5v-8c0-2.757-2.243-5-5-5Zm3,13c0,1.654-1.346,3-3,3H5c-1.654,0-3-1.346-3-3v-8c0-1.654,1.346-3,3-3h14c1.654,0,3,1.346,3,3v8Zm-2-8c0,.553-.448,1-1,1h-4c-.552,0-1-.447-1-1s.448-1,1-1h4c.552,0,1,.447,1,1Zm0,4c0,.553-.448,1-1,1h-4c-.552,0-1-.447-1-1s.448-1,1-1h4c.552,0,1,.447,1,1Zm-2,4c0,.553-.448,1-1,1h-2c-.552,0-1-.447-1-1s.448-1,1-1h2c.552,0,1,.447,1,1Zm-5.545-5.017c.108.296.019.628-.222.831l-1.774,1.445.734,2.235c.1.302-.001.635-.254.83-.253.194-.601.208-.867.034l-2.065-1.345-2.031,1.359c-.126.085-.272.127-.417.127-.159,0-.317-.05-.45-.15-.255-.191-.361-.522-.266-.825l.706-2.262-1.783-1.451c-.24-.204-.327-.535-.219-.83.108-.295.389-.491.704-.491h2.251l.797-2.235c.109-.293.39-.488.703-.488s.594.195.703.488l.797,2.235h2.251c.315,0,.597.197.705.493Z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="m-2 d-none section-clicked">
          <path d="m19,3H5C2.243,3,0,5.243,0,8v8c0,2.757,2.243,5,5,5h14c2.757,0,5-2.243,5-5v-8c0-2.757-2.243-5-5-5Zm-7.767,8.814l-1.774,1.445.734,2.235c.1.302-.001.635-.254.83-.253.194-.601.208-.867.034l-2.065-1.345-2.031,1.359c-.126.085-.272.127-.417.127-.159,0-.317-.05-.45-.15-.255-.191-.361-.522-.266-.825l.706-2.262-1.783-1.451c-.24-.204-.327-.535-.219-.83.108-.295.389-.491.704-.491h2.251l.797-2.235c.109-.293.39-.488.703-.488s.594.195.703.488l.797,2.235h2.251c.315,0,.597.197.705.493s.019.628-.222.831Zm5.767,5.186h-2c-.552,0-1-.447-1-1s.448-1,1-1h2c.552,0,1,.447,1,1s-.448,1-1,1Zm3-4h-5c-.552,0-1-.447-1-1s.448-1,1-1h5c.552,0,1,.447,1,1s-.448,1-1,1Zm0-4h-5c-.552,0-1-.447-1-1s.448-1,1-1h5c.552,0,1,.447,1,1s-.448,1-1,1Z" />
        </svg>
        {{__('show.rqbLicence')}}
      </div>
      <div id="attachments-nav-button" class="py-1 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="m-2">
          <path d="M320 464c8.8 0 16-7.2 16-16l0-288-80 0c-17.7 0-32-14.3-32-32l0-80L64 48c-8.8 0-16 7.2-16 16l0 384c0 8.8 7.2 16 16 16l256 0zM0 64C0 28.7 28.7 0 64 0L229.5 0c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3L384 448c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="m-2 d-none section-clicked">
          <path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z" />
        </svg>
        {{__('show.attachmentFiles')}}
      </div>
      <div id="finances-nav-button" class="py-1 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="m-2">
          <path d="M23.02,8.79c-.59-.54-1.36-.81-2.17-.78-.8,.04-1.54,.39-2.09,.98l-3.22,3.53c-.55-.91-1.55-1.52-2.69-1.52h-3.86v-1h.38c1.45,0,2.62-1.18,2.62-2.62,0-1.29-.92-2.38-2.19-2.59l-3.29-.55c-.3-.05-.52-.31-.52-.62,0-.34,.28-.62,.62-.62h2.38c.55,0,1,.45,1,1h2c0-1.65-1.35-3-3-3V0h-2V1h-.38c-1.45,0-2.62,1.18-2.62,2.62,0,1.29,.92,2.38,2.19,2.59l3.29,.55c.3,.05,.52,.31,.52,.62,0,.34-.28,.62-.62,.62h-2.38c-.55,0-1-.45-1-1h-2c0,1.65,1.35,3,3,3v1H3c-1.65,0-3,1.35-3,3v7c0,1.65,1.35,3,3,3H13.45l9.79-10.99c1.09-1.23,.99-3.12-.22-4.23Zm-1.27,2.9l-9.19,10.32H3c-.55,0-1-.45-1-1v-7c0-.55,.45-1,1-1H12.86c.63,0,1.14,.51,1.14,1.14,0,.56-.42,1.05-.98,1.13l-5.16,.74,.28,1.98,5.16-.74c1.18-.17,2.13-.99,2.51-2.06l4.43-4.86c.18-.2,.43-.32,.7-.33,.27,0,.53,.08,.73,.26,.41,.37,.44,1.01,.07,1.42Z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="m-2 d-none section-clicked">
          <path d="M4,11c-2.21,0-4,1.79-4,4v5c0,2.21,1.79,4,4,4h4.26c2.8,0,5.48-1.18,7.37-3.25l7.7-8.41c.95-1.06,.86-2.71-.19-3.66-.51-.47-1.19-.71-1.88-.68-.7,.03-1.34,.33-1.79,.83l-3.54,3.74c.03,.21,.06,.42,.06,.64,0,2.08-1.55,3.88-3.62,4.17l-4.25,.6c-.55,.08-1.05-.3-1.13-.85-.08-.55,.3-1.05,.85-1.13l4.16-.58c.94-.13,1.75-.81,1.94-1.73,.3-1.43-.79-2.69-2.16-2.69H4Z" />
          <path d="M9.81,4.79l-3.29-.55c-.3-.05-.52-.31-.52-.62,0-.34,.28-.62,.62-.62h2.64c.36,0,.69,.19,.87,.5,.28,.48,.89,.64,1.37,.36,.48-.28,.64-.89,.37-1.37-.54-.92-1.53-1.5-2.6-1.5h-.27c0-.55-.45-1-1-1s-1,.45-1,1h-.38c-1.45,0-2.62,1.18-2.62,2.62,0,1.29,.92,2.38,2.19,2.59l3.29,.55c.3,.05,.52,.31,.52,.62,0,.34-.28,.62-.62,.62h-2.64c-.36,0-.69-.19-.87-.5-.28-.48-.89-.64-1.37-.36-.48,.28-.64,.89-.37,1.37,.54,.92,1.53,1.5,2.6,1.5h.27c0,.55,.45,1,1,1s1-.45,1-1h.38c1.45,0,2.62-1.18,2.62-2.62,0-1.29-.92-2.38-2.19-2.59Z" />
        </svg>
        {{__('show.finance')}}
      </div>
    </div> <!-- FIN NAVIGATION CÔTÉ-->

    <div class="col-10 h-100 px-4 py-0">
      <!--ETAT DEMANDE-->
      <!--//TODO::
        - Afficher dans le popover les modifications quand la BD sera faite.
      -->
      <!--//* NICE_TO_HAVE::
        - Mettre texte et curseur du textarea pour la raison du refus au début.
        - Mettre les statuts égaux 
      -->
      <!-- Modal for History -->
      <div class="modal fade" id="modalHistory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="statusHistory" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">{{__('show.history')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="d-flex flex-row justify-content-between">
                <div class="px-3 fw-bold">{{__('show.dateAndTime')}}</div>
                <div class="px-3 fw-bold">{{__('show.requestStatus')}}</div>
                <div class="px-3 fw-bold">{{__('show.modifiedBy')}}</div>
              </div>
              @foreach ($decryptedReasons as $reason)
              <div class="d-flex flex-row justify-content-between">
                <div class="px-3">{{ $reason->created_at }}</div>
                
                <div class="px-3 status">
                  @switch($reason->status)
                  @case('denied')
                  <a href="#" tabindex="0"
                    class="popover-link"
                    data-bs-toggle="popover"
                    data-bs-trigger="click"
                    data-bs-content="{{$reason->refusal_reason}}">
                    {{ __('global.denied') }}
                  </a>
                  @break

                  @case('modified')
                  <a href="#" tabindex="0"
                    class="popover-link"
                    data-bs-toggle="popover"
                    data-bs-trigger="click"
                    data-bs-content="Afficher les modifications.">
                    {{ __('global.modified') }}
                  </a>
                  @break

                  @case('accepted')
                  {{ __('global.accepted') }}
                  @break

                  @case('waiting')
                  {{ __('global.waiting') }}
                  @break

                  @case('toCheck')
                  {{ __('global.toCheck') }}
                  @break

                  @case('deactivated')
                  {{ __('global.deactivated') }}
                  @break

                  @default
                  {{ $reason->status }}
                  @endswitch
                </div>

                <div class="px-3">{{ $reason->updated_by }}</div>
              </div>
              @endforeach
            </div>
            <div class="modal-footer">
              <button type="button" class="m-2 py-1 px-3 rounded button-darkblue" data-bs-dismiss="modal">{{__('global.close')}}</button>
            </div>
          </div>
        </div>
      </div> <!-- END Modal for History-->

      <!--Approval Modal-->
      <div class="modal fade" id="approvalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">{{__('show.confirmation')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">{{__('show.acceptConfirmation')}}</div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('global.cancel')}}</button>
              <a type="button" href="{{route('suppliers.approveRequest', ['supplier' => $supplier->id])}}" class="m-2 py-2 px-3 rounded button-darkblue">{{__('global.confirm')}}</a>
            </div>
          </div>
        </div>
      </div><!-- END Approval Modal-->

      <!--Denial Modal-->
      <div class="modal fade" id="denialModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="denialModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <form id="denialForm" class="modal-content" method="POST" action="{{route('suppliers.denyRequest', [$supplier])}}" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">{{__('show.confirmation')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div>
                {{__('show.denyConfirmation')}}
              </div>
              
              <div class="text-start">
                <div class="form-floating mb-3">
                  <textarea type="textarea" name="deniedReason" id="deniedReason" class="form-control " placeholder=""></textarea>
                  <label for="deniedReason">{{__('show.deniedReason')}}</label>
                  <div class="invalid-feedback d-none" id="denialReasonRequiredError">{{__('show.denialReasonRequiredError')}}</div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('global.cancel')}}</button>
              <button id="denialConfirmButton" type="submit" class="m-2 py-2 px-3 rounded button-darkblue">{{__('global.confirm')}}</a>
            </div>
          </form>
        </div>
      </div><!-- END Denial Modal-->

      <div class="container d-flex flex-column h-100 show-section" id="requestStatus-section">
        @role(['responsable', 'admin'])
          @if($supplier->latestNonModifiedStatus()->status == 'waiting' || $supplier->latestNonModifiedStatus()->status == 'toCheck')
            <div class="d-flex justify-content-end btnRequest">
              <button id="btnAccept" type="button" class="m-2 py-1 px-3 rounded button-darkblue" data-bs-toggle="modal" data-bs-target="#approvalModal">{{__('show.acceptRequest')}}</button>
              <button id="btnDeny" type="button" class="m-2 py-1 px-3 rounded button-darkblue" data-bs-toggle="modal" data-bs-target="#denialModal">{{__('show.denyRequest')}}</button>
            </div>
          @endif
        @endrole
        <form class="h-100 w-100 d-flex align-items-center" method="POST" action="{{route('suppliers.updateStatus', [$supplier])}}" enctype="multipart/form-data">
          @csrf
          <div class="bg-white my-2 rounded form-section w-100">
            <div class="row py-2">
              <div class="offset-2 col-8 text-center">
                <h1>{{__('form.requestStatusTitle')}}</h1>
              </div>
              @role(['responsable', 'admin'])
              <div class="col-2">
                <button id="btnHistory" type="button" class="m-2 py-1 px-3 rounded button-darkblue">{{__('show.history')}}</button>
              </div>
              @endrole
            </div>
            <div class="px-3">
              <div class="row pb-3">
                <div class="col-6">
                  <div class="form-floating">
                    <select name="requestStatus" id="requestStatus" class="form-select" aria-label="" disabled>
                      <option value="">
                      <option value="waiting" {{ $supplier->latestNonModifiedStatus()->status === 'waiting' ? 'selected' : null}}>{{__('global.waiting')}}</option>
                      <option value="toCheck" {{ $supplier->latestNonModifiedStatus()->status === 'toCheck' ? 'selected' : null}}>{{__('global.toCheck')}}</option>
                      <option value="accepted" {{ $supplier->latestNonModifiedStatus()->status === 'accepted' ? 'selected' : null}}>{{__('global.accepted')}}</option>
                      <option value="denied" {{ $supplier->latestNonModifiedStatus()->status === 'denied' ? 'selected' : null}}>{{__('global.denied')}}</option>
                      <option value="deactivated" {{ $supplier->latestNonModifiedStatus()->status === 'deactivated' ? 'selected' : null}} disabled>{{__('global.deactivated')}}</option>
                    </select>
                    <label for="requestStatus" id="">{{__('form.status')}}</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-floating">
                    <input type="date" name="requestStatusDate" id="requestStatusDate" class="form-control" value="{{date_format($supplier->latestNonModifiedStatus()->created_at, 'Y-m-d')}}" placeholder="" disabled>
                    <label for="requestStatusDate" id="">{{__('form.requestResponseDate')}}</label>
                  </div>
                </div>
              </div>
              <div class="row pb-3">
                <div class="col-6">
                  <div class="form-floating">
                    <input type="date" name="requestStatusCreatedDate" id="requestStatusCreatedDate" class="form-control" value="{{date_format($supplier->created_at, 'Y-m-d')}}" placeholder="" disabled>
                    <label for="requestStatusCreatedDate" id="">{{__('form.requestCreatedDate')}}</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-floating">
                    <input
                      type="date"
                      name="requestLastModifiedDate"
                      id="requestLastModifiedDate"
                      class="form-control"
                      value="{{is_null($supplier->latestModifiedDate()) ? date_format($supplier->created_at, 'Y-m-d') : date_format($supplier->latestModifiedDate()->created_at, 'Y-m-d')}}"
                      placeholder=""
                      disabled>
                    <label for="requestLastModifiedDate" id="">{{__('form.requestLastModifiedDate')}}</label>
                  </div>
                </div>
              </div>
              @role(['responsable', 'admin'])
              <div class="d-none deniedDivReason">
                <div class="form-floating">
                  <textarea
                    class="form-control"
                    name="deniedReasonText"
                    placeholder="" id="deniedReasonText"
                    style="height: 175px; resize: none;"
                    maxlength="1500"
                    disabled>
                    {{is_null($latestDeniedReason) ? '' : $latestDeniedReason->refusal_reason }}
                  </textarea>
                  <label for="deniedReasonText" class="labelbackground">{{__('form.deniedReason')}}</label>
                </div>
              </div>
              <div class="invalid-feedback pb-3" id="deniedReasonRequired" style="display: none;">{{__('show.denialReasonRequiredError')}}</div>
              @if($errors->has('deniedReason'))
                 <p>{{ $errors->first('deniedReason') }}</p>
              @endif
              <div class="row">
                <div class="col-12 mb-2 d-flex justify-content-center">
                  <button id="btnCancelRequestStatus" type="button" class="m-2 py-1 px-3 rounded previous-button d-none">{{__('global.cancel')}}</button>
                  <button id="btnEditRequestStatus" type="button" class="m-2 py-1 px-3 rounded button-darkblue edit">{{__('global.edit')}}</button>
                  <button id="btnSaveRequestStatus" type="submit" class="m-2 py-1 px-3 rounded button-darkblue d-none save">{{__('global.save')}}</button>
                </div>
              </div>
              @endrole
            </div>
          </div>
        </form>
      </div><!--FIN ETAT DEMANDE-->
      <!--//* NICE_TO_HAVE::
       - Voir pourquoi quand on enregistre les boutons disparaissent.
       - Est ce qu'on met un message quand il l'utilisateur enregistre, mais qu'il n'y a pas de modification de détectée ?
       - Est-ce qu'on met une erreur s'il y a déjà un Neq et que l'utilisateur l'enlève ? 
       -->
      <!--IDENTIFICATION-->
      <div class="container d-flex flex-column h-100 show-section" id="identification-section">
        <form class="h-100 w-100 d-flex align-items-center" method="POST" action="{{route('suppliers.updateIdentification', [$supplier])}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
          <div class="bg-white my-2 rounded form-section w-100">
            <div class="row">
              <div class="col-12 text-center">
                <h1>{{__('form.identificationTitle')}}</h1>
              </div>
            </div>
            <div class="px-3">
              <div class="row pb-3">
                <div class="col-6">
                  <div class="form-floating">
                    <input type="text" id="supplierId" value="{{ $supplier->id ? : '' }}" hidden>
                    <input type="text" name="neq" id="neq" class="form-control" placeholder="" value="{{ $supplier->neq ? : 'N/A' }}" maxlength="10" disabled>
                    <label for="neq">{{__('form.neqLabel')}}</label>
                    <div class="invalid-feedback" id="neqInvalidStart" style="display: none;">{{__('validation.starts_with', ['attribute' => 'NEQ', 'values' => '11, 22, 33 ou 88'])}}</div>
                    <div class="invalid-feedback" id="neqInvalidCharacters" style="display: none;">{{__('form.identificationValidationNEQOnlyDigits')}}</div>
                    <div class="invalid-feedback" id="neqInvalidAmount" style="display: none;">{{__('form.identificationValidationNEQAmount')}}</div>
                    <div class="invalid-feedback" id="neqInvalidExist" style="display: none;">{{__('form.identificationNeqExistValidation')}}</div>
                  </div>
                  @if($errors->has('neq'))
                  <p>{{ $errors->first('neq') }}</p>
                  @endif
                </div>
                <div class="col-6">
                  <div class="form-floating">
                    <input type="text" name="name" id="name" class="form-control" placeholder="" value="{{ $supplier->name }}" maxlength="64" disabled>
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
              <div class="row pb-3">
                <div class="col-12">
                  <div class="form-floating">
                    <input type="email" name="email" id="email" class="form-control" placeholder="" value="{{ $supplier->email }}" maxlength="64" disabled>
                    <label for="email">{{__('form.emailLabel')}}</label>
                    <div class="invalid-feedback" id="emailInvalidEmpty" style="display: none;">{{__('validation.required', ['attribute' => 'Adresse courriel'])}}</div>
                    <div class="invalid-feedback" id="emailInvalidFormat" style="display: none;">{{__('form.contactsEmailsValidationFormat')}}</div>
                    <div class="invalid-feedback" id="emailInvalidUnique" style="display: none;">{{__('form.identificationValidationEmailUnique')}}</div>
                  </div>
                </div>
                @if($errors->has('email'))
                <p>{{ $errors->first('email') }}</p>
                @endif
              </div>
              @role(['responsable', 'admin'])
              <div class="row">
                <div class="col-12 d-flex justify-content-center mb-2">
                  @php
                    $refreshCount = request('refresh') ? request('refresh') + 1 : 1;
                  @endphp
                  <a id="btnCancelId" href="{{ route('suppliers.show', [$supplier, 'refresh' => $refreshCount]) }}#identification-section" class="m-2 py-1 px-3 rounded previous-button d-none">{{__('global.cancel')}}</a>
                  <button id="btnModifyId" type="button" class="m-2 py-1 px-3 rounded button-darkblue edit">{{__('global.edit')}}</button>
                  <button id="btnSaveId" type="submit" class="m-2 py-1 px-3 rounded button-darkblue d-none save">{{__('global.save')}}</button>
                </div>
              </div>
              @endrole
            </div>
          </div>
        </form>  
      </div><!--FIN IDENTIFICATION-->
      <!--COORDONNÉES-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="contactDetails-section">
        <div class="bg-white rounded my-2 form-section px-3">
          <div class="row">
            <div class="col-12 text-center">
              <h1 class="section-title">{{__('form.contactDetailsTitle')}}</h1>
            </div>
          </div>
          <div class="row px-3">
            <div class="col-12 col-md-6 d-flex flex-column">
              <h2 class="text-center section-subtitle">{{__('form.contactDetailsAddressSection')}}</h2>
              <div class=" text-center d-flex flex-row pb-3">
                <div class="form-floating col-6 pe-2">
                  <input type="text" name="contactDetailsCivicNumber" id="contactDetailsCivicNumber" class="form-control" value="{{ $supplier->address->civic_no }}" placeholder="" maxlength="8" disabled>
                  <label for="contactDetailsCivicNumber" id="civicNumber">{{__('form.civicNumberLabel')}}</label>
                </div>
                <div class="form-floating col-6">
                  <input type="text" name="contactDetailsOfficeNumber" id="contactDetailsOfficeNumber" class="form-control" value="{{ $supplier->address->office ? : 'N/A' }}" placeholder="" maxlength="8" disabled>
                  <label for="contactDetailsOfficeNumber" id="officeNumber">{{__('form.officeNumber')}}</label>
                </div>
              </div>
              <div class="text-center mb-4">
                <div class="form-floating">
                  <input type="text" name="contactDetailsStreetName" id="contactDetailsStreetName" class="form-control" value="{{ $supplier->address->street }}" placeholder="" maxlength="64" disabled>
                  <label for="contactDetailsStreetName">{{__('form.streetName')}}</label>
                </div>
              </div>
              <div class="d-flex flex-column justify-content-between h-100">
                <div class="text-center d-flex flex-row pb-3">
                  <div class="form-floating col-6 pe-2" id="div-city">
                    <select name="contactDetailsCitySelect" id="contactDetailsCitySelect" class="form-select" aria-label="" disabled>
                      <option>{{ $supplier->address->city }}</option>
                    </select>
                    <input type="text" name="contactDetailsInputCity" id="contactDetailsInputCity" class="form-control d-none" value="{{ $supplier->address->city }}" placeholder="" maxlength="64" disabled>
                    <label for="contactDetailsCitySelect">{{__('form.city')}}</label>
                  </div>
                  <div class="form-floating col-6">
                    <select name="contactDetailsProvince" id="contactDetailsProvince" class="form-select" aria-label="" disabled>
                      <option>{{ $supplier->address->province->name }}</option>
                    </select>
                    <label for="contactDetailsProvince">{{__('form.province')}}</label>
                  </div>
                </div>
                <div class="text-center d-flex flex-row mb-4">
                  <div class="form-floating col-8 pe-2">
                    <select name="contactDetailsDistrictArea" id="contactDetailsDistrictArea" class="form-select" aria-label="" disabled>
                      <option>{{ $supplier->address->region }}</option>
                    </select>
                    <label for="contactDetailsDistrictArea">{{__('form.districtArea')}}</label>
                  </div>
                  <div class="form-floating">
                    <input type="text" name="contactDetailsPostalCode" id="contactDetailsPostalCode" class="form-control" value="{{ $supplier->address->postal_code }}" placeholder="" maxlength="6" disabled>
                    <label for="contactDetailsPostalCode" id="postalCode">{{__('form.postalCode')}}</label>
                  </div>
                </div>
                <div class="text-center mb-4">
                  <div class="form-floating">
                    <input type="text" name="contactDetailsWebsite" id="contactDetailsWebsite" class="form-control" value="{{ $supplier->site ? : 'N/A' }}" placeholder="" maxlength="64" disabled>
                    <label for="contactDetailsWebsite">{{__('form.website')}}</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 d-flex flex-column">
              <h2 class="text-center section-subtitle">{{__('form.contactDetailsPhoneNumbersSection')}}</h2>
              <div class="text-center d-flex flex-row pb-3 d-none">
                <div class="form-floating col-3">
                  <select name="contactDetailsPhoneType" id="contactDetailsPhoneType" class="form-select" aria-label="" disabled>
                    <option value="{{__('form.officeNumber')}}">{{__('form.officeNumber')}}</option>
                    <option value="{{__('form.fax')}}">{{__('form.fax')}}</option>
                    <option value="{{__('form.cellphone')}}">{{__('form.cellphone')}}</option>
                  </select>
                  <label for="contactDetailsPhoneType">{{__('form.typeLabel')}}</label>
                </div>
                <div class="form-floating col-5 px-2">
                  <input type="text" name="contactDetailsPhoneNumber" id="contactDetailsPhoneNumber" class="form-control" placeholder="" maxlength="12" disabled>
                  <label class="ms-2" for="contactDetailsPhoneNumber">{{__('form.numberLabel')}}</label>
                </div>
                <div class="form-floating col-3">
                  <input type="text" name="contactDetailsPhoneExtension" id="contactDetailsPhoneExtension" class="form-control" placeholder="" maxlength="6" disabled>
                  <label for="contactDetailsPhoneExtension">{{__('form.phoneExtension')}}</label>
                </div>
                <div class="col-1 d-flex align-items-center">
                  <svg id="add-icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16" style="cursor: pointer; padding-left:10px">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                  </svg>
                </div>
              </div>
              <div class="form-floating h-100 pb-4" id="div-phoneNumberList">
                <div class="form-control pt-2 h-100  mb-4" id="contactDetailsPhoneNumberList" style="overflow-x: hidden; overflow-y: auto;">
                  <div class="fs-5 text-start title-border fw-bold" for="contactDetailsPhoneNumberList">{{__('form.phoneNumberList')}}</div>
                  <div class="d-flex flex-row mt-2">
                    <div class="col-2 fs-6">{{__('form.typeLabel')}}</div>
                    <div class="col-6 fs-6 text-center" id="phoneNumber">{{__('form.phoneNumber')}}</div>
                    <div class="col-2 fs-6 text-center">{{__('form.phoneExtension')}}</div>
                    <div class="col-2 "></div>
                  </div>
                  <div class=" pt-3" id="phoneNumberList">
                    @foreach($formattedPhoneNumbersContactDetails as $phoneNumber)
                    <div class="d-flex flex-row align-items-center divPhone">
                      <div class="col-2 text-start phoneType">{{ $phoneNumber->type }}</div>
                      <input class="d-none" name="phoneTypes[]" value="{{ $phoneNumber->type }}" />
                      <div class="col-6 text-center phoneNumber">{{ $phoneNumber->number }}</div>
                      <input class="d-none" name="phoneNumbers[]" value="{{ $phoneNumber->number }}" />
                      <div class="col-2 text-center phoneExtension">{{ $phoneNumber->extension ? : 'N/A' }}</div>
                      <input class="d-none" name="phoneExtensions[]" value="{{ $phoneNumber->number }}" />
                      <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-x col-2 removePhone d-none" viewBox="0 0 16 16" style="cursor:pointer;">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                      </svg>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
          @role(['responsable', 'admin'])
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
              <button id="btnEditContactDetails" type="button" class="m-2 py-1 px-3 rounded button-darkblue edit">{{__('global.edit')}}</button>
              <button id="btnSaveContactDetails" type="button" class="m-2 py-1 px-3 rounded button-darkblue d-none save">{{__('global.save')}}</button>
            </div>
          </div>
          @endrole
        </div>
      </div><!--FIN COORDONNÉES-->
      <!--CONTACT-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="contacts-section">
        <form action="{{ route('suppliers.updateContacts', ['supplier'=>$supplier]) }}" method="post" class="need-validation w-100" onkeydown="return event.key != 'Enter';" enctype="multipart/form-data">
          @csrf
          <div class=" bg-white rounded my-2 form-section w-100">
            <div class="row">
              <div class="col-8 col-md-10 offset-2 offset-md-1 text-center">
                <h1 class="section-title">{{__('form.contactsTitle')}}</h1>
              </div>
              <div class="col-2 col-md-1 d-flex align-items-center justify-content-center d-none">
                <button type="button" class="add-contact p-0">
                  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                  </svg>
                </button>
              </div>
            </div>
            <div id="contactsRow" class="row justify-content-center px-3">
                @foreach ($supplier->contacts as $contact)
                <div class="col-12 col-lg-6 d-flex flex-column justify-content-between mb-2 contactCard">
                  <div class="rounded px-3 pt-2 border">
                    <div class="row">
                      <h2 class="col-11 text-start section-subtitle">{{__('form.contactsSubtitle')}}</h2>
                      <button type="button" class="col-1 text-end delete-contact p-0 d-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                        </svg>
                      </button>
                    </div>
                    <div class="row">
                      <div class="col-12 col-lg-6 text-center mb-4">
                        <div class="form-floating">
                          <input type="number" name="contactIds[]" id="{{"contactId" . ($loop->index+1)}}" value="{{ $contact->id}}" hidden>
                          <input type="text" name="contactFirstNames[]" id="{{"contactFirstName" . ($loop->index+1)}}" class="form-control contact-input contact-name-input" placeholder="" maxlength="32" value="{{ $contact->first_name}}" disabled>
                          <label id="{{"contactFirstNameLabel" . ($loop->index+1)}}" for="{{"contactFirstName" . ($loop->index+1)}}">{{__('form.firstNameLabel')}}</label>
                          <div class="text-start invalid-feedback nameInvalidRequired" style="display: none;">{{__('form.contactsFirstNamesValidationRequired')}}</div>
                          <div class="text-start invalid-feedback nameInvalidSymbols" style="display: none;">{{__('form.contactsNamesValidationSymbols')}}</div>
                        </div>
                      </div>
                      <div class="col-12 col-lg-6 text-center mb-4">
                        <div class="form-floating">
                          <input type="text" name="contactLastNames[]" id="{{"contactLastName" . ($loop->index+1)}}" class="form-control contact-input contact-name-input" placeholder="" maxlength="32" value="{{ $contact->last_name }}" disabled>
                          <label id="{{"contactLastNameLabel" . ($loop->index+1)}}" for="{{"contactLastName" . ($loop->index+1)}}">{{__('form.lastNameLabel')}}</label>
                          <div class="text-start invalid-feedback nameInvalidRequired" style="display: none;">{{__('form.contactsLastNamesValidationRequired')}}</div>
                          <div class="text-start invalid-feedback nameInvalidSymbols" style="display: none;">{{__('form.contactsNamesValidationSymbols')}}</div>
                        </div>
                      </div>
                    </div>
                    <div class="text-center mb-4">
                      <div class="form-floating">
                        <input type="text" name="contactJobs[]" id="{{"contactJob" . ($loop->index+1)}}" class="form-control contact-input contact-job-input" placeholder="" maxlength="32" value="{{ $contact->job }}" disabled>
                        <label id="{{"contactJobLabel" . ($loop->index+1)}}" for="{{"contactJob" . ($loop->index+1)}}">{{__('form.jobLabel')}}</label>
                        <div class="text-start valid-feedback jobValid" style="display: none;"></br></div>
                        <div class="text-start invalid-feedback jobInvalidRequired" style="display: none;">{{__('form.contactsJobsValidationRequired')}}</div>
                      </div>
                    </div>
                    <div class="text-center mb-4">
                      <div class="form-floating">
                        <input type="text" name="contactEmails[]" id="{{"contactEmail" . ($loop->index+1)}}" class="form-control contact-input contact-email-input" placeholder="" maxlength="64" value="{{ $contact->email }}" disabled>
                        <label id="{{"contactEmailLabel" . ($loop->index+1)}}" for="{{"contactEmail" . ($loop->index+1)}}">{{__('form.emailLabel')}}</label>
                        <div class="text-start invalid-feedback emailInvalidRequired" style="display: none;">{{__('form.contactsEmailsValidationRequired')}}</div>
                        <div class="text-start invalid-feedback emailInvalidFormat" style="display: none;">{{__('form.contactsEmailsValidationFormat')}}</div>
                      </div>
                    </div>

                    <h2 class="text-center section-subtitle">{{__('form.phoneNumber')}}</h2>
                    
                    <div class="d-flex flex-column mb-4 phone-container">
                      <div class="text-center d-flex flex-column flex-md-row flew-mb-wrap">
                        <div class="form-floating col-12 col-md-3">
                          <input type="number" name="contactTelIdsA[]" id="{{"contactTelIdA" . ($loop->index+1)}}" value="{{ $contact->phoneNumbers[0]->id}}" hidden>
                          <select name="contactTelTypesA[]" id="{{"contactTelTypeA" . ($loop->index+1)}}" class="form-select" aria-label="" disabled>
                            <option value="{{__('form.officeNumber')}}" {{ __('form.officeNumber') == $contact->formattedPhoneNumbers[0]->type ? 'selected' : null }}>{{__('form.officeNumber')}}</option>
                            <option value="{{__('form.fax')}}" {{ __('form.fax') == $contact->formattedPhoneNumbers[0]->type ? 'selected' : null }}>{{__('form.fax')}}</option>
                            <option value="{{__('form.cellphone')}}" {{ __('form.cellphone') == $contact->formattedPhoneNumbers[0]->type ? 'selected' : null }}>{{__('form.cellphone')}}</option>
                          </select>
                          <label id="{{"contactTelTypeLabelA" . ($loop->index+1)}}" for="{{"contactTelTypeA" . ($loop->index+1)}}">{{__('form.typeLabel')}}</label>
                        </div>
                        <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                          <input type="text" name="contactTelNumbersA[]" id="{{"contactTelNumberA" . ($loop->index+1)}}" class="form-control contact-input contact-primary-phone-input" placeholder="" maxlength="12" value="{{ $contact->formattedPhoneNumbers[0]->number }}" disabled>
                          <label id="{{"contactTelNumberLabelA" . ($loop->index+1)}}" class="my-4 my-md-0 ms-md-2" for="{{"contactTelNumberA" . ($loop->index+1)}}">{{__('form.numberLabel')}}</label>
                        </div>
                        <div class="form-floating col-12 col-md-3">
                          <input type="text" name="contactTelExtensionsA[]" id="{{"contactTelExtensionA" . ($loop->index+1)}}" class="form-control contact-input contact-extension-input" placeholder="" maxlength="6" value="{{ $contact->formattedPhoneNumbers[0]->extension ? : 'N/A' }}" disabled>
                          <label id="{{"contactTelExtensionLabelA" . ($loop->index+1)}}" for="{{"contactTelExtensionA" . ($loop->index+1)}}">{{__('form.phoneExtension')}}</label>
                        </div>
                      </div>
                      <div class="text-start invalid-feedback phoneInvalidRequired" style="display: none;">{{__('form.contactsTelNumberValidationRequired')}}</div>
                      <div class="text-start invalid-feedback phoneInvalidNumber" style="display: none;">{{__('form.contactsTelNumberValidation')}}</div>
                      <div class="text-start invalid-feedback phoneInvalidSize" style="display: none;">{{__('form.contactsTelNumberValidationSize')}}</div>
                      <div class="text-start invalid-feedback phoneInvalidExtension" style="display: none;">{{__('form.contactsTelExtensionValidation')}}</div>
                    </div>
                    @if(Count($contact->formattedPhoneNumbers) == 2)
                      <h2 class="text-center section-subtitle d-md-none">{{__('form.phoneNumber')}}</h2>
                      <div class="d-flex flex-column mb-4 phone-container">
                        <div class="text-center d-flex flex-column flex-md-row">
                          <div class="form-floating col-12 col-md-3">
                            <input type="number" name="contactTelIdsB[]" id="{{"contactTelIdB" . ($loop->index+1)}}" value="{{ $contact->phoneNumbers[1]->id}}" hidden>
                            <select name="contactTelTypesB[]" id="{{"contactTelTypeB" . ($loop->index+1)}}" class="form-select" aria-label="" disabled>
                              <option value="{{__('form.officeNumber')}}" {{ __('form.officeNumber') == $contact->formattedPhoneNumbers[1]->type ? 'selected' : null }}>{{__('form.officeNumber')}}</option>
                              <option value="{{__('form.fax')}}" {{ __('form.fax') == $contact->formattedPhoneNumbers[1]->type ? 'selected' : null }}>{{__('form.fax')}}</option>
                              <option value="{{__('form.cellphone')}}" {{ __('form.cellphone') == $contact->formattedPhoneNumbers[1]->type ? 'selected' : null }}>{{__('form.cellphone')}}</option>
                            </select>
                            <label id="{{"contactTelTypeLabelB" . ($loop->index+1)}}" for="{{"contactTelTypeB" . ($loop->index+1)}}">{{__('form.typeLabel')}}</label>
                          </div>
                          <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                            <input type="text" name="contactTelNumbersB[]" id="{{"contactTelNumberB" . ($loop->index+1)}}" class="form-control contact-input contact-secondary-phone-input" placeholder="" maxlength="12" value="{{ $contact->formattedPhoneNumbers[1]->number ? : 'N/A' }}" disabled>
                            <label id="{{"contactTelNumberLabelB" . ($loop->index+1)}}" class="my-4 my-md-0 ms-md-2" for="{{"contactTelNumberB" . ($loop->index+1)}}">{{__('form.numberLabel')}}</label>
                          </div>
                          <div class="form-floating col-12 col-md-3">
                            <input type="text" name="contactTelExtensionsB[]" id="{{"contactTelExtensionB" . ($loop->index+1)}}" class="form-control contact-input contact-extension-input" placeholder="" maxlength="6" value="{{ $contact->formattedPhoneNumbers[1]->extension ? : 'N/A' }}" disabled>
                            <label id="{{"contactTelExtensionLabelB" . ($loop->index+1)}}" for="{{"contactTelExtensionB" . ($loop->index+1)}}">{{__('form.phoneExtension')}}</label>
                          </div>
                        </div>
                        <div class="text-start invalid-feedback phoneInvalidRequired" style="display: none;">{{__('form.contactsTelNumberValidationRequired')}}</div>
                        <div class="text-start invalid-feedback phoneInvalidNumber" style="display: none;">{{__('form.contactsTelNumberValidation')}}</div>
                        <div class="text-start invalid-feedback phoneInvalidSize" style="display: none;">{{__('form.contactsTelNumberValidationSize')}}</div>
                        <div class="text-start invalid-feedback phoneInvalidExtension" style="display: none;">{{__('form.contactsTelExtensionValidation')}}</div>
                      </div>
                    @else
                      <h2 class="text-center section-subtitle d-md-none">{{__('form.phoneNumber')}}</h2>
                      <div class="d-flex flex-column mb-4 phone-container">
                        <div class="text-center d-flex flex-column flex-md-row">
                          <div class="form-floating col-12 col-md-3">
                            <input type="number" name="contactTelIdsB[]" id="{{"contactTelIdB" . ($loop->index+1)}}" value="-1" hidden>
                            <select name="contactTelTypesB[]" id="{{"contactTelTypeB" . ($loop->index+1)}}" class="form-select" aria-label="" disabled>
                              <option value="{{__('form.officeNumber')}}">{{__('form.officeNumber')}}</option>
                              <option value="{{__('form.fax')}}">{{__('form.fax')}}</option>
                              <option value="{{__('form.cellphone')}}">{{__('form.cellphone')}}</option>
                            </select>
                            <label id="{{"contactTelTypeLabelB" . ($loop->index+1)}}" for="{{"contactTelTypeB" . ($loop->index+1)}}">{{__('form.typeLabel')}}</label>
                          </div>
                          <div class="form-floating col-12 col-md-6 px-md-2 py-4 py-md-0">
                            <input type="text" name="contactTelNumbersB[]" id="{{"contactTelNumberB" . ($loop->index+1)}}" class="form-control contact-input contact-secondary-phone-input" placeholder="" maxlength="12" value="N/A" disabled>
                            <label id="{{"contactTelNumberLabelB" . ($loop->index+1)}}" class="my-4 my-md-0 ms-md-2" for="{{"contactTelNumberB" . ($loop->index+1)}}">{{__('form.numberLabel')}}</label>
                          </div>
                          <div class="form-floating col-12 col-md-3">
                            <input type="text" name="contactTelExtensionsB[]" id="{{"contactTelExtensionB" . ($loop->index+1)}}" class="form-control contact-input contact-extension-input" placeholder="" maxlength="6" value="N/A" disabled>
                            <label id="{{"contactTelExtensionLabelB" . ($loop->index+1)}}" for="{{"contactTelExtensionB" . ($loop->index+1)}}">{{__('form.phoneExtension')}}</label>
                          </div>
                        </div>
                        <div class="text-start invalid-feedback phoneInvalidRequired" style="display: none;">{{__('form.contactsTelNumberValidationRequired')}}</div>
                        <div class="text-start invalid-feedback phoneInvalidNumber" style="display: none;">{{__('form.contactsTelNumberValidation')}}</div>
                        <div class="text-start invalid-feedback phoneInvalidSize" style="display: none;">{{__('form.contactsTelNumberValidationSize')}}</div>
                        <div class="text-start invalid-feedback phoneInvalidExtension" style="display: none;">{{__('form.contactsTelExtensionValidation')}}</div>
                      </div>
                    @endif
                  </div>
                </div>
                @endforeach
            </div>
            @role(['responsable', 'admin'])
            <div class="row">
              <div class="col-12 d-flex justify-content-center mb-3">
                @php
                  $refreshCount = request('refresh') ? request('refresh') + 1 : 1;
                @endphp
                <a id="btnCancelContacts" href="{{ route('suppliers.show', [$supplier, 'refresh' => $refreshCount]) }}#contacts-section" class="m-2 py-1 px-3 rounded previous-button d-none">{{__('global.cancel')}}</a>
                <button id="btnEditContacts" type="button" class="m-2 py-1 px-3 rounded button-darkblue button-darkblue edit">{{__('global.edit')}}</button>
                <button id="btnSaveContacts" type="submit" class="m-2 py-1 px-3 rounded button-darkblue d-none save">{{__('global.save')}}</button>
              </div>
            </div>
            @endrole
          </div>
        </form>
      </div> <!--FIN CONTACT-->
      <!--PRODUITS ET SERVICES-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="productsServices-section">
        <div class=" bg-white rounded my-2 w-100 form-section">
          <div class="row">
            <div class="col-12 text-center">
              <h1 class="section-title">{{__('form.productsAndServiceTitle')}}</h1>
            </div>
          </div>
          <div class="flex-row d-flex justify-content-center px-3">
            <div class="col-12 col-md-4 d-flex flex-column justify-content-between d-none">
              <h2 class="text-center section-subtitle">{{__('form.productsAndServiceServices')}}</h2>
              <div class="text-center">
                <div class="form-floating mb-3">
                  <input type="text" id="service-search" class="form-control" placeholder="">
                  <label for="service-search">{{__('form.productsAndServiceCategoriesSearch')}}</label>
                </div>
              </div>
              <div>
                <div class="form-floating">
                  <div class="form-control" placeholder="details" id="products-categories" style="height: 232px; overflow-x: hidden; overflow-y: auto;">
                    <div class="mt-lg-0 mt-md-4" id="service-list">
                    </div>
                  </div>
                  <label for="products-categories" class="labelbackground">{{__('form.productsAndServiceServicesCategorySelection')}}</label>
                  <div class="note" id="results-count"><br></div>
                </div>
              </div>
            </div>
            <div class="col-6 me-2">
              <h2 class="text-center section-subtitle">{{__('form.productsAndServiceSelectedServicesList')}}</h2>
              <div>
                <div class="form-floating">
                  <div class="form-control" placeholder="selected" id="products-selected" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
                    <div class="mt-lg-0 mt-md-4" id="service-selected">
                      @foreach ($suppliersGroupedByNatureAndCategory as $nature => $categories)
                      <div class="row pb-3">
                        <h6 class="mb-3 fw-bold">{{ $nature }}</h6>
                        @foreach ($categories as $categoryCode => $categoryData)
                        <div class="row">
                          <h6 class="fst-italic"> {{ $categoryCode }} - {{ $categoryData['category_name'] }}</h6>
                          @foreach ($categoryData['products'] as $product)
                          <div class="col-3 pb-1">
                            {{ $product->code }}
                          </div>
                          <div class="col-9 pb-1">
                            {{ $product->description }}
                          </div>
                          @endforeach
                        </div>
                        @endforeach
                      </div>
                      @endforeach
                    </div>
                  </div>
                  <!-- <label for="products-selected" class="labelbackground">{{__('form.productsAndServiceServicesCategorySelected')}}</label> -->
                  <div class="note"><br></div>
                </div>
              </div>
            </div>
            <div class="col-6">
              <h2 class="text-center section-subtitle">{{__('form.productsAndServiceCategoriesDetails')}}</h2>
              <div class="text-center">
                <div class="form-floating">
                  <textarea class="form-control" name="product_service_detail" placeholder="details" id="products-details" style="height: 308px; resize: none;" maxlength="500" disabled>{{ $supplier->product_service_detail }}</textarea>
                  <!-- <label for="products-details" class="labelbackground"></label> -->
                  <div class="note"><br></div>
                </div>
              </div>
            </div>
          </div>
          @role(['responsable', 'admin'])
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
              <button id="btnEditProductsServices" type="button" class="m-2 py-1 px-3 rounded button-darkblue edit">{{__('global.edit')}}</button>
              <button id="btnSaveProductsServices" type="button" class="m-2 py-1 px-3 rounded button-darkblue d-none save">{{__('global.save')}}</button>
            </div>
          </div>
          @endrole
        </div>
      </div><!--FIN PRODUITS ET SERVICES-->
      <!--LICENCE RBQ-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="licence-section">
        <form action="{{ route('suppliers.updateRbq', ['supplier'=>$supplier]) }}" method="post" class="need-validation" onkeydown="return event.key != 'Enter';" enctype="multipart/form-data">
          @csrf
          <div class=" bg-white rounded my-2 w-100 form-section">
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
                      <input
                        type="text"
                        name="licenceRbq"
                        id="licenceRbq"
                        value="{{$supplier->rbqLicence && $supplier->rbqLicence->number ? $supplier->rbqLicence->number : '' }}"
                        class="form-control"
                        placeholder=""
                        maxlength="10"
                        disabled>
                      <label for="licenceRbq">{{__('form.numberLabel')}}</label>
                      <div class="text-start invalid-feedback licenceInvalidNumber" style="display: none;">{{__('form.rbqLicenceValidation')}}</div>
                      <div class="text-start invalid-feedback licenceInvalidSize" style="display: none;">{{__('form.rbqLicenceValidationSize')}}</div>
                    </div>
                  </div>
                  <div class="text-center">
                    <div class="form-floating mb-3">
                      <select name="statusRbq" id="statusRbq" class="form-select" aria-label="" disabled>
                        <option disabled selected value>{{__('form.choiceDefaultType')}}</option>
                        <option value>{{__('global.none')}}</option>
                        <option value="valid" {{ $supplier->rbqLicence && $supplier->rbqLicence->status == 'valid' ? 'selected' : null }}>{{ __('form.choiceValid') }}</option>
                        <option value="restrictedValid" {{ $supplier->rbqLicence && $supplier->rbqLicence->status == 'restrictedValid'  ? 'selected' : null }}>{{__('form.choiceRestrictedValid')}}</option>
                        <option value="invalid" {{  $supplier->rbqLicence && $supplier->rbqLicence->status == "invalid"  ? 'selected' : null }}>{{__('form.choiceInvalid')}}</option>
                      </select>
                      <label for="statusRbq">{{__('form.statusLabel')}}</label>
                      <div class="text-start invalid-feedback statusInvalidRequired" style="display: none;">{{__('form.rbqStatusValidationRequired')}}</div>
                      <div class="text-start invalid-feedback statusInvalidRequiredNot" style="display: none;">{{__('form.rbqStatusValidationRequiredNot')}}</div>
                    </div>
                  </div>
                  <div class="text-center">
                    <div class="form-floating mb-3">
                      <select name="typeRbq" id="typeRbq" class="form-select" aria-label="" disabled>
                        <option disabled selected value>{{__('form.choiceDefaultType')}}</option>
                        <option value>{{__('global.none')}}</option>
                        <option value="entrepreneur" {{ $supplier->rbqLicence && $supplier->rbqLicence->type == 'entrepreneur' ? 'selected' : null }}>{{__('form.choiceEntrepreneur')}}</option>
                        <option value="ownerBuilder" {{ $supplier->rbqLicence && $supplier->rbqLicence->type == 'ownerBuilder' ? 'selected' : null }}>{{__('form.choiceOwnerBuilder')}}</option>
                      </select>
                      <label for="typeRbq">{{__('form.typeLabel')}}</label>
                      <div class="text-start invalid-feedback typeInvalidRequired" style="display: none;">{{__('form.rbqTypeValidationRequired')}}</div>
                      <div class="text-start invalid-feedback typeInvalidRequiredNot" style="display: none;">{{__('form.rbqTypeValidationRequiredNot')}}</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-8 d-flex flex-column justify-content-start">
                <h2 class="text-center">{{__('form.rbqCategoriesSection')}}</h2>
                <div class="text-center">
                  <div class="form-floating mb-3">
                    <div id="subcategories-container" class="form-control pt-2" style="height: 308px; overflow-x: hidden; overflow-y: auto;">
                      @php
                        if(!is_null($supplier->workSubcategories)){
                          $supplierWorkSubcategories = $supplier->workSubcategories->pluck('code')->toArray();
                        }

                        $entrepreneurLicence = false;
                        if(!is_null($supplier->rbqLicence) && $supplier->rbqLicence->type == "entrepreneur")
                          $entrepreneurLicence = true;

                        $generalWork = false;
                        $specialisedWork = false;
                        foreach ($supplier->workSubcategories as $workSubcategory) {
                          if($workSubcategory->is_specialised)
                            $specialisedWork = true;
                          else
                            $generalWork = true;
                        }
                      @endphp
                      <div id="no-categories" class="{{!is_null($supplier->rbqLicence) ? 'd-none' : 'd-block'}}">
                        {{__('form.rbqNoLicence')}}
                      </div>
                      <div id="entrepreneur-categories" class="{{$entrepreneurLicence && !is_null($supplier->rbqLicence) ?  : 'd-none' }}">
                        <div class="fs-5 text-start fw-bold mb-2 title-border subcategory-title {{$generalWork ?  : 'd-none'}}">{{__('form.rbqCategoriesGeneralEntrepreneur')}}</div>
                        @foreach($workSubcategories as $workSubcategory)
                          @if($workSubcategory->is_specialised == false)
                            @php
                              $checked = false;
                              if(!is_null($supplier->workSubcategories))
                                if(in_array($workSubcategory->code, $supplierWorkSubcategories))
                                  $checked = true;
                            @endphp
                            <div class="form-check pb-2 {{$checked ? '' : 'd-none'}}">
                              <input
                                class="form-check-input mt-0 rbq-subcategories-check"
                                type="checkbox"
                                name="rbqSubcategories[]"
                                value="{{$workSubcategory->code}}"
                                id="flexCheckGen{{$workSubcategory->id}}Ent"
                                {{$checked && $supplier->rbqLicence->type == "entrepreneur" ? 'checked' : ''}}
                                disabled
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
                        
                        <div class="fs-5 text-start fw-bold mb-2 title-border subcategory-title {{$specialisedWork ?  : 'd-none'}}">{{__('form.rbqCategoriesSpecialisedEntrepreneur')}}</div>
                        @foreach($workSubcategories as $workSubcategory)
                          @if($workSubcategory->is_specialised == true)
                            @php
                              $checked = false;
                              if(!is_null($supplier->workSubcategories))
                                if(in_array($workSubcategory->code, $supplierWorkSubcategories))
                                  $checked = true;
                            @endphp
                            <div class="form-check pb-2 {{$checked ? '' : 'd-none'}}">
                              <input
                                class="form-check-input mt-0 rbq-subcategories-check"
                                type="checkbox"
                                name="rbqSubcategories[]"
                                value="{{$workSubcategory->code}}"
                                id="flexCheckGen{{$workSubcategory->id}}Ent"
                                {{$checked && $supplier->rbqLicence->type == "entrepreneur" ? 'checked' : ''}}
                                disabled
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
                      </div>
                      <div id="ownerBuilder-categories" class="{{!($entrepreneurLicence) && !is_null($supplier->rbqLicence) ? '' : 'd-none' }}">
                        <div class="fs-5 text-start fw-bold mb-2 title-border subcategory-title {{$generalWork ?  : 'd-none'}}">{{__('form.rbqCategoriesGeneralOwnerBuilder')}}</div>
                        @foreach($workSubcategories as $workSubcategory)
                          @if($workSubcategory->is_specialised == false && $workSubcategory->is_entrepreneur_only == false)
                            @php
                              $checked = false;
                              if(!is_null($supplier->workSubcategories))
                                if(in_array($workSubcategory->code, $supplierWorkSubcategories))
                                  $checked = true;
                            @endphp
                            <div class="form-check pb-2 {{$checked ? '' : 'd-none'}}">
                              <input
                                class="form-check-input mt-0 rbq-subcategories-check"
                                type="checkbox"
                                name="rbqSubcategories[]"
                                value="{{$workSubcategory->code}}"
                                id="flexCheckGen{{$workSubcategory->id}}Ent"
                                {{$checked && $supplier->rbqLicence->type == "ownerBuilder" ? 'checked' : ''}}
                                disabled
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
                        
                        <div class="fs-5 text-start fw-bold mb-2 title-border subcategory-title {{$specialisedWork ?  : 'd-none'}}">{{__('form.rbqCategoriesSpecialisedOwnerBuilder')}}</div>
                        @foreach($workSubcategories as $workSubcategory)
                          @if($workSubcategory->is_specialised == true && $workSubcategory->is_entrepreneur_only == false)
                            @php
                              $checked = false;
                              if(!is_null($supplier->workSubcategories))
                                if(in_array($workSubcategory->code, $supplierWorkSubcategories))
                                  $checked = true;
                            @endphp
                            <div class="form-check pb-2 {{$checked ? '' : 'd-none'}}">
                              <input
                                class="form-check-input mt-0 rbq-subcategories-check"
                                type="checkbox"
                                name="rbqSubcategories[]"
                                value="{{$workSubcategory->code}}"
                                id="flexCheckGen{{$workSubcategory->id}}Ent"
                                {{$checked && $supplier->rbqLicence->type == "ownerBuilder" ? 'checked' : ''}}
                                disabled
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
                      </div>
                    </div>
                    <div class="text-start invalid-feedback subcategorieInvalidRequired" style="display: none;">{{__('form.rbqSubcategorieValidationRequired')}}</div>
                    <div class="text-start invalid-feedback subcategorieInvalidRequiredNot" style="display: none;">{{__('form.rbqSubcategorieValidationRequiredNot')}}</div>
                  </div>
                </div>
              </div>
            </div>
            @role(['responsable', 'admin'])
            <div class="row">
              <div class="col-12 d-flex justify-content-center mb-2">
                @php
                  $refreshCount = request('refresh') ? request('refresh') + 1 : 1;
                @endphp
                <a id="btnCancelRbq" href="{{ route('suppliers.show', [$supplier, 'refresh' => $refreshCount]) }}#licence-section" class="m-2 py-1 px-3 rounded previous-button d-none">{{__('global.cancel')}}</a>
                <button id="btnEditRbq" type="button" class="m-2 py-1 px-3 rounded  button-darkblue edit">{{__('global.edit')}}</button>
                <button id="btnSaveRbq" type="submit" class="m-2 py-1 px-3 rounded button-darkblue d-none save">{{__('global.save')}}</button>
              </div>
            </div>
            @endrole
          </div>
        </form>
      </div><!--FIN LICENCE RBQ-->
      <!--PIÈCES JOINTES-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="attachments-section">
        <div class=" bg-white rounded my-2 form-section">
          <div class="row">
            <div class="col-12 text-center">
              <h1>{{__('form.attachmentFilesTitle')}}</h1>
            </div>
          </div>
          <div class="row px-3 mb-3">
            <div class="col-12 d-flex flex-column justify-content-between mb-3">
              <h2 class="text-center section-subtitle">{{__('form.attachmentFilesSection')}}</h2>
            </div>
            <div class=" col-12 d-flex flex-column justify-content-between">
              <div class="row flex-row justify-content-between d-none">
                <div class="col-10">
                  <div>
                    <input class="form-control" type="file" id="formFile" disabled>
                  </div>
                  <div class="text-start invalid-feedback attachment" id="attachmentFileRequired" style="display: none;">{{__('form.attachmentFileRequired')}}</div>
                  <div class="text-start invalid-feedback attachment" id="attachmentFileNameLength" style="display: none;">{{__('form.attachmentFileNameLength')}}</div>
                  <div class="text-start invalid-feedback attachment" id="attachmentFileNameAlphaNum" style="display: none;">{{__('form.attachmentFileNameAlphaNum')}}</div>
                  <div class="text-start invalid-feedback attachment" id="attachmentFileFormat" style="display: none;">{{__('form.attachmentFileFormat')}}</div>
                  <div class="text-start invalid-feedback attachment" id="attachmentSameFileName" style="display: none;">{{__('form.attachmentSameFileName')}}</div>
                  <div class="text-start invalid-feedback attachment" id="attachmentFilesExceedSize" style="display: none;">{{__('form.attachmentFilesExceedSize')}}</div>
                </div>
                <div class="col-2 text-center pt-1">
                  <svg id="add-file" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus-circle-fill" width="30" height="30" viewBox="0 0 16 16" style="cursor: pointer;">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z" />
                  </svg>
                </div>
              </div>
              <table class="table d-none">
                <tbody>
                  <tr>
                    <td class="fw-bold">{{__('form.attachmentFileName')}}</td>
                    <td class="text-center" id="fileName"></td>
                  </tr>
                  <tr>
                    <td class="fw-bold">{{__('form.attachmentFileSize')}}</td>
                    <td class="text-center" id="fileSize"></td>
                  </tr>
                  <tr>
                    <td class="fw-bold">{{__('form.attachmentAddedFileDate')}}</td>
                    <td class="text-center" id="addedFileDate"></td>
                  </tr>
                  <tr class="d-none">
                    <td class="text-center" id="valueInput"></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-12">
              <div class="form-floating h-100" id="div-attachmentFilesList">
                <div class="form-control pt-2 h-100" id="attachmentList" style="overflow-x: hidden; overflow-y: auto; min-height:150px;">
                  <div class="fs-5 text-start title-border fw-bold" for="attachmentList">{{__('form.attachmentFilesList')}}</div>
                  <div class="row px-3">
                    @if($supplier->attachments->isEmpty())
                    <div>{{__('form.noAttachmentFiles')}}</div>
                    @else
                    <div class="d-flex justify-content-between mt-2">
                      <div class="col-6 fs-6 fst-italic">{{__('form.attachmentFileName')}}</div>
                      <div class="col-2 fs-6 text-center fst-italic">{{__('form.attachmentFileSize')}}</div>
                      <div class="col-2 fs-6 text-center fst-italic">{{__('form.attachmentAddedFileDate')}}</div>
                      <div class="col-2 "></div>
                    </div>
                    <div class="d-flex flex-column justify-content-between" id="attachmentFilesList">
                      @foreach ($supplier->attachments as $file)
                      <div class="row mb-2 ">
                        <div class="col-6 fs-6 fileName">
                          <a href="{{ route('attachments.show', ['supplier' => $supplier->id, 'attachment' => $file->id]) }}" target="_blank">{{ $file->name }}</a>
                        </div>
                        <div class="col-2 fs-6 text-center fileSize">
                          {{$file->size}}
                        </div>
                        <div class="col-2 fs-6 text-center addedFileDate">
                          {{$file->deposit_date}}
                        </div>
                      </div>
                      @endforeach
                    </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="text-end inline-block d-none">
              <p class="mb-0" id="totalSize">/75Mo</p>
            </div>
            @if(!is_null(old('fileNames')))
            @foreach(old('fileNames') as $fileName)
            <div hidden>
              {{$fileNameIndex = "phoneTypes." . "$loop->index"}}
              {{$fileSizeIndex = "fileSizes." . "$loop->index"}}
              {{$fileTypeIndex = "fileTypes." . "$loop->index"}}
              {{$addedFileDateIndex = "addedFileDates." . "$loop->index"}}
            </div>
            @if($errors->has($fileNameIndex))
            <p class="m-0">{{ $errors->first($fileNameIndex) }}</p>
            @endif
            @if($errors->has($fileSizeIndex))
            <p class="m-0">{{ $errors->first($fileSizeIndex) }}</p>
            @endif
            @if($errors->has($fileTypeIndex))
            <p class="m-0">{{ $errors->first($fileTypeIndex) }}</p>
            @endif
            @if($errors->has($addedFileDateIndex))
            <p class="m-0">{{ $errors->first($addedFileDateIndex) }}</p>
            @endif
            @endforeach
            @endif
          </div>
          @role(['responsable', 'admin'])
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
              <button id="btnEditAttachmentFiles" type="button" class="m-2 py-1 px-3 rounded button-darkblue edit">{{__('global.edit')}}</button>
              <button id="btnSaveAttachmentFiles" type="submit" class="m-2 py-1 px-3 rounded button-darkblue d-none save">{{__('global.save')}}</button>
            </div>
          </div>
          @endrole
        </div>
      </div><!--FIN PIÈCES JOINTES-->
      <!--FINANCES-->
      <div class="container h-100 w-100 d-flex align-items-center justify-content-center show-section d-none" id="finances-section">
        <div class="bg-white rounded my-2 form-section w-65">
          <div class="row">
            <div class="col-12 text-center">
              <h1>{{__('form.financesTitle')}}</h1>
            </div>
          </div>
          <div class="row px-3 mb-3">
            <div class="col-12 text-center pb-3">
              <div class="form-floating pe-2">
                <input type="text" name="financesTps" id="financesTps" class="form-control" value="{{$supplier->tps_number ?? __('form.noTpsNumber') }}" placeholder="" maxlength="8" disabled>
                <label for="financesTps" id="">{{__('form.tpsNumber')}}</label>
              </div>
            </div>
            <div class="col-12 text-center pb-3">
              <div class="form-floating pe-2">
                <input type="text" name="financesTvq" id="financesTvq" class="form-control" value="{{$supplier->tvq_number ?? __('form.noTvqNumber') }}" placeholder="" maxlength="8" disabled>
                <label for="financesTvq" id="">{{__('form.tvqNumber')}}</label>
              </div>
            </div>
            <div class="col-12 text-center pb-3">
              <div class="form-floating pe-2">
                <!-- J'ai transcrit tel quel les choix dans le devis 
                    Si autre idée pour le nom des variables..
                 -->
                <select name="financesPaymentConditions" id="financesPaymentConditions" class="form-select" aria-label="" disabled>
                  <option selected>{{__('form.paymentConditionsDefault')}}</option>
                  <option value="nowPaymentNoDeduction" {{$supplier->payment_condition == 'nowPaymentNoDeduction' ? 'selected' : null  }}>{{__('form.nowPaymentNoDeduction')}}</option>
                  <option value="nowPaymentNoDeduction15th" {{$supplier->payment_condition == 'nowPaymentNoDeduction15th' ? 'selected' : null  }}>{{__('form.nowPaymentNoDeduction15th')}}</option>
                  <option value="15days2" {{$supplier->payment_condition == '15days2' ? 'selected' : null  }}>{{__('form.15days2')}}</option>
                  <option value="until15th" {{$supplier->payment_condition == 'until15th' ? 'selected' : null  }}>{{__('form.until15th')}}</option>
                  <option value="10days2" {{$supplier->payment_condition == '10days2' ? 'selected' : null  }}>{{__('form.10days2')}}</option>
                  <option value="15daysNoDeduction" {{$supplier->payment_condition == '15daysNoDeduction' ? 'selected' : null  }}>{{__('form.15daysNoDeduction')}}</option>
                  <option value="30daysNoDeduction" {{$supplier->payment_condition == '30daysNoDeduction' ? 'selected' : null  }}>{{__('form.30daysNoDeduction')}}</option>
                  <option value="45daysNoDeduction" {{$supplier->payment_condition == '45daysNoDeduction' ? 'selected' : null  }}>{{__('form.45daysNoDeduction')}}</option>
                  <option value="60daysNoDeduction" {{$supplier->payment_condition == '60daysNoDeduction' ? 'selected' : null  }}>{{__('form.60daysNoDeduction')}}</option>
                </select>
                <label for="financesPaymentConditions" id="">{{__('form.paymentConditions')}}</label>
              </div>
            </div>
            <div class="row pb-3">
              <div class="col-6">
                <div class="w-100">
                  <h5 class="text-decoration-underline">{{__('form.currency')}}</h5>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" {{$supplier->currency == '1' ? 'checked' : null}} name="flexRadioCAD" id="flexRadioCAD" disabled>
                    <label class="form-check-label" for="flexRadioCAD">{{__('form.canadianCurrency')}}</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="2" {{$supplier->currency == '2' ? 'checked' : null}} name="flexRadioUS" id="flexRadioUS" disabled>
                    <label class="form-check-label" for="flexRadioUS">{{__('form.usCurrency')}}</label>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="w-100">
                  <h5 class="text-decoration-underline">{{__('form.communication')}}</h5>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" {{$supplier->communication_mode == '1' ? 'checked' : null}} name="flexRadioEmail" id="flexRadioEmail" disabled>
                    <label class="form-check-label" for="flexRadioEmail">{{__('form.email')}}</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="2" {{$supplier->communication_mode == '2' ? 'checked' : null}} name="flexRadioMail" id="flexRadioMail" disabled>
                    <label class="form-check-label" for="flexRadioMail">{{__('form.mail')}}</label>
                  </div>
                </div>
              </div>
            </div>
            @role(['responsable', 'admin'])
            <div class="row">
              <div class="col-12 d-flex justify-content-center mb-2">
                <button id="btnEditFinances" type="button" class="m-2 py-1 px-3 rounded button-darkblue edit">{{__('global.edit')}}</button>
                <button id="btnSaveFinances" type="submit" class="m-2 py-1 px-3 rounded button-darkblue d-none save">{{__('global.save')}}</button>
              </div>
            </div>
            @endrole
          </div>
        </div>
      </div><!--FIN FINANCES-->
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  const desktopString = "@lang('form.officeNumber')";
</script>
<script src=" {{ asset('js/suppliers/show/showSupplier.js') }} "></script>
<script src=" {{ asset('js/suppliers/validateDenialForm.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/status/status.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/contacts/edit.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/contacts/save.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/contacts/cancel.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/contacts/validation.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/contactDetails/contactDetails.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/identification/edit.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/identification/save.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/identification/validation.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/rbq/edit.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/rbq/save.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/rbq/validation.js') }} "></script>
<script src=" {{ asset('js/suppliers/show/rbq/changeType.js') }} "></script>
@endsection