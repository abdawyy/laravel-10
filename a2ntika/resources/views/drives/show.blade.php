@extends('layouts.app')

@section('content')

<div class="container col-md-6">
  <div class="card">
    <h1 class=" text-center my-3"> Drive : {{ $drive->Drive_id }}</h1>

<img src="{{ asset("upload/$drive->file") }}" class="img-top img-fluid">



<div class="card-body">
    <hr>
    <h6> author: {{ $drive->name }}</h6>
    <hr>
    <h6> email:{{ $drive->email }} </h6>
    <hr>
    <h6>{{ $drive->title }} </h6>
    <hr>
    <h6> {{ $drive->desc }}</h6>
    <hr>
    <h6>{{ $drive->status }}</h6>
    @if(Auth::user()->id== $drive->user_id)
    <a href="{{route("drive.edit",$drive->Drive_id)}}" class="btn btn-warning"> edit </a>
    @endif
    <a href="{{ route("drive.download",$drive->Drive_id) }}" class="btn btn-success">download</a>
</div>

  </div>

</div>


@endsection
