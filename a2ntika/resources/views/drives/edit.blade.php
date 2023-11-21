@extends('layouts.app')

@section('content')

<h1 class="m-auto"> edit file :: {{$drive->id}} </h1>
<div class="container col-md-6">
    @if (Session::has('done'))
    <div class="alert alert-success">
        {{ Session::get('done') }}
    </div>
    @endif
<div class="card">
    <div class="card-body bg-success">
        <form action="{{ route('drive.update',$drive->id) }}" method="POST"enctype="multipart/form-data">
        @csrf
    <div class="form-group m-5 ">
        <label for="">Drive title </label>
        <input class="form-control m-3" type="text" value="{{ $drive->title }}" name=title>
    </div>
    <div class="form-group m-5">
        <label for="">Drive descrption </label>
        <input class="form-control m-3" type="text" value="{{ $drive->desc }}" name=desc>
    </div>
    <div class="form-group m-5">
        <label for="">Drive file :: {{ $drive->file }} </label>
        <input class="form-control m-3" type="file"  name=file>
    </div>
    <div class="d-grid">
        <button class="btn btn-warning" name="update" >update</button>
    </div>

    </div>
</div>
</div>

</form>
@endsection
