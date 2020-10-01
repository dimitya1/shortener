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

    @if($link->statistics->count() !== 0)
        <h1><span class="badge badge-secondary">Used {{ $link->statistics->count() }} times</span></h1>
    @else
        <h1><span class="badge badge-secondary">No uses</span></h1>
    @endif

    @if($link->statistics->count() !== 0)
    <h1 class="text-center">Statistics</h1>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Ip address</th>
            <th scope="col">Browser</th>
            <th scope="col">Browser engine</th>
            <th scope="col">Operating system</th>
            <th scope="col">Device</th>
        </tr>
        </thead>
        <tbody>
        @foreach($statistics as $statistic)
            <tr>
                <td>{{ $statistic->ip }}</td>
                <td>{{ $statistic->browser }}</td>
                <td>{{ $statistic->engine }}</td>
                <td>{{ $statistic->os }}</td>
                <td>{{ $statistic->device }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
@endsection
