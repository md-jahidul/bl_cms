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
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th>Component Type</th>
                            <th>Title En</th>
                            <th>Title Bn</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($shortCodes as $index=>$shortCode)
                            @php
                                if($shortCode->id === 19){
                                    continue;
                                }
                            @endphp

                                <tr data-index="{{ $shortCode->id }}" data-position="{{ $shortCode->display_order }}">
                                    <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                    <td>{{ $shortCode->component_title }}{!! $shortCode->is_active == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                    <td>{{$shortCode->title_en}}</td>
                                    <td>{{$shortCode->title_bn}}</td>
                                    <td class="action">
                                        <div>
                                            @if($shortCode->slider && $shortCode->component_type === 'slider_single')
                                                <a href="{{route('slider_images',[ $shortCode->slider->component_id,strtolower($shortCode->slider->short_code) ?? '' ])}}" role="button" class="btn btn-outline-success border-1">Child Item</a>
                                            @elseif ($shortCode->component_url)
                                            <a href="{{url('/'.$shortCode->component_url)}}" role="button" class="btn btn-outline-success border-1">Child Item</a>
                                            @else

                                            @endif
                                            <a href="{{route('fixed-page-components-edit',[ $shortCode->page_id,$shortCode->id ])}}" role="button" class="btn btn-outline-success border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                            @if($shortCode->is_active == 0)
                                                <a href="{{ route("update-component-status", [ $shortCode->page_id, $shortCode->id ]) }}"
                                                class="btn btn-success border-0" title="Click to enable"> Enable</a>
                                            @else
                                                <a href="{{ route("update-component-status", [ $shortCode->page_id, $shortCode->id ]) }}"
                                                role="button" class="btn btn-danger border-0" title="Click to disable"> Disable</a>
                                            @endif
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
@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
        #sortable tr td.action div{
            display: flex;
            justify-content: end;
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





