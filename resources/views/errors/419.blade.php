@extends('layouts.error-layout')
@section('error-content')
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>Oops!</h1>
                <h2>419 - Sorry, your session has expired. Please refresh and try again.</h2>
            </div>
            <a href="{{route('home')}}">Go TO Homepage</a>
        </div>
    </div>
@endsection
