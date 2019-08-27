@extends('layouts.admin')
@section('title', 'Slider Create')
@section('card_name', 'Slider Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> Slider Create</li>
@endsection
@section('action')
    <a href="{{ url('sliders') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('sliders.store') }}" method="POST">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                           value="{{ old("title") ? old("title") : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('slider_type_id') ? ' error' : '' }}">
                                    <label class="required">Slider Type</label>
                                    <select class="form-control error" name="slider_type_id">
                                        <option value="">--Select slider type--</option>
                                        @if(isset($sliderTypes))
                                            @foreach($sliderTypes as $slider_type)
                                                <option value="{{ $slider_type->id }}"{{ old('slider_type_id')== $slider_type->id ? 'selected' : ''}}>{{ $slider_type->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('slider_type_id'))
                                        <div class="help-block">  {{ $errors->first('slider_type_id') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label>
                                        <textarea name="description" class="form-control" rows="5"
                                                  placeholder="Enter description"></textarea>
                                    </div>
                                </div>
                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> SAVE
                                        </button>

                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>


                    </form>
                </div>
            </div>
        </div>
    </section>



@stop






