@extends('layouts.admin')
@section('title', 'Internet Gift Content')
@section('card_name'," Internet Gift Content")

@section('action')
    <a href="{{route('internet-gift-content.create')}}" class="btn btn-info btn-glow px-2">
        Add Content
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1"><strong>{{  "Images"}}</strong>
                    </h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="5%">ID</th>
                            <th>Icon</th>
                            <th>Image</th>
                            <th width="30%">Title</th>
                            <th width="15%">Slug</th>
                            <th width="5%">Visibility</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                        @foreach($internetGiftContents as $index=>$giftContent)
                            <tr data-index="{{ $giftContent->id }}" data-position="{{ $giftContent->sequence }}">
                                <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $giftContent->id }}</td>
                                <td>
                                    @if($giftContent->icon) 
                                        <img class="" src="{{ asset($giftContent->icon) }}" alt="content Icon" height="100" width="100"/>
                                    @endif
                                </td>
                                <td>
                                    @if($giftContent->banner) 
                                        <img class="" src="{{ asset($giftContent->banner) }}" alt="Content Banner" height="100" width="200"/>
                                    @endif
                                </td>
                                <td>{{ $giftContent->name_en }}</td>
                                <td>{{ $giftContent->slug }}</td>
                                <td>
                                    @if($giftContent->visibilityStatus())
                                        <span class="badge badge-success">Visible</span>
                                    @else
                                        <span class="badge badge-danger">Not Visible</span>
                                    @endif
                                </td>
                                <td class="action">
                                    <form action="{{route('internet-gift-content.destroy',$giftContent->id)}}"
                                          id="del_form_{{$giftContent->id}}"
                                          method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="{{route('internet-gift-content.edit', $giftContent->id )}}"
                                           role="button" class="btn btn-outline-info border-0"><i class="la la-pencil"
                                                                                                  aria-hidden="true"></i></a>
                                        <a href="#" data-id="{{ $giftContent->id }}"
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

        let auto_save_url = "{{ url('internet-gift-content/addImage/update-position') }}";

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





