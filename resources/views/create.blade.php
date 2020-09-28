@extends('layout')

@section('title', 'Shorten link')

@section('content')
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('links.index') }}">My links</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Shorten link</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }}</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
        </li>
    </ul>
    <br>


    <form method="post" action="{{ route('links.store') }}">
        @csrf

        <div class="form-group">
            @error('old_link')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="old_link">Link to shorten</label>
            <input type="old_link" name="old_link" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Shorten</button>
    </form>

@endsection
