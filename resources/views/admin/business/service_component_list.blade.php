@extends('layouts.admin')
@section('title', 'Business Solution, IOT & Others Component List')
@section('card_name', 'Component List')
@section('action')
<a href="{{ url('business-others-components/'.$serviceId) }}" class="btn btn-sm btn-primary"><i class="la la-plus"></i>Add More</a>
<a href="{{ url('business-other-services') }}" class="btn btn-sm btn-grey-blue"><i class="la la-angle-double-left"></i>Back</a>
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
                                    <th width="20%">Component Type</th>
                                    <th width="60%">Data</th>
                                    <th class="text-center" width="15%">Photo</th>
                                    <th class="text-center" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody class="service_sortable cursor-move">

                                @foreach($components as $k => $com)
                                <tr class="sortable_row" data-index="{{ $com['id'] }}" data-position="{{ $k }}" data-oldpos="{{$k}}" data-type="{{$com['type']}}">

                                    <td class="category_name">

                                        <p class="text-bold-500">
                                            <i class="icon-cursor-move icons"></i> &nbsp; {{ $com['type'] }}
                                        </p> 

                                    </td>

                                    <td>
                                        @if($com['type'] == "Photo Component")

                                        @if($com['photo1'] != "")
                                        <img src="{{ config('filesystems.file_base_url') . $com['photo1'] }}" alt="Photo 1" height="40px" />
                                        @endif
                                        @if($com['photo2'] != "")
                                        <img src="{{ config('filesystems.file_base_url') . $com['photo2'] }}" alt="Photo 2" height="40px" />
                                        @endif
                                        @if($com['photo3'] != "")
                                        <img src="{{ config('filesystems.file_base_url') . $com['photo3'] }}" alt="Photo 3" height="40px" />
                                        @endif
                                        @if($com['photo4'] != "")
                                        <img src="{{ config('filesystems.file_base_url') . $com['photo4'] }}" alt="Photo 4" height="40px" />
                                        @endif

                                        @else
                                        {!!$com['text']!!}
                                        @endif

                                    </td>
                                    <td>
                                        @if($com['photo_url'] != "")
                                        <img src="{{ config('filesystems.file_base_url') . $com['photo_url'] }}" alt="Photo" height="60px" />
                                        @endif
                                    </td>


                                    <td class="text-center">


                                        <a class="text-info edit_component"
                                           href="{{url('business-others-component-edit/'.$serviceId.'/'.$k.'/'.$com['type'])}}">
                                            <i class="la la-pencil-square"></i>
                                        </a>

                                        <a class="text-danger delete_component" 
                                           href="{{url('business-others-component-delete/'.$serviceId.'/'.$k.'/'.$com['type'])}}">
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
            $('.sortable_row').each(function () {
                positions.push({
                    "id": $(this).attr('data-index'),
                    "position": $(this).attr('data-position'),
                    "old_position": $(this).attr('data-oldpos'),
                    "type": $(this).attr('data-type')
                });
                
                var type = $(this).attr('data-type');
                var newPosition = $(this).attr('data-position');
                
                var editUrl = "{{ url('business-others-component-edit/'.$serviceId.'/')}}/"+newPosition +"/"+type;
                $(this).find("a.edit_component").attr("href", editUrl);
                
                var delUrl = "{{ url('business-others-component-delete/'.$serviceId.'/')}}/"+newPosition +"/"+type;
                $(this).find("a.delete_component").attr("href", delUrl);
                
              
            });
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

            return true;
        }

        $(".service_sortable").sortable({

            update: function (event, ui) {
                $(this).children().each(function (index) {
                    if ($(this).attr('data-position') != (index + 1)) {
                        $(this).attr('data-position', (index + 1)).addClass('update');
                    }
                });
                var save_url = "{{ url('business-other-component-sort') }}";
                var changeSort = saveNewPositions(save_url);

                if (changeSort == true) {

                    $(this).children().each(function (index) {
                        $(this).attr('data-oldpos', (index + 1));
                    });
                }
            }
        });


        $('.delete_component').on('click', function () {
            var confm = confirm("Do you want to delete this component?");
            if (confm) {
                return true;
            }
            return false;
        });

    });


</script>
@endpush




