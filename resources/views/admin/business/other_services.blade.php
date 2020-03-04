@extends('layouts.admin')
@section('title', 'Business Solution, IOT & Others')
@section('card_name', 'Business Solution, IOT & Others')
@section('action')
<a href="{{ url('business-others/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
    Add Service
</a>
@endsection
@section('content')
<section>

    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <h4 class="pb-1"><strong>Business Solution</strong></h4>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="20%">Name</th>
                                    <th width="60%">Short Details</th>
                                    <th class="text-center" width="15%">Component</th>
                                    <th class="text-center" width="10%">Home Top</th>
                                    <th class="text-center" width="10%">Home Slider</th>
                                    <th class="text-center" width="10%">Status</th>
                                    <th class="text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody class="service_sortable cursor-move">

                                @foreach($businessSolution as $bs)
                                <tr data-index="{{ $bs->id }}" data-position="{{ $bs->sort }}">

                                    <td class="category_name">

                                        <p class="text-bold-500 text-info">
                                            <i class="icon-cursor-move icons"></i> &nbsp; {{ $bs->name }}
                                        </p> 

                                    </td>

                                    <td>
                                        {{$bs->short_details}}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('business-others-components-list/'.$bs->id) }}" class="btn btn-sm btn-success">View</a>
                                        <a href="{{ url('business-others-components/'.$bs->id) }}" class="btn btn-sm btn-info">Add</a>
                                    </td>
                                    
                                    <td class="text-center">

                                        @if($bs->home_show == 1)
                                        <a href="{{$bs->id}}" class="btn btn-sm btn-success package_home_show">Showing</a>
                                        @else
                                        <a href="{{$bs->id}}" class="btn btn-sm btn-warning package_home_show">Hidden</a>
                                        @endif

                                    </td>
                                    
                                    <td class="text-center">

                                        @if($bs->in_home_slider == 1)
                                        <a href="{{$bs->id}}" class="btn btn-sm btn-success package_home_slider">Yes</a>
                                        @else
                                        <a href="{{$bs->id}}" class="btn btn-sm btn-dark package_home_slider">No</a>
                                        @endif

                                    </td>

                                    <td class="text-center">

                                        @if($bs->status == 1)
                                        <a href="{{$bs->id}}" class="btn btn-sm btn-success package_status">Active</a>
                                        @else
                                        <a href="{{$bs->id}}" class="btn btn-sm btn-warning package_status">Inactive</a>
                                        @endif

                                    </td>
                                    <td class="text-center">

                                        <a class="text-info edit_package" href="{{url('business-others-service-edit/'.$bs->id)}}">
                                            <i class="la la-pencil-square"></i>
                                        </a>
                                        <a class="text-danger delete_package" href="{{url('business-others-service-delete/'.$bs->id)}}">
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


    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <h4 class="pb-1"><strong>IOT</strong></h4>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="20%">Name</th>
                                    <th width="60%">Short Details</th>
                                    <th class="text-center" width="15%">Component</th>
                                    <th class="text-center" width="10%">Home Top</th>
                                    <th class="text-center" width="10%">Home Slider</th>
                                    <th class="text-center" width="10%">Status</th>
                                    <th class="text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody class="service_sortable cursor-move">

                                @foreach($iot as $i)
                                <tr data-index="{{ $i->id }}" data-position="{{ $i->sort }}">

                                    <td class="category_name">

                                        <p class="text-bold-500 text-info">
                                            <i class="icon-cursor-move icons"></i> &nbsp; {{ $i->name }}
                                        </p> 

                                    </td>

                                    <td>
                                        {{$i->short_details}}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('business-others-components-list/'.$i->id) }}" class="btn btn-sm btn-success">View</a>
                                        <a href="{{ url('business-others-components/'.$i->id) }}" class="btn btn-sm btn-info">Add</a>
                                    </td>

                                    <td class="text-center">

                                        @if($i->home_show == 1)
                                        <a href="{{$i->id}}" class="btn btn-sm btn-success package_home_show">Showing</a>
                                        @else
                                        <a href="{{$i->id}}" class="btn btn-sm btn-warning package_home_show">Hidden</a>
                                        @endif

                                    </td>
                                    
                                    <td class="text-center">

                                        @if($bs->in_home_slider == 1)
                                        <a href="{{$bs->id}}" class="btn btn-sm btn-success package_home_slider">Yes</a>
                                        @else
                                        <a href="{{$bs->id}}" class="btn btn-sm btn-dark package_home_slider">No</a>
                                        @endif

                                    </td>

                                    <td class="text-center">

                                        @if($i->status == 1)
                                        <a href="{{$i->id}}" class="btn btn-sm btn-success package_status">Active</a>
                                        @else
                                        <a href="{{$i->id}}" class="btn btn-sm btn-warning package_status">Inactive</a>
                                        @endif

                                    </td>
                                    <td class="text-center">

                                        <a class="text-info edit_package" href="{{url('business-others-service-edit/'.$i->id)}}">
                                            <i class="la la-pencil-square"></i>
                                        </a>
                                        <a class="text-danger delete_package" href="{{url('business-others-service-delete/'.$i->id)}}">
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


    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <h4 class="pb-1"><strong>Others</strong></h4>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="20%">Name</th>
                                    <th width="60%">Short Details</th>
                                    <th class="text-center" width="15%">Component</th>
                                    <th class="text-center" width="10%">Home Top</th>
                                    <th class="text-center" width="10%">Home Slider</th>
                                    <th class="text-center" width="10%">Status</th>
                                    <th class="text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody class="service_sortable cursor-move">

                                @foreach($others as $o)
                                <tr data-index="{{ $o->id }}" data-position="{{ $o->sort }}">

                                    <td class="category_name">

                                        <p class="text-bold-500 text-info">
                                            <i class="icon-cursor-move icons"></i> &nbsp; {{ $o->name }}
                                        </p> 

                                    </td>

                                    <td>
                                        {{$o->short_details}}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('business-others-components-list/'.$o->id) }}" class="btn btn-sm btn-success">View</a>
                                        <a href="{{ url('business-others-components/'.$o->id) }}" class="btn btn-sm btn-info">Add</a>
                                    </td>

                                    <td class="text-center">

                                        @if($o->home_show == 1)
                                        <a href="{{$o->id}}" class="btn btn-sm btn-success package_home_show">Showing</a>
                                        @else
                                        <a href="{{$o->id}}" class="btn btn-sm btn-warning package_home_show">Hidden</a>
                                        @endif

                                    </td>
                                    
                                    
                                    <td class="text-center">

                                        @if($o->in_home_slider == 1)
                                        <a href="{{$o->id}}" class="btn btn-sm btn-success package_home_slider">Yes</a>
                                        @else
                                        <a href="{{$o->id}}" class="btn btn-sm btn-dark package_home_slider">No</a>
                                        @endif

                                    </td>

                                    <td class="text-center">

                                        @if($o->status == 1)
                                        <a href="{{$o->id}}" class="btn btn-sm btn-success package_status">Active</a>
                                        @else
                                        <a href="{{$o->id}}" class="btn btn-sm btn-warning package_status">Inactive</a>
                                        @endif

                                    </td>
                                    <td class="text-center">

                                        <a class="text-info edit_package" href="{{url('business-others-service-edit/'.$o->id)}}">
                                            <i class="la la-pencil-square"></i>
                                        </a>
                                        <a class="text-danger delete_package" href="{{url('business-others-service-delete/'.$o->id)}}">
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

        $(".service_sortable").sortable({

            update: function (event, ui) {
                $(this).children().each(function (index) {
                    if ($(this).attr('data-position') != (index + 1)) {
                        $(this).attr('data-position', (index + 1)).addClass('update')
                    }
                });
                var save_url = "{{ url('business-others-sort-change') }}";
                saveNewPositions(save_url);
            }
        });



        //status change of home showing of package
        $(".table").on('click', '.package_home_show', function (e) {
            e.preventDefault();

            var packageId = $(this).attr('href');
            var thisObj = $(this);

            $.ajax({
                url: '{{ url("business-others-home-show")}}/' + packageId,
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


        //status change of home showing of package
        $(".table").on('click', '.package_home_slider', function (e) {
            e.preventDefault();

            var packageId = $(this).attr('href');
            var thisObj = $(this);

            $.ajax({
                url: '{{ url("business-others-home-slider")}}/' + packageId,
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
                            btn = '<a href="' + packageId + '" class="btn btn-sm btn-success package_home_slider">Yes</a>';

                        } else {
                            btn = '<a href="' + packageId + '" class="btn btn-sm btn-black package_home_slider">No</a>';
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
                url: '{{ url("business-others-active")}}/' + packageId,
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


        $('.delete_package').on('click', function () {
            var confm = confirm("Do you want to delete this service?");
            if (confm) {
                return true;
            }
            return false;
        });

    });


</script>
@endpush




