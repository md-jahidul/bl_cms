@extends('layouts.admin')
@section('title', 'Privacy and Policy')
@section('card_name', 'Privacy and Policy')

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
                                Privacy and Policy Field is required. You cannot set blank.
                            </div>
                        @endif
                        <form role="form" action="{{ route('privacy-policy.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="content-header-right col-md-12">
                                    <div class="dropdown float-md-right">
                                        <button type="submit" class="btn btn-primary btn-sm pull-right">
                                            @if($privacy_policy)
                                                Update
                                            @else
                                                Save
                                            @endif
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="title_en" class="required">Privacy and Policy (English)</label>
                                    <textarea id="privacy-policy" name="privacy_policy" required>
                                        @if($privacy_policy)
                                            {{ $privacy_policy->privacy_policy }}
                                        @endif
                                    </textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="title_en" class="required">Privacy and Policy (Bangla)</label>
                                    <textarea id="privacy-policy" name="privacy_policy_bn" required>
                                        @if($privacy_policy)
                                            {{ $privacy_policy->privacy_policy_bn }}
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
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('app-assets/vendors/js/editors/summernote/summernote.js') }}" type="text/javascript"></script>
    <script>
        $(function () {
            $("textarea#privacy-policy").summernote({
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['table', ['table']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']]
                ],
                height:300
            })
        })
    </script>
@endpush






