@extends('layouts.admin')
@section('title', 'Business Packages')
@section('card_name', 'Business Packages')
@section('action')
    <a href="{{ route('business-package-component.create')}}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i> Add Component </a>

    <a href="{{ url('business-package/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Package
    </a>
@endsection
@section('content')
<section>
   
<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <h4 class="pb-1"><strong>Packages</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th width="20%">Name</th>
                                <th width="60%">Short Details</th>
                                <th width="20%">Home Show</th>
                                <th width="10%">Status</th>
                                <th width="10%">Details</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody class="package_sortable cursor-move">
                            @foreach($packages as $pk)
                            <tr data-index="{{ $pk->id }}" data-position="{{ $pk->sort }}">

                                <td class="category_name">
                                   
                                    <p class="text-bold-500 text-info">
                                        <i class="icon-cursor-move icons"></i> &nbsp; {{ $pk->name }}
                                    </p> 
                                    @if($pk->banner_photo != "")
                                    <img src="{{ config('filesystems.file_base_url') . $pk->banner_photo }}" alt="Banner Photo" height="40px" />
                                    @endif
                                    
                                    
                                </td>
                                
                                <td>
                                    {{$pk->short_details}}
                                </td>
                                <td class="text-center">

                                    @if($pk->home_show == 1)
                                    <a href="{{$pk->id}}" class="btn btn-sm btn-success package_home_show">Showing</a>
                                    @else
                                    <a href="{{$pk->id}}" class="btn btn-sm btn-warning package_home_show">Hidden</a>
                                    @endif

                                </td>
                                <td class="text-center">

                                    @if($pk->status == 1)
                                    <a href="{{$pk->id}}" class="btn btn-sm btn-success package_status">Active</a>
                                    @else
                                    <a href="{{$pk->id}}" class="btn btn-sm btn-warning package_status">Inactive</a>
                                    @endif

                                </td>
                                <td class="text-center">
                                    <a href="{{ route('business-package-details-component.list', $pk->id)}}" class="btn btn-sm btn-primary btn-glow">Components</a>
                                </td>
                                <td class="text-center">

                                   <a class="text-info edit_package" href="{{url('business-package-edit/'.$pk->id)}}">
                                        <i class="la la-pencil-square"></i>
                                    </a>
                                   <a class="text-danger delete_package" href="{{url('business-package-delete/'.$pk->id)}}">
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
    </div>
</div>


@php

    $action = [
        'edit' => 'business-package-component/edit',
        'destroy' => 'business-package-component/destroy',
        'componentSort' => 'business-package-component-sort',
        'section_id' => request()->business_package_id??0
    ];

@endphp
@include('admin.components.index', $action)

</section>

@stop

@push('style')

<link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">

@endpush
@push('page-js')


<script>
$(function () {

    //success and error msg
<?php
if (Session::has('sussess')) {
    ?>
        swal.fire({
            title: "{{ Session::get('sussess') }}",
            type: 'success',
            timer: 2000,
            showConfirmButton: false
        });
    <?php
        } 
        if (Session::has('error')) {
    ?>
            
            swal.fire({
            title: "{{ Session::get('error') }}",
            type: 'error',
            timer: 2000,
            showConfirmButton: false
        });

<?php } ?>
    
    function saveNewPositions(save_url)
        {
            var positions = [];
            $('.update').each(function () {
                positions.push([
                    $(this).attr('data-index'),
                    $(this).attr('data-position')
                ]);
            })
            $.ajax({
                type: "GET",
                url: save_url,
                data: {
                    update: 1,
                    position: positions
                },
                success: function (data) {
                },
                error: function () {
                     swal.fire({
                        title: 'Failed to sort data',
                        type: 'error',
                    });
                }
            });
        }

        $(".package_sortable").sortable({
            
            update: function (event, ui) {
                $(this).children().each(function (index) {
                    if ($(this).attr('data-position') != (index + 1)) {
                        $(this).attr('data-position', (index + 1)).addClass('update')
                    }
                });
                var save_url = "{{ url('business-package-sort-change') }}";
                saveNewPositions(save_url);
            }
        });
        
        

        //status change of home showing of package
        $(".table").on('click', '.package_home_show', function (e) {
            e.preventDefault();

            var packageId = $(this).attr('href');
            var thisObj = $(this);

            $.ajax({
                url: '{{ url("business-package-home-status-change")}}/'+packageId,
                cache: false,
                type: "GET",
                success: function (result) {
                    if (result.success == 1) {
                        swal.fire({
                            title: 'Changed',
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        var btn;

                        if (result.show_status === 1) {
                            btn = '<a href="' + packageId + '" class="btn btn-sm btn-success package_home_show">Showing</a>';

                        } else {
                            btn = '<a href="' + packageId + '" class="btn btn-sm btn-warning package_home_show">Hidden</a>';
                        }
                        $(thisObj).parent('td').html(btn);

                    } else {
                        swal.close();
                        swal.fire({
                            title: result.message,
                            timer: 2000,
                            type: 'error',
                        });
                    }

                },
                error: function (data) {
                    swal.fire({
                        title: 'Status change process failed!',
                        type: 'error',
                    });
                }
            });

        });
        

        //activation status change of business package
        $(".table").on('click', '.package_status', function (e) {
            e.preventDefault();

            var packageId = $(this).attr('href');
            var thisObj = $(this);

            $.ajax({
                url: '{{ url("business-package-active")}}/'+packageId,
                cache: false,
                type: "GET",
                success: function (result) {
                    if (result.success == 1) {
                        swal.fire({
                            title: 'Changed',
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        var btn;

                        if (result.status === 1) {
                            btn = '<a href="' + packageId + '" class="btn btn-sm btn-success package_status">Active</a>';

                        } else {
                            btn = '<a href="' + packageId + '" class="btn btn-sm btn-warning package_status">Inactive</a>';
                        }
                        $(thisObj).parent('td').html(btn);

                    } else {
                        swal.close();
                        swal.fire({
                            title: result.message,
                            timer: 2000,
                            type: 'error',
                        });
                    }

                },
                error: function (data) {
                    swal.fire({
                        title: 'Status change process failed!',
                        type: 'error',
                    });
                }
            });

        });
        
        
        $('.delete_package').on('click', function(){
           var confm = confirm("Do you want to delete this package?");
           if(confm){
               return true;
           }
           return false;
        });

});


</script>
@endpush




