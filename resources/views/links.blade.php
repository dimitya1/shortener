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
    @if(Session::has('successful link edit'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful link edit') }}
        </div>
    @endif
    @if(Session::has('successful link delete'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful link delete') }}
        </div>
    @endif
    @error('not allowed')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror


    @forelse($links as $link)
        <div class="card" style="margin-bottom: 15px">
            <div class="card-body">
                <h4 class="card-title">Your perfect shortened link</h4>
                <h4 class="card-title"><a href="{{ $link->new_link }}" class="btn btn-link" role="button" aria-pressed="true">{{ $link->new_link }}</a></h4>
                <p class="card-text">Your previous long link</p>
                <p class="card-text"><a href="{{ $link->old_link }}" class="btn btn-link" role="button" aria-pressed="true">{{ $link->old_link }}</a></p>

                @can('view', $link)
                    <a href="{{ route('links.show', ['link' => $link]) }}" class="btn btn-info" style="margin-bottom: 10px">More info</a>
                @endcan
                <div class="w-100"></div>
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
        </div>
    @empty
        <p>No links</p>
    @endforelse

    <br>
    {{ $links->links() }}
    <br>
@endsection
