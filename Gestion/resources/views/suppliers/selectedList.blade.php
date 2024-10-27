@extends('layouts.app')

@section('css')
@endsection

@section('content')
  @foreach ($suppliers as $supplier)
    <p>{{$supplier->name}}</p>
  @endforeach
@endsection

@section('scripts')
@endsection