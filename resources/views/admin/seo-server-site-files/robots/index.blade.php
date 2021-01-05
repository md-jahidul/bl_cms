@extends('layouts.admin')
@section('title', 'Robot Txt')
@section('card_name', 'Robots Txt File Info')

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <h4 class="pb-1"><strong>Robots Txt</strong></h4>
                        <form method="POST" action="{{ url('robot-txt/update-or-create') }}" class="form" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('txt') ? ' error' : '' }}">
                                    <textarea class="form-control" rows="20" name="txt" required>{{ isset($robotsTxt->txt) ? $robotsTxt->txt : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('txt'))
                                        <div class="help-block">  {{ $errors->first('txt') }}</div>
                                    @endif
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('style')
    <style>
        .form-group.validate input, .form-group.validate select, .form-group.validate textarea {
            color: black;
            border-color: #d09828;
        }

    </style>

@endpush
@push('page-js')
<script>
    $(function () {

    });
</script>
@endpush




