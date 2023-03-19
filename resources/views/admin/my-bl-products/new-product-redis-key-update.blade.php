@extends('layouts.admin')
@section('title', 'Active New Product Code')
@section('content')

    <section>
        <div class="card">
            <div class="card-header">
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                <tr width="100%">
                    <th width="50%" class="text-center">Before you press this button, please make sure that you know what you're doing.</th>
                    <td class="action">
                            <a href="{{ route("active-product-redis-key.update") }}" data-value="enable"
                               class="btn btn-danger border-0 change_status" title="Click to enable">Update Redis Key</a>
                    </td>
                </tr>
                </thead>
            </table>
        </div>

    </section>

@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style></style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
    <script>
    </script>
@endpush
