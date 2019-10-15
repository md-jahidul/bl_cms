@extends('layouts.admin')
@section('title', 'Terms and Conditions')
@section('card_name', 'Terms and Conditions')

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('terms-conditions.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="title_en" class="required">Terms and Conditions</label>
                                    <textarea id="terms-conditions" name="terms_conditions">
                                        @if($terms_conditions)
                                            {{ $terms_conditions->terms_conditions }}
                                        @endif
                                    </textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm pull-right">
                                @if($terms_conditions)
                                    Update
                                @else
                                    Save
                                @endif
                            </button>
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
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        $(function () {
            tinymce.init({
                selector: 'textarea#terms-conditions',
                width: 1000,
                height: 200
            });
        })
    </script>
@endpush






