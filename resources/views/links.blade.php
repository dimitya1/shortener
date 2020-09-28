@extends('layout')

@section('title', 'Your links')

@section('content')
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link active" href="#">My links</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('links.create') }}">Shorten link</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
        </li>
    </ul>
    <br>


    @if(Session::has('successful link shorten'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful link shorten') }}
        </div>
    @endif


    @forelse($links as $link)
        <div class="card" style="margin-bottom: 15px">
            <div class="card-body">
                <h4 class="card-title">Your perfect shortened link</h4>
                <h4 class="card-title"><a href="{{ $link->new_link }}" class="btn btn-link" role="button" aria-pressed="true">{{ $link->new_link }}</a></h4>
{{--                <h4 class="card-title"> <a href="{{ route('readone', ['id' => $ad->id]) }}">{{ $ad->title }}</a> </h4>--}}
                <p class="card-text">Your previous long link</p>
                <p class="card-text"><a href="{{ $link->old_link }}" class="btn btn-link" role="button" aria-pressed="true">{{ $link->old_link }}</a></p>

{{--                @can('update', $ad)--}}
{{--                    <a href="{{ route('ad.create', ['id' => $ad->id]) }}" class="btn btn-warning">Edit</a>--}}
{{--                @endcan--}}
{{--                @can('delete', $ad)--}}
{{--                    <a href="{{ route('ad.delete', ['id' => $ad->id]) }}" class="btn btn-danger">Delete</a>--}}
{{--                @endcan--}}

            </div>
            <div class="card-footer text-muted">
                Shortened {{ $link->created_at->diffForHumans() }}
            </div>
        </div>
    @empty
        <p>No links</p>
    @endforelse

    {{ $links->links() }}

@endsection
