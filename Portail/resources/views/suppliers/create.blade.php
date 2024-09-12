@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/supplier.css') }}">
<link rel="stylesheet" href="{{ asset('css/progressBar.css') }}">
@endsection

@section('progressBar')
<div class="container">		
     <div class="arrow-steps">
        <div class="step current"> <span> Identification</span> </div>
        <div class="step"> <span>Produits et services</span> </div>
        <div class="step"> <span>Licence RBQ</span> </div>
        <div class="step"> <span>Coordonnées</span> </div>
        <div class="step"> <span>Contacts</span> </div>
        <div class="step"> <span>Pièces jointes</span> </div>
        <!-- faire des div interne plus petite de couleur du fond pour faire le border -->
    </div>
</div>
@endsection

@section('content')
<form method="post" action="">
    <!--IDENTIFICATION-->
    <div class="container bg-white rounded">
        <div class="row">
            <div class="col-12 rounded-top fond-image fond-identification"></div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <h1>Identification</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-4">

            </div>
            <div class="col-8">

            </div>
            <h1>Form</h1>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-2">
                <button class="m-2 py-1 px-3 rounded button-darkblue">Annuler</button>
                <button class="m-2 py-1 px-3 rounded button-darkblue">Suivant</button>
            </div>
        </div>
    </div>  <!--FIN IDENTIFICATION-->  

    
    <!--PRODUIT ET SERVICE-->
    
    <!--LICENCE RBQ-->
    
    <!--COORDONNÉES-->
    
    <!--CONTACT-->
    
    <!--PIÈCES JOINTES-->

</form>
@endsection