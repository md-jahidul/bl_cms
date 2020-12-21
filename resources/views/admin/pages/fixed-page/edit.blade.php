@extends('layouts.admin')
@section('title', 'Meta Tag Edit')
@section('card_name', 'Meta Tag Edit')
@section('breadcrumb')
     <li class="breadcrumb-item active"><a href="{{ url('fixed-pages') }}"> Fixed Pages List </a></li>
     <li class="breadcrumb-item active"> Meta Tag Edit</li>
@endsection
@section('action')
    <a href="{{ url('/fixed-pages') }}" class="btn btn-blue btn-glow px-2"><i class="la la-arrow-circle-left"></i> Back </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <h4 class="pb-2"><strong>Page Meta Tag</strong></h4>

                            <form role="form" action="{{ url("fixed-pages/update/$page->id") }}" method="POST" novalidate enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                        <label for="title" class="required">Title</label>
                                        <input type="text" name="title" value="{{ $page->title }}" class="form-control" placeholder="Enter title"
                                               required data-validation-required-message="Enter title">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title'))
                                            <div class="help-block">  {{ $errors->first('title') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                        <label for="title" class="required">Title</label>
                                        <select name="dynamic_route_key" class="form-control">
                                            <option value="">---Select Route---</option>
                                            @foreach($dynamicRoutes as $route)
                                                <option value="{{ $route->key }}" {{ $route->key == $page->dynamic_route_key ? 'selected' : '' }}>{{ $route->url }}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        @if ($errors->has('title'))
                                            <div class="help-block">  {{ $errors->first('title') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                        <label>Page Header (HTML)</label>
                                        <textarea class="form-control" rows="7" name="page_header">{{ isset($page->page_header) ? $page->page_header : null }}</textarea>
                                        <small class="text-info">
                                            <strong>Note: </strong> Title, meta, canonical and other tags
                                        </small>
                                    </div>

                                    <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                        <label>Page Header Bangla (HTML)</label>
                                        <textarea class="form-control" rows="7" name="page_header_bn">{{ isset($page->page_header_bn) ? $page->page_header_bn : null }}</textarea>
                                        <small class="text-info">
                                            <strong>Note: </strong> Title, meta, canonical and other tags
                                        </small>
                                    </div>

                                    <div class="form-group col-md-4 {{ $errors->has('alt_text') ? ' error' : '' }}">
                                        <label>Schema Markup</label>
                                        <textarea class="form-control" rows="7" name="schema_markup">{{ isset($page->schema_markup) ? $page->schema_markup : null }}</textarea>
                                        <small class="text-info">
                                            <strong>Note: </strong> JSON-LD (Recommended by Google)
                                        </small>
                                    </div>


                                    <div class="form-actions col-md-12 ">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
