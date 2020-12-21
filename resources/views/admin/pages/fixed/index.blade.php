@extends('layouts.admin')
@section('title', 'Fixed Pages List')
@section('card_name', 'Fixed Pages List')
@section('action')
     <a href="{{ url("fixed-pages/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Fixed Page
    </a>
@endsection
@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info">
                        <tbody>
                            @if(count($pages) == !0)
                                @foreach($pages as $page)
                                    <tr data-index="{{ $page->id }}" data-position="{{ $page->display_order }}">
                                        <td width="55%">{{ $page->title  }}</td>
                                        <td class="text-right" width="30%">
                                            <a href="{{ route('fixed-page-metatags', $page->id ) }}" class="btn btn-success  round btn-glow px-2">Meta Info</a>
                                            <a href="{{ route('fixed-page-components', $page->id ) }}" class="btn btn-instagram  round btn-glow px-2">Components</a>
                                        </td>


                                        <td class="text-right">
                                            <a href="" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                            <a href="#" remove="{{--{{ url("offers/$type/$product->id") }}--}}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{--{{ $product->id }}--}}" title="Delete">
                                                <i class="la la-trash"></i>
                                            </a>
                                        </td>

                                        <!-- <a href="{{ route('partner-offer-home') }}" class="btn btn-instagram  round btn-glow px-2"><i class="la la-list"></i>View home page offers</a>
                                        <a href="{{ url('partners/create') }}" class="btn btn-success  round btn-glow px-2"><i class="la la-plus"></i>Add Partner</a> -->


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


