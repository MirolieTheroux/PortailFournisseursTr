@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/suppliers/index.css') }}">
@endsection

@section('content')
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-2 bg-white h-100 full-viewport sticky-under-navbar d-flex flex-column justify-content-between">
        <!--TODO::Faire la section des filtres-->
        <h1>Section des filtres</h1>
        @role(['responsable', 'admin'])
          <h2>Section des filtres responsable only</h2>
          @role(['admin'])
            <h2>Section des filtres admin only</h2>
          @endrole
        @endrole
        <h1>Bas de la section</h1>
      </div>
      <div class="col-10 h-100 px-5">
        <div class="sticky-under-navbar bg-lightgrey">
          <div class="row border-bottom border-dark">
            <div class="col-6 d-flex align-items-end">
              <h1>{{__('index.suppliersListTitle')}}</h1>
            </div>
            <div class="col-6 d-flex flex-column justify-content-end">
              <h4 class="text-end">{{__('index.productsServicesCount')}} : 2</h4><!--TODO::Calculer la quantité-->
              <h4 class="text-end">{{__('index.workCategoriesCount')}} : 3</h4><!--TODO::Calculer la quantité-->
            </div>
          </div>
          <div class="container-fluid border-bottom border-dark mb-0">
            <div class="row">
              <div class="col-1 p-0 d-flex justify-content-center align-items-end">
                <div class="text-start supplier-list-header-text">{{__('index.requestStatus')}}</div>
              </div>
              <div class="col-3 p-0 d-flex justify-content-center align-items-end">
                <div class="text-center">{{__('index.name')}}</div>
              </div>
              <div class="col-3 p-0 d-flex justify-content-center align-items-end">
                <div class="text-center">{{__('index.city')}}</div>
              </div>
              <div class="col-2 p-0 d-flex justify-content-center align-items-end">
                <div class="text-centert">{{__('index.productsServices')}}</div>
              </div>
              <div class="col-2 p-0 d-flex justify-content-center align-items-end">
                <div class="text-center">{{__('index.workCategories')}}</div>
              </div>
              <div class="col-1"></div>
            </div>
          </div>
        </div>
        <div class="container-fluid border border-top-0 border-dark rounded-bottom p-0 mb-3">
          @foreach ($suppliers as $supplier)
            <div class="row supplier-table mx-0 py-1">
              <!--TODO::Programmer l'affichage selon l'état dans la BD-->
              <!--TODO::Mettre le text en fonction de se qui a dans la BD-->
              <!--REMARQUES::Mettre le statut des demandes dans le fichier de langue-->
              <div class="col-1 d-flex px-1">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#02542d" class="bi bi-check2-circle" viewBox="0 0 16 16">
                  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
                  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                </svg>
                <div class="text-center supplier-list-table-text text-accepted ps-1">Acceptée</div> --}}
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#975102" class="bi bi-clock" viewBox="0 0 16 16">
                  <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                </svg>
                <div class="text-center supplier-list-table-text text-waiting ps-1">En attente</div> --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#900b09" class="bi bi-x-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
                <div class="text-center supplier-list-table-text text-refused ps-1">Refusée</div>
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#bf6a02" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                </svg>
                <div class="text-center supplier-list-table-text text-to-review ps-1">À réviser</div> --}}
              </div>
              <div class="col-3 text-center">
                <div class="text-center supplier-list-table-text">{{$supplier->name}}</div>
              </div>
              <div class="col-3 text-center">
                <div class="text-center supplier-list-table-text">{{$supplier->address->city}}</div>
              </div>
              <div class="col-2 text-center supplier-list-table-text">
                <div class="text-centert">1</div><!--TODO::Calculer la quantité de correspondant au filtres-->
              </div>
              <div class="col-2 text-center supplier-list-table-text">
                <div class="text-center">3</div><!--TODO::Calculer la quantité de correspondant au filtres-->
              </div>
              <div class="col-1 d-flex justify-content-around">
                <a href="{{ route('suppliers.show', [$supplier]) }}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                    <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                    <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                  </svg>
                </a>
                <input type="checkbox" name="" id=""><!--TODO::Programmer le checkbox-->
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
@endsection
