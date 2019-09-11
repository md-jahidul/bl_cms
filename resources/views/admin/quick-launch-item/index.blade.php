@extends('layouts.admin')
@section('title', 'Quick Launch List')
@section('card_name', 'Quick Launch List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><strong>Quick Launch List</strong></li>
@endsection
@section('action')
    <a href="{{ url('quick-launch/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Quick Launch
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered alt-pagination no-footer dataTable"
                           id="Example1" role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Image</th>
                            <th>English</th>
                            <th>Bangla</th>
                            <th>Alt Text</th>
                            <th>Link</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($quickLaunchItems as $key=>$quickLaunchItem)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td><img src="" alt="image"></td>
                                <td>{{$quickLaunchItem->en_title}}</td>
                                <td>{{$quickLaunchItem->bn_title}}</td>
                                <td>{{$quickLaunchItem->alt_text}}</td>
                                <td>{{$quickLaunchItem->link}}</td>

                                <td class="action" width="8%">
                                    <a href="{{ url('menu/'.$quickLaunchItem->id.'/edit') }}" role="button" class="btn btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ url("menu/$quickLaunchItem->id/destroy") }}" class="border-0 btn btn-outline-danger delete_btn" data-id="{{ $quickLaunchItem->id }}" title="Delete the user">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>

{{--                                <td class="text-center">--}}
{{--                                    <span class="dropdown">--}}
{{--                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"--}}
{{--                                            aria-haspopup="true"--}}
{{--                                            aria-expanded="false" class="btn btn-info dropdown-toggle"><i--}}
{{--                                            class="la la-cog"></i></button>--}}
{{--                                      <span aria-labelledby="btnSearchDrop2"--}}
{{--                                            class="dropdown-menu mt-1 dropdown-menu-right">--}}
{{--                                        <a href="{{ url('tags/'.$quickLaunchItem->id.'/edit') }}"--}}
{{--                                           class="dropdown-item"><i class="ft-edit-2"></i> Edit </a>--}}
{{--                                        <div class="dropdown-divider"></div>--}}
{{--                                          <form method="POST"--}}
{{--                                                action="{{ url('/tags', ['id' => $quickLaunchItem->id]) }}"--}}
{{--                                                accept-charset="UTF-8" style="display:inline">--}}
{{--                                          <button type="submit" class="dropdown-item danger"--}}
{{--                                                  title="Delete the user"--}}
{{--                                                  onclick="return confirm('Are you sure?')"><i--}}
{{--                                                  class="ft-trash"></i> Delete</button>--}}
{{--                                               @method('delete')--}}
{{--                                              @csrf--}}
{{--                                          </form>--}}
{{--                                      </span>--}}
{{--                                    </span>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@stop

@push('page-js')
    <script>
        $(document).ready(function () {
            $('#Example1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy', className: 'copyButton',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excel', className: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdf', className: 'pdf', "charset": "utf-8",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'print', className: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                ],
                paging: true,
                searching: true,
                "bDestroy": true,
            });
        });

    </script>
@endpush



