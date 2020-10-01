@extends('layout')

@section('title', 'Edit link')

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


    @if(Session::has('nothing to update'))
        <div class="alert alert-warning" role="alert">
            {{ Session::get('nothing to update') }}
        </div>
    @endif


    <form method="post" action="{{ route('links.update', ['link' => $link]) }}">
        @method('PATCH')
        @csrf

        <div class="form-group">
            @error('long_link')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="long_link">Link to shorten</label>
            <input type="long_link" name="long_link" class="form-control"
                   value="{{ old('long_link', $link->long_link) }}">
        </div>

        <fieldset disabled>
            <div class="form-group">
                <label for="shortened_link">Shortened link</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ old('shortened_link',  URL::to($link->id)) }}">
            </div>
        </fieldset>

        <button type="submit" class="btn btn-primary">Edit</button>
    </form>

@endsection
