@extends('layouts.master-layout')

@section('main-content')

    
    
    <div class="container-fluid py-4">
    <div class="card">
        <div class="card-header">
            <h5 class="float-left"><b>Campaign list</b></h5>
            <a href="{{route('campaign.create')}}" role="button" class="btn btn-primary float-right">Create Page</a>
        </div>
        <div class="card-body">
            <table id="campaign_data" class="display table table-hover">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Title</th>
                        <th>Motivational Quote</th>
                        <th>Start to End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($campaigns as $key=>$campaign)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{$campaign->title}}</td>
                            <td>{{$campaign->motivational_quote}}</td>
                            <td>{{$campaign->start_date}} To {{$campaign->end_date}}</td>

                            @if($campaign->is_enable == 1)
                                <td><span class="badge bg-success">Active</span></td>
                            @else
                                <td><span class="badge bg-danger">Inactive</span></td>
                            @endif

                            <td>
                                <a href="{{route('campaign.edit',$campaign->id)}}" role="button" class="btn btn-outline-info border-0"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
                                {{-- <a href="{{route('campaign.destroy',$campaign->id)}}" role="button" class="btn btn-primary">Delete</a> --}}
                                <a href="" id="delete_btn" data-toggle="modal" data-placement="right" title="Delete" role="button" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $campaign->id }}"><i data-id="{{ $campaign->id }}" class="fas fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    




     
@stop
@push('style')
    {{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">--}}
@endpush
@push('scripts')
    {{--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>--}}
    <script>
        $(function () {
            $('.delete_btn').click(function (event) {
                var id = $(event.target).attr('data-id');

                console.log(id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#f51c31',
                    cancelButtonColor: '#1fdd4b',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('campaign/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('campaign') }}"
                                }
                            }
                        })
                    }
                })
            })
        })
    </script>
@endpush
