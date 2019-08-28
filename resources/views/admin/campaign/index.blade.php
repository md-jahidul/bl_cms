@extends('layouts.admin')
@section('title', 'Campaign List')
@section('card_name', 'Campaign List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Campaign List</li>
@endsection
@section('action')
    <a href="{{ url('campaigns/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Campaign
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
                            <th>Id</th>
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
                                    <td class="text-center"><span class="badge bg-success">Active</span></td>
                                @else
                                    <td class="text-center"><span class="badge bg-danger">Inactive</span></td>
                                @endif

                                <td class="text-center">
                                    <span class="dropdown">
                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false" class="btn btn-info dropdown-toggle"><i
                                                class="la la-cog"></i></button>
                                      <span aria-labelledby="btnSearchDrop2"
                                            class="dropdown-menu mt-1 dropdown-menu-right">
                                        <a href="{{ url('campaigns/'.$campaign->id.'/edit') }}"
                                           class="dropdown-item"><i class="ft-edit-2"></i> Edit </a>
                                        <div class="dropdown-divider"></div>

                                          <form method="POST"
                                                action="{{ url('/campaigns', ['id' => $campaign->id]) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                          <button type="submit" class="dropdown-item danger"
                                                  title="Delete the user"
                                                  onclick="return confirm('Are you sure?')"><i
                                                      class="ft-trash"></i> Delete</button>
                                               @method('delete')
                                              @csrf
                                          </form>
                                      </span>
                                    </span>
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




