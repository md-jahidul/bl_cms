@extends('layouts.admin')
@section('title', 'questions List')
@section('card_name', 'Question List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Slider List</li>
@endsection

{{-- @section('content_header')
    <h1 class="content-header-title mb-0 d-inline-block">
        Slider List
    </h1>
    <p class="rounded">
       @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('danger') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </p>
@endsection --}}

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
            <div id="headingCollapse2" class="card-header" @if (!$errors->isEmpty() || isset($single_slider)) role="tab" @endif >
                <a role="button" data-toggle="collapse" href="#collapse2" id="show_form" aria-expanded="false" aria-controls="collapse2" class="card-title lead collapsed btn btn-info btn-sm"><i class="la la-plus"></i> Create Slider</a>
            </div>
            <div style="padding-left:10px;padding-right:10px" id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2" id="show_form_extra" class="collapse @if (!$errors->isEmpty()|| isset($single_slider)) show @endif" aria-expanded="false">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="@if (isset($single_slider)) {{route('slider.update',$single_slider->id)}} @else {{route('slider.store')}} @endif" method="POST">
                        @csrf
                        @if (isset($single_slider)) @method('put') @else @method('post') @endif
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Slider Information</h4>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="companyName">Name:<small class="text-danger">*</small></label>
                                    <input type="text" value="@if(isset($single_slider)) {{ $single_slider->title }} @endif" id="companyName" class="form-control @error('title') is-invalid @enderror" placeholder="Slider Name" name="title">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput6">Slider Type:<small class="text-danger">*</small></label>
                                    <select id="projectinput6" value="" name="slider_type_id" class="form-control @error('slider_type_id') is-invalid @enderror">
                                        @foreach ($slider_types as $type)
                                            <option @if(isset($single_slider)) @if($single_slider->slider_type_id == $type->id) selected @endif @endif value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('slider_type_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                            <label for="projectinput8">Discription:</label>
                            <textarea id="projectinput8" rows="5" class="form-control" name="description" placeholder="About Project">@if(isset($single_slider)) {{ $single_slider->description }} @endif
                            </textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">
                            <i class="la la-check-square-o"></i> Save
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-info mt-0" style="box-shadow: 0px 0px">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="100">id</th>
                            <th>Tittle</th>
                            <th>Slider Type</th>
                            <th width="300">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>{{$slider->id}}</td>
                                    <td>
                                        {{$slider->title}}
                                        <span class="badge badge-default badge-pill bg-primary float-right">{{$slider->sliderImages->count()}}</span>
                                    
                                    </td>
                                    <td>{{$slider->sliderType->name}}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <a role="button" data-toggle="tooltip" data-original-title="Edit Slider Information" data-placement="left" href="{{route('slider.edit',$slider->id)}}" class="btn-pancil btn btn-outline-success" >
                                                    <i class="la la-pencil"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-2">
                                                <a role="button" data-toggle="tooltip" data-original-title="Add Image to slider" data-placement="top" href="{{route('sliderImage.index',$slider->id)}}" class=" btn btn-outline-success">
                                                    <i class="la la-plus"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-2">
                                                <a role="button" data-toggle="tooltip" data-original-title="View & Edit slider" data-placement="top" href="{{route('sliderImage.edit',$slider->id)}}" class=" btn btn-outline-success">
                                                    <i class="la la-eye"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-2">
                                                <button data-id="{{$slider->id}}" data-toggle="tooltip" data-original-title="Delete Slider" data-placement="right" class="btn btn-outline-danger delete" onclick=""><i class="la la-trash"></i></button>
                                            </div>
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

   


@endsection




@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets')}}/vendors/css/tables/datatable/datatables.min.css">
    <style></style>
@endpush
@push('page-js')
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/vendors/js/tables/datatable/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="{{asset('app-assets')}}/js/scripts/tables/datatables/datatable-advanced.js" type="text/javascript"></script>
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