@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/supplier.css') }}">
<link rel="stylesheet" href="{{ asset('css/progressBar.css') }}">
@endsection

@section('progressBar')
<div class="container-fluid d-flex justify-content-center">		
    <div class="arrow-steps">
        <div class="step current">
            <span class="number">1</span>
            <span class="name">Identification</span>
        </div>
        <div class="step">
            <span class="number">2</span>
            <span class="name">Produits et services</span>
        </div>
        <div class="step">
            <span class="number">3</span>
            <span class="name">Licence RBQ</span>
        </div>
        <div class="step">
            <span class="number">4</span>
            <span class="name">Coordonnées</span>
        </div>
        <div class="step">
            <span class="number">5</span>
            <span class="name">Contacts</span>
        </div>
        <div class="step">
            <span class="number">6</span>
            <span class="name">Pièces jointes</span>
        </div>
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