@extends('layouts.admin')
@section('title', 'Terms and Conditions')
@section('card_name', 'Terms and Conditions')

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
                        <form role="form" action="{{ route('terms-conditions.store') }}" method="POST">
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
                                <div class="col-md-12">
                                    <label for="title_en" class="required">Terms and Conditions</label>
                                    <textarea id="terms-conditions" name="terms_conditions" required>
                                        @if($terms_conditions)
                                            {{ $terms_conditions->terms_conditions }}
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
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        $(function () {
            tinymce.init({
                selector: 'textarea#terms-conditions',
                branding: false,
                menubar: false,
                height: 400,
                statusbar: false,
                plugins : 'advlist lists'
            });
        })
    </script>
@endpush






