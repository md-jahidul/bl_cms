@extends('layouts.admin')
@section('title', 'Generate Signed Cookie')
@section('card_name', 'Generate Signed Cookie')

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
                            <th>Match ID</th>
                            <th>Signed Cookie</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($matches as $key=>$match)
                            <tr>
                                <td>{{ $match->id }}</td>
                                <td>{{ isset($match->signed_cookie) ? "Signed Cookie Already Created" : "" }}</td>
                                <td>
                                    @if(!$match->signed_cookie)
                                        <a href="#"
                                           class="border-0 btn btn-outline-success cookie cookie-generate" data-id="{{ $match->id }}" title="Generate Signed Cookie">
                                            <i class="la la-link"></i>
                                        </a>
                                    @endif
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
            $('.cookie').click(function () {
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.cookie-generate').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Generate Cookie!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('generate-cookie') }}/"+id,
                            methods: "get",
                            success: function (result) {

                                if (result.success) {
                                    Swal.fire(
                                        'Generated!',
                                        'Signed Cookie Generated SuccessFully.',
                                        'success',
                                    );
                                    setTimeout(redirect, 2000)
                                    function redirect() {
                                        window.location.href = "{{ url('signed-cookie') }}"
                                    }
                                } else {
                                    swal.close();
                                    swal.fire({
                                        title: 'Signed Cookie Generated Failed.',
                                        type: 'error',
                                    });
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
