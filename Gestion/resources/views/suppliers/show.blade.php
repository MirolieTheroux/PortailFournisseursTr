@extends('layouts.app')

@section('css')
@endsection

@section('title', 'Gestion - ' . $supplier->nom)

@section('content')
<p>{{$supplier->name}}</p>
@endsection

@section('scripts')
@endsection
