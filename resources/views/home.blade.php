@extends('layouts.master-layout')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                Profile
                            </div>
                            <div class="col-md-2">
                                <a class="btn-sm btn-primary pull-right" href="" role="button">Edit info</a>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h5><b>ID : </b> {{auth()->user()->id}}</h5>
                        <h5><b>Name : </b> {{auth()->user()->name}}</h5>
                        <h5><b>Role : </b> {{auth()->user()->role}}</h5>
                        <h5><b>Email : </b> {{auth()->user()->email}}</h5>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

