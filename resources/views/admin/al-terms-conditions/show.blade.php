@extends('layouts.admin')
@section('title', 'Terms and Conditions')
@section('card_name', ucwords(str_replace('_', ' ', $featureName)) . ' Terms and Conditions')

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        @if ($errors->has('terms_conditions'))
                            <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                Terms and Conditions Field is required. You cannot set blank.
                            </div>
                        @endif
                        <form role="form" action="{{ route('al-terms-conditions.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="content-header-right col-md-12">
                                    <div class="dropdown float-md-right">
                                        <button type="submit" class="btn btn-primary btn-sm pull-right">
                                            @if($terms_conditions)
                                                Update
                                            @else
                                                Save
                                            @endif
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="title_en" class="required">
                                        {{ucwords(str_replace('_', ' ', $featureName))}} Terms and Conditions
                                    </label>
                                    <input type="hidden" name="feature_name" value="{{$featureName}}">
                                    <textarea id="terms-conditions" name="terms_conditions" required class="summernote_editor">
                                        @if($terms_conditions)
                                            {{ $terms_conditions->terms_conditions }}
                                        @endif
                                    </textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="title_en" class="required">Terms and Conditions (Bangla)</label>
                                    <textarea id="terms-conditions" name="terms_conditions_bn" required class="summernote_editor">
                                        @if($terms_conditions)
                                            {{ $terms_conditions->terms_conditions_bn }}
                                        @endif
                                    </textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')

@endpush
@push('page-js')

@endpush