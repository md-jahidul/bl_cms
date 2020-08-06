@extends('layouts.admin')
@section('title', 'About Career Create')
@section('card_name', 'About Career Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('tag-category') }}">About Career List</a></li>
    <li class="breadcrumb-item active"> About Career Create</li>
@endsection
@section('action')
    <a href="{{ url('tag-category') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('about-career.store') }}" method="POST" novalidate>
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title (English)</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter tag name"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter tag name"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter title in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
                                    <label for="description_en">Description (English)</label>
                                    <textarea type="text" name="description_en"  class="form-control" placeholder="Enter description in English"></textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('description_en'))
                                        <div class="help-block">  {{ $errors->first('description_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
                                    <label for="description_bn">Description (Bangla)</label>
                                    <textarea type="text" name="description_bn"  class="form-control" placeholder="Enter description in Bangla"></textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('description_bn'))
                                        <div class="help-block">  {{ $errors->first('description_bn') }}</div>
                                    @endif
                                </div>


                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')

@endpush






