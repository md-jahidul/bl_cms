@extends('layouts.master-layout')

@section('main-content')
    <section class="content mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{--<div class="col-md-12">--}}
                        <h3 class="card-title float-left">Slider List</h3>
                        <a href="{{ url('sliders/create') }}" class="btn btn-success float-right">Add Slider</a>
                        {{--</div>--}}

                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Title</th>
                                <th>Slider Type</th>
                                <th>Description</th>
                                <th width="10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->sliderType->name }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>
                                        <a href="{{ url('sliders/'.$slider->id.'/edit') }}" class="mr-3">
                                            <button><i class="fas fa-edit text-primary"></i></button>
                                        </a>
                                        <form action="{{ url('/sliders', ['id' => $slider->id]) }}" method="post">
                                            <button onclick="return confirm('Are you sure, you want to delete it?')"><i
                                                        class="fas fa-trash text-danger"></i></button>
                                            @method('delete')
                                            @csrf
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@stop