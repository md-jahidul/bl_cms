@extends('layouts.admin')
@section('title', 'Business Packages')
@section('card_name', 'Business Packages')
@section('action')
    <a href="{{ route('business-package-details-component.create', ['section_id' => request()->business_package_details_id])}}" class="btn btn-sm btn-primary btn-glow"><i class="la la-plus"></i> Add Details page Component </a>
    <a href="{{ url('business-package') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>

@endsection
@section('content')
<section>

@php

    $action = [
        'edit' => 'business-package-details-component/edit',
        'destroy' => 'business-package-details-component/destroy',
        'componentSort' => 'business-package-details-component-sort',
        'section_id' => request()->business_package_details_id
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




