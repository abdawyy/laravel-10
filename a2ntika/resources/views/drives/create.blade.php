@extends('layouts.app')

@section('content')

<h1 class="m-auto"> create file</h1>
<div class="container col-md-6">
    @if (Session::has('done'))
    <div class="alert alert-success">
        {{ Session::get('done') }}
    </div>
    @endif

    <div class="card">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="card-body bg-success">
            <form action="{{ route('drive.store') }}" method="POST"enctype="multipart/form-data">
            @csrf
        <div class="form-group m-5 ">
            <label for="">Drive title </label>
            <input class="form-control m-3" type="text" name=title>
        </div>
        <div class="form-group m-5">
            <label for="">Drive descrption </label>
            <input class="form-control m-3" type="text" name=desc>
        </div>
        <div class="form-group m-5">
            <label for="">Drive file </label>
            <input class="form-control m-3" type="file" name=file>
        </div>
        <div class="d-grid">
            <button class="btn btn-primary" name="submit" >submit</button>
        </div>

        </div>
    </div>
</div>

</form>
@endsection
