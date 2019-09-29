@extends('layouts.admin')
@section('title', 'Slider Edit')
@section('card_name', 'Slider Edit')
@section('breadcrumb')
    <li class="breadcrumb-item active"> {{$slider->title_en}}</li>
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
                        <form role="form" action="{{ url("sliders/$slider->id/update") }}" method="POST" novalidate>
                            @csrf
                            {{method_field('PUT')}}
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title"
                                           value="{{ $slider->title_en }}" required data-validation-required-message="Enter slider title" readonly>
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                @include('layouts.partials.slider-other-attr.' . $type )


                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> SAVE
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $slider->id }}"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop




