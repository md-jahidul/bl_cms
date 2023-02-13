@extends('layouts.admin')

@section('title', "6C's Page")
@section('card_name', "6C's Page")
@section('breadcrumb')
<li class="breadcrumb-item active">6C's Page List</li>
@endsection
@section('action')
<a href="{{ url('explore-c-pages/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
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
                                <tbody class="service_sortable cursor-move">

                                    @foreach($pages as $p)
                                    <tr>
                                        <td>
                                            <p class="text-bold-500 text-info">
                                                {{ $p->page_name_en }}
                                            </p>
                                        </td>
                                        <td>
                                            {{ $p->url_slug }}
                                        </td>
                                        <td align="center">
                                            <a href="{{ route('explore-c-component.list', $p->id) }}" class="btn btn-secondary">
                                                <span class="text-white">Components</span>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a class="text-info" href="{{url('explore-c-pages/edit/'.$p->id)}}">
                                                <i class="la la-pencil-square"></i>
                                            </a>
                                            <a class="text-danger delete_package" href="{{url('explore-c-pages/delete/'.$p->id)}}">
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






