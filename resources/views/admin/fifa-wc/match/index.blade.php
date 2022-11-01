@extends('layouts.admin')
@section('title', 'FIFA Team Section')
@section('card_name', 'FIFA Team Section')

@section('action')
    <a href="{{route('matches.create')}}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
        Create New Match
    </a>
@endsection

@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Match List</h4>
                    <table table class="table table-striped table-bordered" id="Example1"
                           role="grid" aria-describedby="Example1_info"
                    >
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Home Team</th>
                            <th>Away Team</th>
                            <th>Start Time</th>
                            <th>Ticketing Time</th>
                            <th>Number Of Sets</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($matches as $key=>$match)
                            <tr>
                                <td> {{ ++$key }}</td>
                                <td>{{ $match->homeTeam->team_name }}</td>
                                <td>{{ $match->awayTeam->team_name }}</td>
                                <td>{{ $match->start_time }}</td>
                                <td>{{ $match->ticketing_time }}</td>
                                <td>{{ $match->number_of_seats }}</td>
                                <td>{{ $match->status ? "Active" : "Inactive" }}</td>
                                <td>
                                    <a href="{{ route('matches.edit', $match->id) }}" role="button"
                                       class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#"
                                       class="border-0 btn btn-outline-danger delete delete_btn" data-id="{{ $match->id }}" title="Delete the section">
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
@endsection

@push('style')
@endpush
@push('page-js')
    <script src="{{ asset('js/custom-js/deep-link.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.10/clipboard.min.js"></script>

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
                            url: "{{ url('matches/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('matches') }}"
                                }
                            }
                        })
                    }
                })
            })
        })
        $('#Example1').DataTable({
            buttons: [],
            paging: true,
            searching: true,
            "bDestroy": true,
        });
    </script>
@endpush
