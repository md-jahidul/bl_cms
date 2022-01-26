@extends('layouts.admin')
@section('title', 'SMS Language Configs')
@section('card_name', 'SMS Language Configs')
@section('breadcrumb')
    <li class="breadcrumb-item active">SMS Language Configs</li>
@endsection
@section('action')
    <a href="{{route('sms-languages.create')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Config
    </a>

@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr style="text-align: center">
                            <th width='2%'>Serial</th>
                            <th width='10%'>Feature</th>
                            <th width='30%'>SMS BN</th>
                            <th width='30%'>SMS EN</th>
                            <th width='8%'>Platform</th>
                            <th width='5%'>Status</th>
                            <th width='15%'>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($smsLanguages as $smsLanguage)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$smsLanguage->feature}}</td>
                                <td>{{$smsLanguage->sms_bn}}</td>
                                <td>{{$smsLanguage->sms_en}}</td>
                                <td>{{$smsLanguage->platform}}</td>
                                <td>{{$smsLanguage->status ? 'Active' : 'Draft'}}</td>
                                <td>
                                    <div class="row justify-content-md-center no-gutters">

                                        <a role="button" href="{{route('sms-languages.edit',$smsLanguage->id)}}"
                                           class="btn btn-sm btn-outline-success">
                                            <i class="la la-pencil"></i>
                                        </a>&nbsp;
{{--                                        <button data-id="{{$smsLanguage->id}}"--}}
{{--                                                class="btn btn-sm btn-outline-danger delete"--}}
{{--                                                onclick="">--}}
{{--                                            <i class="la la-trash"></i>--}}
{{--                                        </button>--}}

                                    </div>
                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </section>

    <!-- /.card -->



@endsection

@section('content_right_side_bar')
    <h1>
        List
    </h1>
@endsection


@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style></style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js"
            type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js"
            type="text/javascript"></script>

    <script>
        $(function () {
            $('.delete').click(function () {
                var id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('otp-config/destroy') }}/" + id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)

                                function redirect() {
                                    window.location.href = "{{ url('otp-config/') }}"
                                }
                            }
                        })
                    }
                })
            })
        })

        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [],
                paging: true,
                searching: false,
                "pageLength": 10,
                "bDestroy": true,
            });
        });


    </script>
@endpush
