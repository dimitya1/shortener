@extends('layout')

@section('title', 'Home page')

@section('content')
    @auth
    <ul class="nav nav-tabs nav-fill">
        <li class="nav-item">
            <a class="nav-link" href="#">My links</a>
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
    @endauth


    @if(Session::has('successful login'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('successful login') }}
        </div>
    @endif


    <div class="jumbotron">
        <h1 class="display-4">Shortener</h1>
        <p class="lead">Shorten any link. Get real-time statistics for your links. Free service.</p>
        <hr class="my-4">
        <p>More value to your links</p>
        @auth
            <a class="btn btn-primary btn-lg" href="#" role="button">Shorten new link</a>
        @endauth
        @guest
            <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Login</a>
        @endguest
    </div>

@endsection
