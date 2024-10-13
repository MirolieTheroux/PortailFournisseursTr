@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div class="container-fluid d-flex flex-column h-100">
  <h1 class="text-center">Documentation</h1>
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


@endsection



@section('scripts')

@endsection
