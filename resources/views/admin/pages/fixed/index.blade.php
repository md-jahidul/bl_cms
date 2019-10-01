@extends('layouts.admin')
@section('title', 'Fixed Pages List')
@section('card_name', 'Fixed Pages List')
@section('action')
    {{-- <a href="{{ $parent_id == 0 ? url('menu/create') : url("menu/$parent_id/child-menu/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Menu
    </a> --}}
@endsection
@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="cursor:move;">
                        <tbody>
                            @if(count($pages) == !0)
                                @foreach($pages as $page)
                                    <tr data-index="{{ $page->id }}" data-position="{{ $page->display_order }}">
                                        <td>{{ $page->title  }} {!! $page->is_active == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                                        <td class="text-center" width="10%"><a href="{{ route('fixed-page-metatags', $page->id ) }}" class="btn btn-outline-success">Meta Info</a></td>
                                        <td class="text-center" width="10%"><a href="{{ route('fixed-page-components', $page->id ) }}" class="btn btn-outline-success">Components</a></td>
                                    </tr>
                                @endforeach
                            @else
                                <div class="text-center mt-5">
                                    <spen>No data available in table</spen>
                                </div>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
@endpush

@push('page-js')
    <script>
        var auto_save_url = "{{ url('menu-auto-save') }}";
    </script>
@endpush


