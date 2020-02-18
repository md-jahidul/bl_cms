@extends('layouts.admin')
@section('title', 'Product List')
@section('card_name', 'Product List')
@section('breadcrumb')
    <li class="breadcrumb-item ">Product List</li>
@endsection
@section('action')
{{--    <a href="#" id="syncBtn" class="btn btn-outline-blue-grey round btn-glow px-2">--}}
{{--        Sync Core Product--}}
{{--    </a>--}}
    <a href="{{ route("app-service-product.create") }}" class="btn btn-primary  round btn-glow px-2" data-toggle="modal" data-target="#add_details_with_compoent"><i class="la la-plus"></i>
        Add section
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>Product</strong></h4>
                    <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <td width="3%">#</td>
                                <th width="20%">Product Name</th>
                                <th width="20%">Product Description</th>
                                <th width="5%">Price</th>
                                <th>USSD</th>
                                <th width="5%">Tab</th>
                                <th>Category</th>
                                <th class="text-center" width="8%">Details</th>
                                <th width="5%" class="text-center">Can Active</th>
                                <th width="12%" class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if( !empty($appServiceProduct) )
                            @foreach($appServiceProduct as $product)
                                {{--@if($product->product != '')--}}
                                    @php $path = 'partner-offers-home'; @endphp
                                    <tr data-index="{{ $product->id }}" data-position="{{ $product->display_order }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name_en }}{!! $product->status == 0 ? '<span class="danger pl-1"><strong> ( Inactive )</strong></span>' : '' !!}</td>
                                        <td>{{ $product->description_en }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->ussd_en }}</td>
                                        <td>{{ $product->appServiceTab->name_en }}</td>
                                        <td>{{ $product->appServiceCat->title_en }}</td>
                                        <td class="text-center">
                                             <a href="{{--{{ route('product.details') }}--}}" class="btn-sm btn-outline-warning border">Details</a>
                                        </td>
                                        <td class="text-center"><input type="checkbox" {{ $product->can_active == 1 ? 'checked' : '' }} disabled></td>
                                        <td>
{{--                                            <a href="--}}{{--{{ route('product.show', [$product->id]) }}--}}{{--" role="button" class="btn-sm btn-outline-secondary border-0"><i class="la la-eye" aria-hidden="true"></i></a>--}}
                                            <a href="{{ url("app-service-product/$product->id/edit") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                            <a href="#" remove="{{ url("offers/$product->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $product->id }}" title="Delete">
                                                <i class="la la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                {{--@endif--}}
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    
    {{-- {{ dd($data['tab_type']) }} --}}

    <div class="modal fade" id="add_details_with_compoent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add App and Service details with component</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form id="product_form" role="form" action="{{ route('app_service.details.store', [ 'type' => $data['tab_type'], 'id' => $data['product_id'] ]) }}" method="POST" novalidate enctype="multipart/form-data">
                    @csrf
                  <div class="modal-body">
                    
                    <div class="row">
                        
                        <div class="form-group col-md-6 {{ $errors->has('name_en') ? ' error' : '' }}">
                            <label for="name_en">Title (English)</label>
                            <input type="text" name="name_en" id="name_en" class="form-control" placeholder="Enter offer name in English"
                                   value="{{ old("name_en") ? old("name_en") : '' }}">
                            <div class="help-block"></div>
                            @if ($errors->has('name_en'))
                                <div class="help-block">{{ $errors->first('name_en') }}</div>
                            @endif
                        </div>

                        <div class="form-group col-md-6 {{ $errors->has('name_bn') ? ' error' : '' }}">
                            <label for="name_bn">Title (Bangla)</label>
                            <input type="text" name="name_bn" id="name_bn" class="form-control" placeholder="Enter offer name in Bangla"
                                   value="{{ old("name_bn") ? old("name_bn") : '' }}">
                            <div class="help-block"></div>
                            @if ($errors->has('name_bn'))
                                <div class="help-block">{{ $errors->first('name_bn') }}</div>
                            @endif
                        </div>

                        <div class="form-group col-md-6 ">
                            <label for="description_en">Description (English)</label>
                            <textarea type="text" name="description_en" id="vat" class="form-control" placeholder="Enter description in English"
                            >{{ old("description_en") ? old("description_en") : '' }}</textarea>
                            <div class="help-block"></div>
                        </div>

                        <div class="form-group col-md-6 ">
                            <label for="description_bn">Description (Bangla)</label>
                            <textarea type="text" name="description_bn" id="vat" class="form-control" placeholder="Enter description in Bangla"
                            >{{ old("description_bn") ? old("description_bn") : '' }}</textarea>
                            <div class="help-block"></div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="mr-1">Status:</label>
                                <input type="radio" name="status" value="1" id="active" checked>
                                <label for="active" class="mr-1">Active</label>

                                <input type="radio" name="status" value="0" id="inactive">
                                <label for="inactive">Inactive</label>
                            </div>
                        </div>
                        
                    </div>

                  </div>
                  <div class="modal-footer">
                    <a type="button" href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
              </form>
            </div>
        </div>
    </div><!-- /.modal -->
    <!-- Modal -->

@stop

@push('page-css')
{{--    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">--}}
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>
        

    </script>
@endpush





