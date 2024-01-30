@extends('layouts.admin')
@section('title', 'Gamification Types')
@section('card_name'," Gamification Types")

@section('action')
    <a href="{{route('gamification-type.create')}}" class="btn btn-info btn-glow px-2">
        Add Gamification Type
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ "VAS Product"}}</strong>
                    </h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="5%">ID</th>
                            <th width="15%">Type EN</th>
                            <th width="15%">Type BN</th>
                            <th width="15%">Visibility</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable-new">
                        @foreach($gamificationTypes as $index => $gamificationType)
                            <tr data-index="{{ $gamificationType->id }}" data-position="{{$gamificationType->display_order}}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $gamificationType->id }}</td>
                                <td>{{ $gamificationType->type_en }}</td>
                                <td>{{ $gamificationType->type_bn }}</td>
                                <td>
                                    @if($gamificationType->visibilityStatus())
                                        <span class="badge badge-success">Visible</span>
                                    @else
                                        <span class="badge badge-danger">Not Visible</span>
                                    @endif
                                </td>
                                <td class="action">
                                    <form action="{{route('gamification-type.destroy',$gamificationType->id)}}"
                                          id="del_form_{{$gamificationType->id}}"
                                          method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{route('gamification-type.edit', $gamificationType->id )}}"
                                           role="button" class="btn btn-outline-info border-0"><i class="la la-pencil"
                                                                                                  aria-hidden="true"></i></a>
                                        <a href="#" data-id="{{ $gamificationType->id }}"
                                           role="button" class="btn btn-outline-danger border-0 del"><i
                                                class="la la-remove"
                                                aria-hidden="true"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td {
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>

        let auto_save_url = "{{ url('vas-products/order/update-position') }}";

        $(document).ready(function () {
            $(document).on('click', '.del', function (e) {
                e.preventDefault();

                let id = $(this).data('id');
                console.log(id);

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
                    console.log(result);
                    if (result.value) {
                        console.log("#del_form_" + id)
                        $("#del_form_" + id).submit();
                    }
                })
            })

        });

    </script>
@endpush





