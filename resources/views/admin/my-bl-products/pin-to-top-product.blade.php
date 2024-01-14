@extends('layouts.admin')
@section('title', 'Pin To Top Product')
@section('card_name', 'Pin To Top Products')

@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Product List</h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="cursor:move;">
                        <thead>
                        <tr>
                            <th><i class="icon-cursor-move icons"></i></th>
                            <th>Product Title</th>
                            <th>Product Code</th>
                            <th>Content Type</th>
                            <th>Sequence</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach ($products as $section)
                            <tr data-index="{{ $section->id }}" data-position="{{ $section->pin_to_top_sequence }}">
                                <td class="pt-1" width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $section->details->name ?? null }}</td>
                                <td>{{ $section->product_code ?? null }}</td>
                                <td>{{ $section->details->content_type ?? null }}</td>
                                <td>{{ $section->pin_to_top_sequence ?? null }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
@endpush
@push('page-js')
    <script src="{{ asset('js/custom-js/deep-link.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>
    <script>
        var auto_save_url = "{{ url('pin-to-top-products/sort-auto-save') }}";
    </script>
    <script>
        $(function () {
        })
    </script>
@endpush
