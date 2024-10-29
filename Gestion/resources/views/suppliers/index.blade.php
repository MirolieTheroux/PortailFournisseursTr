<!--//TODO::Alignée les noms et villes à gauche-->
<!--//TODO::Masquer bouton envoi quand rien sélectionné-->

<!--//? NICE_TO_HAVE::Bouton en attente liste fournisseur en rouge et masquer si 0-->
<!--//? NICE_TO_HAVE::Liste des fournisseurs - Faire les tri selon le nombre de critères rempli et status-->
@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/MultiSelect.css') }}">
  <link rel="stylesheet" href="{{ asset('css/suppliers/index.css') }}">
@endsection

@section('content')
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-3 bg-white h-100 full-viewport sticky-under-navbar">
        <form id="filterForm" class="h-100 d-flex flex-column justify-content-between">
          <button id="btnListSelectedSupplier" type="button" class="my-2 py-1 px-3 rounded button-darkblue">{{__('index.listSelectedSuppliers')}}</button>
          @role(['responsable', 'admin'])
            @php
              $waitingSuppliersCount = $suppliers->filter(function ($supplier){
                if(!is_null($supplier->latestNonModifiedStatus()))
                return $supplier->latestNonModifiedStatus()->status === 'waiting';
              })->count();
            @endphp
            @if ($waitingSuppliersCount == 1)
              <button id="btnWaitingSupplier" type="button" class="my-2 py-1 px-3 rounded button-darkblue">{{$waitingSuppliersCount}} {{__('index.waitingSupplierSingle')}}</button>
            @else
              <button id="btnWaitingSupplier" type="button" class="my-2 py-1 px-3 rounded button-darkblue">{{$waitingSuppliersCount}} {{__('index.waitingSuppliers')}}</button>
            @endif
            
          @endrole
          <div>
            <div>{{__('index.supplierSearch')}}</div>
            <div class="text-center">
              <div class="form-floating mb-3">
                <input type="text" id="supplierSearch" name="name" class="form-control" placeholder="">
                <label for="supplierSearch">{{__('index.enterName')}}</label>
              </div>
            </div>
          </div>
          @role(['responsable', 'admin'])
            <div class="pb-3">
              <label for="status">{{__('index.requestStatus')}}</label>
              <select id="status" name="status" data-placeholder="{{__('index.pickStatus')}}" data-search="false" multiple data-multi-select>
                <option value="accepted">{{__('global.accepted')}}</option>
                <option value="denied">{{__('global.denied')}}</option>
                <option value="waiting">{{__('global.waiting')}}</option>
                <option value="toCheck">{{__('global.toCheck')}}</option>
              </select>
            </div>  
          @endrole
          <div>
            <div>Produits et services</div>
            <div class="text-center">
              <div class="form-floating mb-3">
                <input type="text" id="service-search" class="form-control" placeholder="">
                <label for="service-search">{{__('form.productsAndServiceCategoriesSearch')}}</label>
              </div>
            </div>
            <div class="form-floating">
              <div class="form-control" placeholder="details" id="products-categories" style="height: 150px; overflow-x: hidden; overflow-y: auto;">
                <div class="mt-lg-0 mt-md-4" id="service-list">
                </div>
              </div>
              <label for="products-categories" class="labelbackground">{{__('form.productsAndServiceServicesCategorySelection')}}</label>
              <div class="note" id="results-count"><br></div>
            </div>
            <div class="form-floating d-none">
              <div class="form-control" placeholder="selected" id="products-selected" style="height: 150px; overflow-x: hidden; overflow-y: auto;">
                <div class="mt-lg-0 mt-md-4" id="service-selected">
                </div>
              </div>
              <label for="products-selected" class="labelbackground">{{__('form.productsAndServiceServicesCategorySelected')}}</label>
              <div class="note"><br></div>
            </div>
          </div>
          <div class="pb-3">
            <label for="workCategories">{{__('index.workCategories')}}</label>
            <select id="workCategories" name="workCategories" data-placeholder="{{__('index.pickCategory')}}" multiple data-multi-select>
              @foreach ($workSubcategories as $workSubcategory)
                <option value="{{$workSubcategory->code}}">{{$workSubcategory->code}} {{$workSubcategory->name}}</option>
              @endforeach
            </select>
          </div>     
          <div class="pb-3">
            <label for="districtAreas">{{__('form.districtArea')}}</label>
            <select id="districtAreas" name="districtAreas" data-placeholder="{{__('index.pickDA')}}" multiple data-multi-select>
            </select>
          </div>
          <div id="citiesContainer" class="pb-3">
            <label for="cities">{{__('form.city')}}</label>
            <select id="cities" name="cities" data-placeholder="{{__('index.pickCity')}}" multiple data-multi-select>
            </select>
          </div>
        </form>
      </div>

      <div class="col-9 h-100 px-5">
        <div class="sticky-under-navbar bg-lightgrey">
          <div class="row border-bottom border-dark">
            <div class="col-6 d-flex align-items-end">
              <h1>{{__('index.suppliersListTitle')}}</h1>
            </div>
            <div class="col-6 d-flex flex-column justify-content-end">
              <h4 class="text-end">{{__('index.productsServicesCount')}} : <span id="productsServicesCount">0</span></h4>
              <h4 class="text-end">{{__('index.workCategoriesCount')}} : <span id="workSubCategoryCount">0</span></h4>
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
              <div class="col-1 d-flex justify-content-end align-items-end px-0"><input id="selectAllCheck" title="{{__('index.selectAll')}}" class="mb-1 ms-2" type="checkbox" name="suppliers[]" id=""></div>
            </div>
          </div>
        </div>
        <div class="container-fluid border border-top-0 border-dark rounded-bottom p-0 mb-3">
          <div id="supplierList">
            @include('suppliers.components.supplierList', ['suppliers' => $suppliers, 'workSubcategories' => $workSubcategories])
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  var searchText = "{{__('index.searchText')}}";
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/suppliers/indexSupplier.js') }} "></script>
<script src="{{ asset('js/suppliers/productsServices.js') }} "></script>
<script src="{{ asset('js/MultiSelect.js') }} "></script>
<script src="{{ asset('js/suppliers/listSelectedSuppliers.js') }} "></script>
<script>
function addjQueryListeners(){
  $('#cities').change(function () {
    sendFilterForm();
  });
  $('#districtAreas').change(function () {
    sendFilterForm();
  });
  $('#workCategories').change(function () {
    sendFilterForm();
  });
  $('#status').change(function () {
    sendFilterForm();
  });
  $('#supplierSearch').on('keyup', function() {
    sendFilterForm();
  });
  $('#btnWaitingSupplier').click(function() {
    loadWaitingSuppliers();
  });
}

function sendFilterForm(){
  $.ajax({
    url: "{{ route('suppliers.filter') }}",
    method: 'GET',
    data: $('#filterForm').serialize(),
    success: function (response) {
      $('#supplierList').html(response.html);
    },
    error: function () {
      alert('Erreur lors du filtrage des fournisseurs.');
    }
  });
}

function loadWaitingSuppliers(){
  $.ajax({
      url: "{{ route('suppliers.waitingSuppliers') }}",
      method: 'GET',
      success: function (response) {
        $('#supplierList').html(response.html);
      },
      error: function () {
        alert('Erreur lors du filtrage des fournisseurs.');
      }
    });
}
</script>
@endsection
