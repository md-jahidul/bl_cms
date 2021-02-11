@extends('layouts.admin')
@section('title', 'Product Tags')
@section('card_name', 'Product Tags')

@section('content')
    <section>
        <div class="card">

            <!-- Card for add time slot -->
            <div class="card-content collapse show">
                <div class="card-body">
                    <form class="form" action="{{route('product-tags.update', $tag->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="control-label">Tag Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Tag Title"
                                           value="{{$tag->title}}" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="priority" class="control-label">Order Sequence</label>
                                    <input type="number" name="priority" class="form-control" placeholder="Priority"
                                           value="{{$tag->priority}}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <br>
                                <button class="btn btn-success" type="submit"><i class="ft-edit"></i> Update Tag</button>
                                <a class="btn btn-info" href="{{route('product-tags.index')}}">
                                    <i class="ft-list"></i> Back To List
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@push('page-js')
    <script>
        $('.delete-form').submit(function () {
            let confirmation = confirm('Are you sure to delete this tag?');
            return confirmation;
        });

        $('.dataTable').dataTable();
    </script>
@endpush
