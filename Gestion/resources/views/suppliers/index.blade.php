@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/MultiSelect.css') }}">
<link rel="stylesheet" href="{{ asset('css/suppliers/index.css') }}">
@endsection

@section('content')
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-2 bg-white h-100 full-viewport sticky-under-navbar">
        <form id="filterForm" class="h-100 d-flex flex-column justify-content-between">
          <!--TODO::Faire la section des filtres-->
          <div>Lister les fourniseurs sélectionnés</div>
          <div>Recherche</div>
          @role(['responsable', 'admin'])
            <div>État de la demande</div>
          @endrole
          <div>Produits et services</div>
          <div>Catégories de travaux</div>
          <div>            
            <div class="pb-3">
            <label for="districtAreas">{{__('form.districtArea')}}</label>
            <select id="districtAreas" name="districtAreas" data-placeholder="{{__('index.pickDA')}}" multiple data-multi-select>
            </select>
            </div>
          </div>
          <div class="pb-3">
            <label for="cities">{{__('form.city')}}</label>
            <select id="cities" name="cities" data-placeholder="{{__('index.pickCity')}}" multiple data-multi-select>
            </select>
          </div>
        </form>
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
          <div id="supplierList">
            @include('suppliers.components.supplierList', ['suppliers' => $suppliers])
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/indexSupplier.js') }} "></script>
<script src="{{ asset('js/MultiSelect.js') }} "></script>
<script>
function addjQueryListeners(){
  $('#cities').change(function () {
    sendFilterForm();
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
        alert('Erreur lors du filtrage des articles.');
      }
    });
}
</script>
@endsection
