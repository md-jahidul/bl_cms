@extends('layouts.admin')
@section('title', 'Create Component')
@section('card_name', 'Create Component')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('appservice.component.list', ['type' => $data['tab_type'], 'id' => $data['section_id']]) }}">Component List</a></li>
    <li class="breadcrumb-item active"> Create Component</li>
@endsection
@section('action')
    <a href="{{ route('appservice.component.list', ['type' => $data['tab_type'], 'id' => $data['section_id']]) }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h5 class="menu-title"><strong>Product Create</strong></h5><hr>
                    <div class="card-body card-dashboard">
                        <form id="product_form" role="form" action="{{ route('app-service-product.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                @if( !empty($component_type) )
                                    @include('admin.app-service.details.components.partial.'.$component_type)
                                @else
                                    @include('admin.app-service.details.components.partial.default')
                                @endif


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mr-1">Status:</label>
                                            <input type="radio" name="status" value="1" id="active" checked>
                                            <label for="active" class="mr-1">Active</label>

                                            <input type="radio" name="status" value="0" id="inactive">
                                            <label for="inactive">Inactive</label>
                                        </div>
                                    </div>

                                    <div class="form-actions col-md-12">
                                        <div class="pull-right">
                                            <button id="save" class="btn btn-primary"><i
                                                        class="la la-check-square-o"></i> Save
                                            </button>
                                        </div>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/selectize/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/selects/selectize.default.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/forms/select/selectize.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/select/form-selectize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/product.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('js/custom-js/start-end.js')}}"></script>
    <script src="{{ asset('js/custom-js/image-show.js')}}"></script>

    <script>
        $(function () {
            $('#offer_type').change(function () {
                var typeId = $(this).find('option:selected').val()
                var appServiceCat = $('#appServiceCat');
                $.ajax({
                    url: "{{ url('app-service/category-find') }}" + '/' + typeId,
                    success: function (data) {
                        appServiceCat.empty();
                        var option = '<option value="">---Select Category---</option>'
                        $.map(data, function (item) {
                            option += '<option data-alias="'+item.alias+'" value="'+item.id+'">'+item.title_en+'</option>'
                        })
                        appServiceCat.append(option)
                    },
                })
            })
        })
    </script>
@endpush


