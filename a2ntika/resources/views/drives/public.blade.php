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

                    @if($item->status == 'private')
                  <th>  <div  class="btn btn-danger">private</div></th>
                    @else
                    <th><a  class="btn btn-primary">public</div></th>


                    @endif

            </tr>

            @empty

            @endforelse

        </div>
    </div>
</table>
</div>
@endsection
