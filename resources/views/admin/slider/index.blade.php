@extends('layouts.admin')
@section('title', 'Slider List')
@section('card_name', 'Slider List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Slider List</li>
@endsection
@section('action')
    <a href="{{ url('sliders/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Slider
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">

                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Slider Type</th>
                            <th>Description</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $slider->title }}</td>
                                <td>{{ $slider->type->name }}</td>
                                <td>{{ $slider->description }}</td>
                                <td>{{ $slider->platform }}</td>
                                <td class="text-center" width="10%"><a href="{{ route('slider_images',[$slider->id,  str_replace(" ", "-", strtolower( $slider->type->name ) ) ]  ) }}" class="btn btn-outline-info"><i class="la la-image"></i> Slider Images <span class="ml-1 badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{--{{ $childNumber }}--}}</span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </section>

@stop

@push('page-js')
    <script>
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf', className: 'pdf', "charset": "utf-8",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,

            });
        });

    </script>
@endpush
