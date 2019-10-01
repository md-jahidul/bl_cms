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
                        <h4 class="pb-2"><strong>{{ $metaTag->title }} Page Meta Tag</strong></h4>

                            <form role="form" action="{{ url("fixed-pages/$metaTag->page_id/meta-tag/$metaTag->id/update") }}" method="POST" novalidate enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                        <label for="title" class="required">Title</label>
                                        <input type="text" name="title"  class="form-control" placeholder="Enter title"
                                               value="{{ old("title") ?? $metaTag->title  }}" required data-validation-required-message="Enter title">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title'))
                                            <div class="help-block">  {{ $errors->first('title') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('keywords') ? ' error' : '' }}">
                                        <label for="keywords" class="required">Keywords</label>
                                        <input type="text" name="keywords"  class="form-control" placeholder="Enter keywords"
                                               value="{{ old("keywords") ?? $metaTag->keywords  }}" required data-validation-required-message="Enter keywords">
                                        <div class="help-block"></div>
                                        @if ($errors->has('keywords'))
                                            <div class="help-block">  {{ $errors->first('keywords') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="link">Description</label>
                                        <textarea name="description" rows="3" class="form-control" placeholder="Enter description">{{ old("description") ?? $metaTag->description  }}</textarea>
                                    </div>


                                    <div class="form-actions col-md-12 ">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> Update
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
