@extends('layouts.app')

@section('css')
@endsection

@section('content')
  @foreach ($suppliers as $supplier)
    <div class="container bg-white rounded my-3 p-3">
      <div class="row border-bottom border-dark mx-0 px-0">
        <div class="px-0 fw-bolder">{{$supplier->name}}</div>
      </div>
      <div class="row">
        <div class="col-6">
          <div>Courriel : {{$supplier->email}}</div>
          @foreach ($supplier->phoneNumbers as $phoneNumber)
            <div>{{$phoneNumber->type}} {{$phoneNumber->number}} {{$phoneNumber->extension}}</div>
          @endforeach
        </div>
        <div class="col-6">
          @foreach ($supplier->contacts as $contact)
            <div>{{$contact->first_name}} {{$contact->last_name}}, {{$contact->job}}</div>
            <div>{{$contact->email}}</div>
            @foreach ($contact->phoneNumbers as $phoneNumber)
              <div>{{$phoneNumber->type}} {{$phoneNumber->number}} {{$phoneNumber->extension}}</div>
            @endforeach
          @endforeach
        </div>
      </div>
    </div>
  @endforeach
@endsection

@section('scripts')
@endsection