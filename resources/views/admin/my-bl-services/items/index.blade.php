@extends('layouts.admin')
@section('title', 'Service Items')
@section('card_name', $service->title." Service")

@section('action')
    <a href="{{route('my-bl-services.items.create',$service->id)}}" class="btn btn-info btn-glow px-2">
        Create Items
    </a>
    <a href="{{route('my-bl-services.index')}}" class="btn btn-primary btn-glow px-2">
        Service List
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{ ucwords($service->title_en." ". "Items") }}</strong>
                    </h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="5%">ID</th>
                            <th width="15%">Title EN</th>
                            <th width="15%">Title BN</th>
                            <th width="10%">Alt Text</th>
                            <th width="10%">Deeplink</th>
                            <th width="10%">Highlight</th>
                            <th width="10%">Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable-new">
                        @foreach($service_items as $index=>$items)
                            <tr data-index="{{ $items->id }}" data-position="{{ $items->sequence }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $items->id }}</td>
                                <td>{{ $items->title_en }}</td>
                                <td>{{ $items->title_bn }}</td>
                                <td>{{ $items->alt_text }}</td>
                                <td>{{ $items->deeplink }}</td>
                                <td>{{ $items->is_highlight==1?'Yes':'No' }}</td>
                                <td>{{ $items->status ==1?'Active':'Inactive'}}</td>
                                <td class="action">
                                    <a
                                        href="{{ route('my-bl-services.items.edit', $items->id) }}"
                                        role="button"
                                        class="btn btn-outline-info border-0"
                                    >
                                        <i class="la la-pencil" aria-hidden="true"></i>
                                    </a>
                                    <form action="{{route('my-bl-services.items.destroy',$items->id)}}"
                                          id="del_form_{{$items->id}}"
                                          method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="#" data-id="{{ $items->id }}"
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
        let auto_save_url = "{{ url('my-bl-services/add-items/update-position') }}";
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





