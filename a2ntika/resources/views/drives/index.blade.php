@extends('layouts.app')

@section('content')

<div class="container col-md-6">
    @if (Session::has('done'))
    <div class="alert alert-success">
        {{ Session::get('done') }}
    </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table">
            <tr>
                <th>NO</th>
                <th>title</th>
                <th>Action</th>
                <th>status</th>
            </tr>
            @forelse($drives as $item)
            <tr>
                <th> {{ $loop->iteration }}</th>
                <th>{{ $item->title }}</th>
                <th> <a href="{{route("drive.show",$item->id)}}" class="btn btn-success"> show </a>
                 <a href="{{route("drive.edit",$item->id)}}" class="btn btn-info"> edit </a>
                 <a href="{{route("drive.destroy",$item->id)}}" class="btn btn-danger"> delete </a></th>
                    @if($item->status == 'private')
                  <th>  <a href="{{route("drive.changestatus",$item->id)}}" class="btn btn-danger">private</a></th>
                    @else
                    <th><a href="{{route("drive.changestatus",$item->id)}}" class="btn btn-primary">public</a></th>


                    @endif

            </tr>

            @empty

            @endforelse

        </div>
    </div>
</table>
</div>
@endsection
