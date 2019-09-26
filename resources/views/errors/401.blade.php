@extends('layouts.error-layout')
@section('error-content')
    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>Oops!</h1>
                <h2>401 - Sorry, you are not authorized to access this page.</h2>
            </div>
            <a href="/home">Go TO Homepage</a>
        </div>
    </div>
@endsection
