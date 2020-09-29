@extends('layout')

@section('title', 'Link info')

@section('content')
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('links.index') }}">My links</a>
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


    <div class="card" style="margin-bottom: 20px">
        <div class="card-body">
            @if($link->count !== 0)
                <h1><span class="badge badge-secondary">Used {{ $link->count }} times</span></h1>
            @else
                <h1><span class="badge badge-secondary">No uses</span></h1>
            @endif
            <h4 class="card-title">Your perfect shortened link</h4>
            <h4 class="card-title"><a href="{{ $link->new_link }}" class="btn btn-link" role="button" aria-pressed="true">{{ $link->new_link }}</a></h4>
            <p class="card-text">Your previous long link</p>
            <p class="card-text"><a href="{{ $link->old_link }}" class="btn btn-link" role="button" aria-pressed="true">{{ $link->old_link }}</a></p>
            @can('update', $link)
                <a href="{{ route('links.edit', ['link' => $link]) }}" class="btn btn-warning" style="margin-bottom: 10px">Edit</a>
            @endcan
            @can('delete', $link)
                <form method="POST" action="{{ route('links.destroy', ['link' => $link]) }}">
                    @csrf
                    @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            @endcan
        </div>
        <div class="card-footer text-muted">
            Shortened {{ $link->created_at->diffForHumans() }}
        </div>
    </div>

@endsection
