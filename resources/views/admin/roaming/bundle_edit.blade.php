@extends('layouts.admin')
@section('title', 'Roaming Bundle Details')
@section('card_name', 'Add Details')
@section('breadcrumb')
<li class="breadcrumb-item active"> <a href="{{ url('roaming/bundle') }}"> Roaming Bundles</a></li>
<li class="breadcrumb-item active">Add Details</li>
@endsection
@section('action')
<a href="{{ url('roaming/bundle') }}" class="btn btn-sm btn-secondary"><i class="la la-arrow-left"></i>Back</a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="card-body card-dashboard">
                    <form method="POST" action="{{ url('roaming/bundle/update/'.$bundle->id) }}" class="form" enctype="multipart/form-data">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label>Details (EN)</label>
                                <textarea class="summernote_editor form-control" name="details_en">{{$bundle->details_en}}</textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Details (BN)</label>
                                <textarea class="summernote_editor form-control" name="details_bn">{{$bundle->details_bn}}</textarea>
                            </div>


                            <div class="form-actions col-md-12">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i
                                            class="la la-check-square-o"></i> Update
                                    </button>
                                </div>
                            </div>
                        </div>
                        @csrf
                        @method('PUT')
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
{{--<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">--}}

@endpush
@push('page-js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
{{--<script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>--}}

@endpush




