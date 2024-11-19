<!--//? REMARQUES :
- //? Est-ce qu'on met juste les boutons (ajouter/enregistrer) directement sur la page ? Ou on fait comme la fiche fournisseur avec un bouton modifier ?
  - //? Nico : Je pense que se serait bien de faire comme la fiche fournisseur. Par défaut, on voit Ajouter et modifier, et quand on click sur modifier, on
    //?        masque les boutons ajouter et modifier pour afficher annuler et enregistrer
-->
<!--//? REMARQUES : Il faudrait mettre les boutons ajouter et modifier en haut à côté du titre car j'ai tester d'ajouter des 100aine de lignes test et c'est chiant de scroller jusqu'en bas.-->
<!--//? REMARQUES : Je pense que se serait bien de changer tous les courriels de l'app de gestion pour des @vtr.net (Seeders, liste d'ajout)-->
<!--//? REMARQUES : 
  //? Pour info, je pense que la liste d'ajout, comme elle représente la liste azure qu'il vont plugguer là, 
  //? on peut hardcoder les emails sans passer par les fichiers de langues.
  //?  - PTI, J'ai ajouter des courriels pour tester et je me suis dit que ça fesais pas de mal de les laisser là
-->
<!--//? REMARQUES : Les utilisateurs créer n'ont pas de mot de passe, il faudrait qu'il y en ait un pour qu'il puisse se connecter.
    //?    - Comme ils vont utiliser le mot de passe de leur AD, on peut juste hardcoder Secret1234! à la création
-->
<!--//? REMARQUES : 
  //? Je me demande, est-ce qu'on pourrait afficher le bouton Liste des founisseur dans la navbar aussi pour les commis et les reponsables?
  //? Comme ça, quand ils vont dans la liste de fournisseurs sélectionnés, ils auraient un boutons pour revenir à la liste normale.
  //? Si on fait ça, tu peux ignorer la remarque juste après.
-->
<!--//? REMARQUES : 
  //? Dans la navbar, quand on se connecte comme Commis ou responsable, il y a une border noir alor qui a rien à gauche et c'est un peu laid.
  //? Je metterais la border a droite du centre admin pour qu'elle disparaissent quand il n'y a rien.
-->

@extends('layouts.app')

@section('title', __('navbar.adminCenter'))

@section('css')
<link rel="stylesheet" href="{{ asset('css/settings.css') }}">
@endsection

@section('content')
<div class="container-fluid h-100">
  <div class="row h-100">
    <!--NAVIGATION CÔTÉ-->
    <div class="left-nav shadow-sm col-2 bg-white h-100 d-flex flex-column justify-content-start">
      <div id="users-nav-button" class="mt-3 py-1 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="m-2">
          <path d="M15,6c0-3.309-2.691-6-6-6S3,2.691,3,6s2.691,6,6,6,6-2.691,6-6Zm-6,3c-1.654,0-3-1.346-3-3s1.346-3,3-3,3,1.346,3,3-1.346,3-3,3Zm13,9c0-.281-.026-.556-.076-.823l1.522-.879-1.5-2.598-1.524,.88c-.416-.356-.897-.637-1.422-.824v-1.757h-3v1.757c-.526,.186-1.007,.468-1.422,.824l-1.524-.88-1.5,2.598,1.522,.879c-.049,.267-.076,.542-.076,.823s.026,.556,.076,.823l-1.522,.879,1.5,2.598,1.524-.88c.416,.356,.897,.637,1.422,.824v1.757h3v-1.757c.526-.186,1.007-.468,1.422-.824l1.524,.88,1.5-2.598-1.522-.879c.049-.267,.076-.542,.076-.823Zm-4.5,1.5c-.827,0-1.5-.673-1.5-1.5s.673-1.5,1.5-1.5,1.5,.673,1.5,1.5-.673,1.5-1.5,1.5ZM5.5,14h3.5v3h-3.5c-1.378,0-2.5,1.122-2.5,2.5v4.5H0v-4.5c0-3.033,2.467-5.5,5.5-5.5Z"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="m-2 d-none section-clicked">
          <path d="m8,12c-3.309,0-6-2.691-6-6S4.691,0,8,0s6,2.691,6,6-2.691,6-6,6Zm14.5,6c0-.46-.089-.895-.218-1.313l1.416-.816-.998-1.733-1.411.813c-.605-.652-1.393-1.125-2.289-1.33v-1.621h-2v1.621c-.896.205-1.685.678-2.289,1.33l-1.411-.813-.998,1.733,1.416.816c-.129.418-.218.853-.218,1.313s.089.895.218,1.313l-1.416.816.998,1.733,1.411-.813c.605.652,1.393,1.125,2.289,1.33v1.621h2v-1.621c.896-.205,1.685-.678,2.289-1.33l1.411.813.998-1.733-1.416-.816c.129-.418.218-.853.218-1.313Zm-4.5,1.5c-.827,0-1.5-.673-1.5-1.5s.673-1.5,1.5-1.5,1.5.673,1.5,1.5-.673,1.5-1.5,1.5Zm-8-1.5c0-1.459.397-2.822,1.079-4h-6.579c-2.481,0-4.5,2.019-4.5,4.5v5.5h12.721c-1.665-1.466-2.721-3.607-2.721-6Z"/>
        </svg>
        {{__('settings.userSettings')}}
      </div>
      <div id="settings-nav-button" class="py-1 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="m-2">
          <path d="M15,24H9V20.487a9,9,0,0,1-2.849-1.646L3.107,20.6l-3-5.2L3.15,13.645a9.1,9.1,0,0,1,0-3.29L.107,8.6l3-5.2L6.151,5.159A9,9,0,0,1,9,3.513V0h6V3.513a9,9,0,0,1,2.849,1.646L20.893,3.4l3,5.2L20.85,10.355a9.1,9.1,0,0,1,0,3.29L23.893,15.4l-3,5.2-3.044-1.758A9,9,0,0,1,15,20.487Zm-4-2h2V18.973l.751-.194A6.984,6.984,0,0,0,16.994,16.9l.543-.553,2.623,1.515,1-1.732-2.62-1.513.206-.746a7.048,7.048,0,0,0,0-3.75l-.206-.746,2.62-1.513-1-1.732L17.537,7.649,16.994,7.1a6.984,6.984,0,0,0-3.243-1.875L13,5.027V2H11V5.027l-.751.194A6.984,6.984,0,0,0,7.006,7.1l-.543.553L3.84,6.134l-1,1.732L5.46,9.379l-.206.746a7.048,7.048,0,0,0,0,3.75l.206.746L2.84,16.134l1,1.732,2.623-1.515.543.553a6.984,6.984,0,0,0,3.243,1.875l.751.194Zm1-6a4,4,0,1,1,4-4A4,4,0,0,1,12,16Zm0-6a2,2,0,1,0,2,2A2,2,0,0,0,12,10Z"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="m-2 d-none section-clicked">
          <path d="M21,12a9.143,9.143,0,0,0-.15-1.645L23.893,8.6l-3-5.2L17.849,5.159A9,9,0,0,0,15,3.513V0H9V3.513A9,9,0,0,0,6.151,5.159L3.107,3.4l-3,5.2L3.15,10.355a9.1,9.1,0,0,0,0,3.29L.107,15.4l3,5.2,3.044-1.758A9,9,0,0,0,9,20.487V24h6V20.487a9,9,0,0,0,2.849-1.646L20.893,20.6l3-5.2L20.85,13.645A9.143,9.143,0,0,0,21,12Zm-6,0a3,3,0,1,1-3-3A3,3,0,0,1,15,12Z"/>
        </svg>
        {{__('settings.settingsManagement')}}
      </div>
      <div id="emails-nav-button" class="py-1 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="m-2">
          <path d="M19,1H5A5.006,5.006,0,0,0,0,6V18a5.006,5.006,0,0,0,5,5H19a5.006,5.006,0,0,0,5-5V6A5.006,5.006,0,0,0,19,1ZM5,3H19a3,3,0,0,1,2.78,1.887l-7.658,7.659a3.007,3.007,0,0,1-4.244,0L2.22,4.887A3,3,0,0,1,5,3ZM19,21H5a3,3,0,0,1-3-3V7.5L8.464,13.96a5.007,5.007,0,0,0,7.072,0L22,7.5V18A3,3,0,0,1,19,21Z"/>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="m-2 d-none section-clicked">
          <path d="M23.954,5.542,15.536,13.96a5.007,5.007,0,0,1-7.072,0L.046,5.542C.032,5.7,0,5.843,0,6V18a5.006,5.006,0,0,0,5,5H19a5.006,5.006,0,0,0,5-5V6C24,5.843,23.968,5.7,23.954,5.542Z"/>
          <path d="M14.122,12.546l9.134-9.135A4.986,4.986,0,0,0,19,1H5A4.986,4.986,0,0,0,.744,3.411l9.134,9.135A3.007,3.007,0,0,0,14.122,12.546Z"/>
        </svg>
        {{__('settings.emailSettings')}}
      </div>
    </div> <!-- FIN NAVIGATION CÔTÉ-->

    <div class="col-10 h-100 px-4 py-0">
      <!-- USERS SETTINGS-->
      <div class="show-section" id="users-section">
        <div class="row border-bottom border-2 border-dark mt-3">
          <h2 class="mb-0">{{__('settings.userSettings')}}</h2>
        </div>
        <div class="container-fluid mb-0 mt-3 border-bottom border-dark">
          <div class="row ">
            <div class="col-5 p-0">
              <div class="text-start ">{{__('settings.users')}}</div>
            </div>
            <div class="col-5 p-0">
              <div class="text-center">{{__('settings.role')}}</div>
            </div>
          </div>
        </div>
        <div class="container-fluid border border-top-0 border-dark rounded-bottom p-0 mb-3">
          <div id="userList">
            @if (Count($users) > 0)
            <form id="usersListForm" method="POST" action="{{route('users.addUser')}}">
            @csrf
              @foreach ($users as $user)
                <div class="row user-table mx-0 py-1">
                  <div class="col-5 text-center ps-2">
                    <div class="text-start">{{$user->email}}</div>
                  </div>
                  <div class="col-5 text-center ps-1">
                    <select name="userRoles" id="userRoles" class="form-select" aria-label="" disabled>
                      <option value="" selected>{{__('settings.defaultRole')}}</option>
                      <option value="admin" {{$user->role == 'admin' ? 'selected' : null  }}>{{__('settings.admin')}}</option>
                      <option value="responsable" {{$user->role == 'responsable' ? 'selected' : null  }}>{{__('settings.responsable')}}</option>
                      <option value="clerk" {{$user->role == 'clerk' ? 'selected' : null  }}>{{__('settings.clerk')}}</option>
                    </select>
                  </div>
                  <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-x col-2" viewBox="0 0 16 16" style="cursor:pointer;">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                  </svg>
                </div>
              @endforeach
            </form>
            @else
              <div class="text-center">{{__('settings.noUser')}}</div>
            @endif
          </div>
        </div>
        <!-- MODAL ADD USER -->
        <div class="modal fade" id="modalAddUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddUser" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">{{__('settings.addUser')}}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="addUserForm" method="POST" action="{{route('users.addUser')}}">
                  @csrf
                    <div class="mb-3">
                      <label>{{__('settings.chooseUser')}}</label>
                      <select name="userEmail" id="userEmail" class="form-select" aria-label="">
                        <option value="{{__('settings.emailTest')}}">{{__('settings.emailTest')}}</option>
                        <option value="{{__('settings.emailTest2')}}">{{__('settings.emailTest2')}}</option>
                        <option value="nfleurent@vtr.net">nfleurent@vtr.net</option>
                        <option value="mtheroux@vtr.net">mtheroux@vtr.net</option>
                        <option value="jfaucher@vtr.net">jfaucher@vtr.net</option>
                        <option value="fjacob@vtr.net">fjacob@vtr.net</option>
                        <option value="dbrouillette@vtr.net">dbrouillette@vtr.net</option>
                        <option value="scarle@vtr.net">scarle@vtr.net</option>
                      </select>
                      <div class="invalid-feedback" id="emailExist" style="display: none;">{{__('settings.errorUserAlreadyAdded')}}</div>
                    </div>
                    <label>{{__('settings.defaultRole')}}</label>
                    <select name="userRole" id="userRole" class="form-select" aria-label="">
                      <option value="responsable">{{__('settings.responsable')}}</option>
                      <option value="clerk">{{__('settings.clerk')}}</option>
                      <option value="admin">{{__('settings.admin')}}</option>
                    </select>
                    <div class="invalid-feedback" id="maxAdmin" style="display: none;">{{__('settings.errorAdmin')}}</div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button id="addUserModal" type="submit" class="m-2 py-1 px-3 rounded button-darkblue">{{__('global.add')}}</button>
                  <button type="button" class="m-2 py-1 px-3 rounded button-darkblue" data-bs-dismiss="modal">{{__('global.close')}}</button>
                </div>
              </div>
            </div>
          
        </div> <!-- END MODAL ADD USER-->
        <div class="d-flex justify-content-end align-items-end mb-2">
          <button id="btnAddUsers" type="button" class="m-2 py-1 px-3 rounded button-darkblue edit">{{__('global.add')}}</button>
          <button id="btnSaveUsers" type="submit" class="m-2 py-1 px-3 rounded button-darkblue save">{{__('global.save')}}</button>
        </div>
      </div>  <!--FIN USERS SETTINGS-->
    
      <!-- PARAMÈTRES -->
      <div class="container d-flex flex-column h-100 show-section d-none" id="settings-section">
        <div class="bg-white my-2 rounded form-section h-100 w-100">
          <h1 class="text-center">{{__('settings.settingsManagement')}}</h1>
          <div class="px-3">
              <div class="col-12 d-flex justify-content-center mb-2">
                <a id="btnCancelId" href="" class="m-2 py-1 px-3 rounded previous-button d-none">{{__('global.cancel')}}</a>
                <button id="btnEditUsers" type="button" class="m-2 py-1 px-3 rounded button-darkblue edit">{{__('global.edit')}}</button>
                <button id="btnSaveUsers" type="submit" class="m-2 py-1 px-3 rounded button-darkblue d-none save">{{__('global.save')}}</button>
              </div>
          </div>
        </div>
      </div><!--FIN PARAMÈTRES-->
      <!-- COURRIELS -->
      <div class="container d-flex flex-column h-100 show-section d-none" id="emails-section">
        <div class="bg-white my-2 rounded form-section h-100 w-100">
          <h1 class="text-center">{{__('settings.emailSettings')}}</h1>
          <div class="px-3">
            <div class="row pb-3">
            <div class="row">
              <div class="col-12 d-flex justify-content-center mb-2">
                <a id="btnCancelId" href="" class="m-2 py-1 px-3 rounded previous-button d-none">{{__('global.cancel')}}</a>
                <button id="btnEditUsers" type="button" class="m-2 py-1 px-3 rounded button-darkblue edit">{{__('global.edit')}}</button>
                <button id="btnSaveUsers" type="submit" class="m-2 py-1 px-3 rounded button-darkblue d-none save">{{__('global.save')}}</button>
              </div>
            </div>
          </div>
        </div>
      </div><!--FIN COURRIEL-->
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src=" {{ asset('js/adminCenter/showSettings.js') }} "></script>
<script src=" {{ asset('js/adminCenter/users/addUsers.js') }} "></script>
<script src=" {{ asset('js/adminCenter/users/validation.js') }} "></script>
@endsection