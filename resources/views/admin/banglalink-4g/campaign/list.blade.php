@extends('layouts.admin')

@section('title', "Dynamic Pages")
@section('card_name', "Banglalink 4G")
@section('breadcrumb')
<li class="breadcrumb-item active">4G Campaigns List</li>
@endsection
@section('action')
<a href="{{ url('bl-4g-campaign/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
    Add Campaign
</a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>4G Campaigns</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th width="18%">Title</th>
                            <th width="8%">Image</th>
                            <th width="25%">Details</th>
                            <th class="">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($campaigns as $campaign)
                            <tr>
                                <td width="3%">{{ $loop->iteration }}</td>
                                <td>{{ $campaign->title }} {!! $campaign->status == 0 ? '<span class="text-danger"> ( Inactive )</span>' : '' !!}</td>
                                <td><img class="" src="{{ config('filesystems.file_base_url') . $campaign->image_url }}" alt="Slider Image" height="100" width="180" /></td>
                                <td>{!! $campaign->details_en !!}</td>
                                <td width="12%" class="text-center">
                                    <a href="{{ url("bl-4g-campaign/$campaign->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("bl-4g-campaign/destroy/$campaign->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $campaign->id }}" title="Delete">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
@stop

@push('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/tinymce/tinymce.min.css') }}">
@endpush
@push('page-js')
<script src="{{ asset('app-assets/vendors/js/editors/tinymce/tinymce.js') }}" type="text/javascript"></script>
<script src="{{ asset('app-assets/js/scripts/editors/editor-tinymce.js') }}" type="text/javascript"></script>
<script>
$(function () {
    $('.delete_package').on("click", function(e){

       var confrm = confirm("Do you want to delete this page?");
       if(confrm){
           return true;
       }
       return false;
    });
});
</script>
@endpush






