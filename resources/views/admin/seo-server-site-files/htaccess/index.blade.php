@extends('layouts.admin')
@section('title', 'Htaccess File')
@section('card_name', 'Htaccess File Info')

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <h4 class="pb-1"><strong>Htaccess File Data</strong></h4>
                        <span class="text-danger"> Note: Input only 301, and 302 redirection data</span>
                        <form method="POST" action="{{ url('htaccess/update-or-create') }}" class="form" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('data') ? ' error' : '' }}">
                                    <textarea class="form-control" rows="20" name="data" required>{{ isset($robotsTxt->data) ? $robotsTxt->data : '' }}</textarea>
                                    <div class="help-block"></div>
                                    @if ($errors->has('data'))
                                        <div class="help-block">  {{ $errors->first('data') }}</div>
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




