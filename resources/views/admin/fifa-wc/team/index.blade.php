@extends('layouts.admin')
@section('title', 'FIFA WC Team')
@section('card_name', 'FIFA WC Team')

@section('action')
    <a href="{{route('teams.create')}}" class="btn btn-primary round btn-glow px-2"><i class="la la-plus"></i>
        Create New Team
    </a>
@endsection

@section('content')
    <section>
        <div class="card col-sm-12">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title">Team List</h4>
                    <table table class="table table-striped table-bordered" id="Example1"
                           role="grid" aria-describedby="Example1_info"
                    >
                        <thead>
                        <tr>
                            <th>Team Name</th>
                            <th>Team Flag</th>
                            <th>Group Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $team)
                                <tr>
                                    <td>{{ $team->team_name }}</td>
                                    <td><img class="" src="{{ asset($team->team_flag) }}" alt="Flag"
                                             height="50" width="100"/></td>
                                    <td>{{ $team->group_name }}</td>
                                    <td>
                                        <a href="{{ route('teams.edit', $team->id) }}" role="button"
                                           class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        <a href="#"
                                           class="border-0 btn btn-outline-danger delete delete_btn" data-id="{{ $team->id }}" title="Delete the section">
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
                            url: "{{ url('teams/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('teams') }}"
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
