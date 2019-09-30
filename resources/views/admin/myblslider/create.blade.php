@extends('layouts.admin')
@section('title', 'Slider')

@php 
    $name = isset($single_slider)?'Edit ':'Create ';
    $slidername = isset($single_slider)? $single_slider->title:''

@endphp

@section('card_name', "Slider")
@section('breadcrumb')
    <li class="breadcrumb-item active">
        {{$name.$slidername}} Slider
    </li>
@endsection

@section('content')
    <section>
        <div class="card card-info mb-0" style="padding-left:10px">
                <div class="card-content">
                    <div class="card-body">
                        <form novalidate class="form" action="@if (isset($single_slider)) {{route('myblslider.update',$single_slider->id)}} @else {{route('myblslider.store')}} @endif" method="POST">
                        @csrf
                        @if (isset($single_slider)) @method('put') @else @method('post') @endif
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-paperclip"></i>Slider Information</h4>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="companyName" class="required">Name:</label>
                                    <input 
                                        required
                                        maxlength="200" 
                                        data-validation-regex-regex="(([aA-zZ' '])([0-9/.;:><-])*)*"
                                        data-validation-required-message="Name is required" 
                                        data-validation-regex-message="Name must start with alphabets"
                                        data-validation-maxlength-message = "Name can not be more then 200 Characters" 
                                        
                                        type="text" 
                                        value="@if(isset($single_slider)) {{ $single_slider->title }} @endif" 
                                        id="companyName" 
                                        class="form-control @error('title') is-invalid @enderror" 
                                        placeholder="Slider Name" name="title">
                                        
                                        <div class="help-block">
                                            <small class="text-info"> Name can not be more then 200 Characters</small><br>
                                        </div>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @if(isset($single_slider)) <input type="hidden" name="id" value="{{$single_slider->id}}"> @endif
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="required">Slider type:</label>
                                    <div class="controls">
                                        <select required data-validation-required-message="Slider type is required" id="projectinput6" style="height:34px" value="" name="component_id" class="form-control @error('component_id') is-invalid @enderror">
                                        <option value="">Select slider type</option>
                                        @foreach ($slider_types as $type)
                                            <option @if(isset($single_slider)) @if($single_slider->component_id == $type->id) selected @endif @endif value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                        </select>
                                        <div class="help-block"></div>
                                        @error('component_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="platform" value="App">
                            </div>
                            <div class="form-group">
                            <label for="projectinput8">Discription:</label>
                            <textarea 
                            required
                            data-validation-required-message="Discription is required" 
                            id="projectinput8" name="description" rows="5" class="form-control" name="description" placeholder="About Slider...">@if(isset($single_slider)) {{ $single_slider->description }} @endif</textarea>
                            <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success round px-2">
                                <i class="la la-check-square-o"></i> Submit
                            </button>
                        </div>
                        </form>
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
      $(function () {
            $('.delete').click(function () {
                var id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('slider/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('slider/') }}"
                                }
                            }
                        })
                    }
                })
            })
        })


       
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