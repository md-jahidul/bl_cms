@extends('layouts.admin')
@section('title', 'Metatag Edit')
@section('card_name', 'Metatag Edit')
@section('breadcrumb')
    {{-- <li class="breadcrumb-item active"> {{$metatags->title}}</li> --}}
@endsection
@section('action')
    <a href="{{ url('sliders') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ url("fixed-pages/$metatags->id/metatags") }}" method="POST" novalidate>
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                           value="{{ !empty($metatags) ? $metatags->title : '' }}" required data-validation-required-message="Enter slider title" readonly>
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> SAVE
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $metatags->id }}"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop