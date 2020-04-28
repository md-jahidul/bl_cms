@extends('layouts.admin')
@section('title', 'Components List')
@section('card_name', 'Components List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('fixed-pages') }}"> Fixed Pages List </a></li>
    <li class="breadcrumb-item active"><strong>Components List</strong></li>
@endsection
@section('action')
{{--    <a href="{{ url("slider/$sliderId/$type/image/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add Slider Image--}}
{{--    </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ ucwords($page." ". "Components") }}</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%">#</td>
                            <th>Component Type</th>
{{--                            <th>Component Status</th>--}}
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($shortCodes as $index=>$shortCode)
                                <tr data-index="{{ $shortCode->id }}" data-position="{{ $shortCode->display_order }}">
                                    <td width="3%">{{ $index + 1 }}</td>
                                    <td>{{ $shortCode->component_title }}{!! $shortCode->is_active == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
{{--                                    <td>--}}
{{--                                        @if($shortCode->is_active == 1)--}}
{{--                                            <span class="badge badge-success badge-pill">Enabled</span>--}}
{{--                                        @else--}}
{{--                                            <span class="badge badge-danger badge-pill">Disabled</span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
                                    <td class="action" width="8%">
                                        @if($shortCode->is_active == 0)
                                            <a href="{{ route("update-component-status", [ $shortCode->page_id, $shortCode->id ]) }}"
                                               class="btn btn-success border-0" title="Click to enable"> Enable</a>
                                        @else
                                            <a href="{{ route("update-component-status", [ $shortCode->page_id, $shortCode->id ]) }}"
                                               role="button" class="btn btn-danger border-0" title="Click to disable"> Disable</a>
                                        @endif
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
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>
        $(document).ready(function() {
            $('.component-active').on('change', function() {
                alert('hi')
                if(this.checked) {
                    alert('active');
                }else{
                    alert('inactive')
                }
            });

            // $.ajax({
            //     methods: "POST",
            //     url: auto_save_url,
            //     data: {
            //         update: 1,
            //         position: positions
            //     },
            //     success:function(data){ console.log(data) },
            //     error : function() {
            //         alert('Some problems..');
            //     }
            // });
        });

        var auto_save_url = "{{ url('/fixed-page-component-sortable') }}";
    </script>
@endpush





