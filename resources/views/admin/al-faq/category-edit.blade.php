@extends('layouts.admin')
@section('', 'Faq|Edit')
@section('card_name', 'Faq')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('faq-categories') }}">Faq Categories</a></li>
    <li class="breadcrumb-item active">Faq Category Edit</li>
@endsection
@section('action')
    <a href="{{ url("faq-categories") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route("category.update", $category->id) }}" method="POST" novalidate>
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                           value="{{ $category->title }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                                    <label for="name_en">Name (English)</label>
                                    <input type="text" name="name_en" class="form-control" placeholder="Enter Name"
                                           value="{{ $category->name_en }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_en'))
                                        <div class="help-block">  {{ $errors->first('name_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                                    <label for="name_bn">Name (Bangla)</label>
                                    <input type="text" name="name_bn" class="form-control" placeholder="Enter Name in Bangla"
                                           value="{{ $category->name_bn }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('name_bn'))
                                        <div class="help-block">  {{ $errors->first('name_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('slug') ? ' error' : '' }}">
                                    <label for="slug" class="">Slug</label>
                                    <input type="text" class="form-control" placeholder="" readonly
                                           value="{{ $category->slug }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('slug'))
                                        <div class="help-block">  {{ $errors->first('slug') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('description_en') ? ' error' : '' }}">
                                    <label for="description_en" class="">Description (English)</label>
                                    <textarea type="text" name="description_en" class="form-control" placeholder="Enter description in English" required rows="5"
                                              data-validation-required-message="Enter duration name in bangla">{{ $category->description_en }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('description_en'))
                                        <div class="help-block">  {{ $errors->first('description_en') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('description_bn') ? ' error' : '' }}">
                                    <label for="description_bn" class="">Description (Bangla)</label>
                                    <textarea type="text" name="description_bn" class="form-control" placeholder="Enter description in Bangla" required rows="5"
                                              data-validation-required-message="Enter duration name in bangla">{{ $category->description_bn }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('description_bn'))
                                        <div class="help-block">  {{ $errors->first('description_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> UPDATE
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
@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')

@endpush














