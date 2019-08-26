@extends('layouts.admin')
@section('card_name', 'Slider List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Slider List
    </li>
@endsection
@section('action')
    <a href="{{ url('sliders/create') }}" class="btn btn-primary  round btn-glow px-2">Add Slider</a>
@endsection
@section('content')

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

@stop