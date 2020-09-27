@extends('layout')

@section('title', 'Login form')

@section('content')

    <form method="post" action="{{ route('login') }}">
        @csrf

        @error('email or password')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror

        <div class="form-group">
            @error('email')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            @error('password')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="remember" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection
