@extends('layouts.admin')
@section('title', 'Section List')
@section('card_name', 'Section List')
@section('breadcrumb')
{{--    <li class="breadcrumb-item active"><a href="{{ route('product.list', [$type]) }}"> Product List</a></li>--}}
    <li class="breadcrumb-item active">Section List</li>
@endsection
@section('action')
    <a href="{{ route('section-create', [$productDetailsId]) }}" class="btn btn-success  round btn-glow px-2"><i class="la la-plus"></i>
        Add Section
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Section List</h4>
                    <table class="table table-striped table-bordered" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Title (English)</th>
                            <th>Title (Bangla)</th>
                            <th>Components</th>
                            <th width="12%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productSections as $section)
                            <tr>
                                <td class="pt-2">{{ $loop->iteration }}</td>
                                <td class="pt-2">{{ $section->title_en }}</td>
                                <td class="pt-2">{{ $section->title_bn }}</td>
                                <td class="pt-2">
                                    <a href="{{ route('component-list', [$productDetailsId, $section->id]) }}"
                                       class="btn-sm btn-outline-primary border">Components</a>
                                </td>
                                <td class="action" width="8%">
                                    <a href="{{ route('section-edit', [$productDetailsId, $section->id]) }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ route('section-destroy', [$productDetailsId, $section->id]) }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $section->id }}" title="Delete the user">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title"><strong>Banner And Related Product</strong></h4><hr>
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{--{{ route('app_service.details.fixed-section', [$tab_type, $product_id ]) }}--}}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">

                                <div class="form-group col-md-6 {{ $errors->has('mobile_view_img') ? ' error' : '' }}">
                                    <label for="mobileImg">Banner Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('banner_image'))
                                        <div class="help-block">  {{ $errors->first('image') }}</div>
                                    @endif
                                </div>

{{--                                <div class="form-group col-md-6">--}}
{{--                                    @if($fixedSectionData['image'])--}}
{{--                                        <img src="{{ config('filesystems.file_base_url') . $fixedSectionData['image'] }}" height="100" width="200" id="imgDisplay">--}}
{{--                                    @else--}}
{{--                                        <img height="100" width="200" id="imgDisplay" style="display: none">--}}
{{--                                    @endif--}}
{{--                                </div>--}}

{{--                                @if($tab_type == "app" || $tab_type == "vas")--}}
                                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                        <label for="title_en">Title (English)</label>
                                        <input type="text" name="title_en" id="title_en" class="form-control" placeholder="Enter offer name in English"
{{--                                               value="{{ $fixedSectionData['title_en'] }}"--}}
                                        >
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_en'))
                                            <div class="help-block">{{ $errors->first('title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                        <label for="title_bn">Title (Bangla)</label>
                                        <input type="text" name="title_bn" id="title_bn" class="form-control" placeholder="Enter offer name in Bangla"
{{--                                               value="{{ $fixedSectionData['title_bn'] }}"--}}
                                        >
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_bn'))
                                            <div class="help-block">{{ $errors->first('title_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group select-role col-md-6 mb-0 {{ $errors->has('role_id') ? ' error' : '' }}">
                                        <label for="role_id">Related Product</label>
                                        <div class="role-select">
                                            <select class="select2 form-control" multiple="multiple" name="other_attributes[related_product_id][]">
{{--                                                @foreach($products as $product)--}}
{{--                                                    <option value="{{ $product->id }}" {{ matchRelatedProduct($product->id, $fixedSectionData['other_attributes']['related_product_id']) ? 'selected' : '' }}>{{$product->name_en}}</option>--}}
{{--                                                @endforeach--}}
                                            </select>
                                        </div>
                                        <div class="help-block"></div>
                                        @if ($errors->has('role_id'))
                                            <div class="help-block">  {{ $errors->first('role_id') }}</div>
                                        @endif
                                    </div>
{{--                                @endif--}}

                                <div class="form-actions col-md-12">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> Save
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('page-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endpush

@push('page-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
@endpush

{{--<style>--}}
{{--    h4.menu-title {--}}
{{--        font-weight: bold;--}}
{{--    }--}}
{{--</style>--}}

