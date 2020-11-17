@extends('layouts.admin')

@section('title', "Dynamic Route")
@section('card_name', "Dynamic Route")
@section('breadcrumb')
<li class="breadcrumb-item active">Dynamic Route List</li>
@endsection
@section('action')
{{--<a href="{{ url('dynamic-r/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--    Add Page--}}
{{--</a>--}}
@endsection
@section('content')
<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="card-body card-dashboard">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <table class="table table-striped table-bordered zero-configuration" role="grid">
                                <thead>
                                    <tr>
                                        <th width="3%">#</th>
                                        <th width="20%">Container Name</th>
                                        <th width="20%">Url Slug</th>
                                        <th class="text-center" width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($routes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->url }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('dynamic-routes.edit', $item->id) }}" role="button" class="btn-sm btn-outline-info border-0">
                                                <i class="la la-pencil-square"></i>
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






