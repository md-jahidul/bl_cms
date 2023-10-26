@extends('layouts.admin')

@section('title', "Pages")
@section('card_name', "Pages")
@section('breadcrumb')
<li class="breadcrumb-item active">Other Page List</li>
@endsection
@section('action')
<a href="{{ url('pages/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
    Add Page
</a>
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="card-body card-dashboard">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20%">Name</th>
                                        <th width="20%">Url Slug</th>
                                        <th width="3%"></th>
                                        <th class="text-center" width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="">

                                    @foreach($pages as $page)
                                    <tr>
                                        <td>
                                            <p class="text-bold-500 text-info">
                                                {{ $page->name }}
                                            </p>
                                        </td>
                                        <td>
                                            {{ $page->url_slug_en }}
                                        </td>
                                        <td align="center">
                                            <a href="{{ route('page-components', $page->id) }}" class="btn btn-secondary">
                                                <span class="text-white">Components</span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a class="text-info" href="{{url('pages/'. $page->id . "/edit")}}">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            <a href="#" remove="{{ url("page/destroy/$page->id") }}"
                                               class="border-0 btn-sm btn-outline-danger delete_btn"
                                               data-id="{{ $page->id }}" title="Delete">
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






