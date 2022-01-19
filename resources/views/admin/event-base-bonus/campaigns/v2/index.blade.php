@extends('layouts.admin')
@section('title', 'Campaign List')
@section('card_name', 'Campaign List')
@section('breadcrumb')
<li class="breadcrumb-item active">Campaign List</li>
@endsection
@section('action')
<a href="{{ url('event-base-bonus/v2/campaigns/create') }}" class="btn btn-outline-primary  round btn-glow px-2"><i class="la la-user-plus"></i>
    Add Campaign
</a>
@endsection
@section('content')

<section id="configuration">
    <div class="">
        <div class="col-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table class="table table-striped table-bordered task-tabel">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($campaigns as $campaign)

                                <tr>
                                    <td>{{ $campaign['title'] }}</td>
                                    <td>{{ $campaign['start_date'] }}</td>
                                    <td>{{ $campaign['end_date'] }}</td>
                                    <td>{{ $campaign['status'] ? 'active':'inactive'}}</td>
                                    <td>
                                        <a href="{{ url('event-base-bonus/v2/campaigns/'.$campaign['id']).'/edit' }}" class="mr-3">
                                            <i class="la la-pencil text-primary"></i>
                                        </a>
                                        <button data-id="{{$campaign['id']}}" data-toggle="tooltip" data-original-title="Delete Slider" data-placement="right" class="border-0 btn btn-outline-danger delete"><i class="la la-trash"></i></button>
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

@push('page-js')
<script>
    $('.task-tabel').DataTable({
        "ordering": false
    });

    $('.delete').click(function() {
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
                    url: "{{ url('event-base-bonus/v2/campaign-del') }}/" + id,
                    type: "GET",
                    success: function (res) {
                        Swal.fire(
                            'Deleted!',
                            'Campaign has been deleted.',
                            'success',
                        );
                        setTimeout(redirect, 2000)

                        function redirect() {
                            window.location.href = "{{ url('event-base-bonus/v2/campaigns') }}"
                        }
                    }
                })
            }
        })
    })
</script>
@endpush