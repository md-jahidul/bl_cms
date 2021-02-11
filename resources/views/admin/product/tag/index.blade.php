@extends('layouts.admin')
@section('title', 'Product Tags')
@section('card_name', 'Product Tags')

@section('content')
    <section>
        <div class="card">

            <!-- Card for add time slot -->
            <div class="card-content collapse show">
                <div class="card-body">
                    <form class="form" action="{{route('product-tags.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="title" class="control-label">Tag Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Tag Title"
                                           required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="priority" class="control-label">Order Sequence</label>
                                    <input type="number" name="priority" class="form-control" placeholder="Priority"
                                           required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <br>
                                <button class="btn btn-success" type="submit">+ Add New Tag</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <span class="content-header-title">Product Tag List</span>
                    <table class="table table-bordered dataTable">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Title</th>
                            <th>Order Sequence</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ ucwords($tag->title) }}</td>
                                <td>{{ ucwords($tag->priority) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <form action="{{route('product-tags.destroy', $tag->id)}}" id="del"
                                              method="post">
                                            @csrf @method('delete')
                                            <button class="btn btn-sm btn-outline-danger" title="Delete" type="submit">
                                                <i class="la la-remove"></i>
                                            </button>
                                        </form>
                                    </div>
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
        $('form').submit(function () {
            let confirmation  = confirm('Are you sure to delete this tag?');
            return confirmation;
        });

        $('.dataTable').dataTable();
    </script>
@endpush
