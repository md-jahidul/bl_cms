@extends('layouts.admin')
@section('title', 'USIM Eligibility Massage')
@section('card_name', 'USIM Eligibility Massage')

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
                        <form role="form" action="{{ route('usim-eligibility.save.massage') }}"
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="dsce_en" class="required">4G USIM Prepaid En</label>
                                    <textarea class="form-control" name="four_g_usim_prepaid[title_en]" required>{{ ($eligibilityMassage) ? $eligibilityMassage->four_g_usim_prepaid->title_en : null }}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="dsce_bn" class="required">4G USIM Prepaid Bn</label>
                                    <textarea class="form-control" name="four_g_usim_prepaid[title_bn]" required>{{ ($eligibilityMassage) ? $eligibilityMassage->four_g_usim_prepaid->title_bn : null }}</textarea>
                                </div>
                                <input type="hidden" name="four_g_usim_prepaid[button_en]" value="Close">
                                <input type="hidden" name="four_g_usim_prepaid[button_bn]" value="বন্ধ">

                                <div class="form-group col-md-6">
                                    <label for="dsce_en" class="required">4G USIM Postpaid En</label>
                                    <textarea class="form-control" name="four_g_usim_postpaid[title_en]" required>{{ ($eligibilityMassage) ? $eligibilityMassage->four_g_usim_postpaid->title_en : null }}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="dsce_bn" class="required">4G USIM Postpaid Bn</label>
                                    <textarea class="form-control" name="four_g_usim_postpaid[title_bn]" required>{{ ($eligibilityMassage) ? $eligibilityMassage->four_g_usim_postpaid->title_bn : null }}</textarea>
                                </div>
                                <input type="hidden" name="four_g_usim_postpaid[button_en]" value="Close">
                                <input type="hidden" name="four_g_usim_postpaid[button_bn]" value="বন্ধ">

                                <div class="form-group col-md-6">
                                    <label for="dsce_en" class="required">Prepaid Non Eligible En</label>
                                    <textarea class="form-control" name="prepaid_non_eligible[title_en]" required>{{ ($eligibilityMassage) ? $eligibilityMassage->prepaid_non_eligible->title_en : null }}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="dsce_bn" class="required">Prepaid Non Eligible Bn</label>
                                    <textarea class="form-control" name="prepaid_non_eligible[title_bn]" required>{{ ($eligibilityMassage) ? $eligibilityMassage->prepaid_non_eligible->title_bn : null }}</textarea>
                                </div>
                                <input type="hidden" name="prepaid_non_eligible[button_en]" value="Close">
                                <input type="hidden" name="prepaid_non_eligible[button_bn]" value="বন্ধ">


                                <div class="form-group col-md-6">
                                    <label for="dsce_en" class="required">Postpaid Non Eligible En</label>
                                    <textarea class="form-control" name="postpaid_non_eligible[title_en]" required>{{ ($eligibilityMassage) ? $eligibilityMassage->postpaid_non_eligible->title_en : null }}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="dsce_bn" class="required">Postpaid Non Eligible Bn</label>
                                    <textarea class="form-control" name="postpaid_non_eligible[title_bn]" required>{{ ($eligibilityMassage) ? $eligibilityMassage->postpaid_non_eligible->title_bn : null }}</textarea>
                                </div>
                                <input type="hidden" name="postpaid_non_eligible[button_en]" value="Close">
                                <input type="hidden" name="postpaid_non_eligible[button_bn]" value="বন্ধ">


                                <div class="form-group col-md-6">
                                    <label for="dsce_en" class="required">Non 4G Prepaid En</label>
                                    <textarea class="form-control" name="non_4g_prepaid[title_en]" required>{{ ($eligibilityMassage) ? $eligibilityMassage->non_4g_prepaid->title_en : null }}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="dsce_bn" class="required">Non 4G Prepaid Bn</label>
                                    <textarea class="form-control" name="non_4g_prepaid[title_bn]" required>{{ ($eligibilityMassage) ? $eligibilityMassage->non_4g_prepaid->title_bn : null }}</textarea>
                                </div>
                                <input type="hidden" name="non_4g_prepaid[button_en]" value="Close">
                                <input type="hidden" name="non_4g_prepaid[button_bn]" value="বন্ধ">

                                <div class="form-group col-md-6">
                                    <label for="dsce_en" class="required">Non 4G Postpaid En</label>
                                    <textarea class="form-control" name="non_4g_postpaid[title_en]" required>{{ ($eligibilityMassage) ? $eligibilityMassage->non_4g_prepaid->title_en : null }}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="dsce_bn" class="required">Non 4G Postpaid Bn</label>
                                    <textarea class="form-control" name="non_4g_postpaid[title_bn]" required>{{ ($eligibilityMassage) ? $eligibilityMassage->non_4g_prepaid->title_bn : null }}</textarea>
                                </div>
                                <input type="hidden" name="non_4g_postpaid[button_en]" value="Close">
                                <input type="hidden" name="non_4g_postpaid[button_bn]" value="বন্ধ">

                                <div class="form-actions col-md-12">
                                    <button type="submit" class="btn btn-success round px-2 float-right">
                                        <i class="la la-check-square-o"></i>Save
                                    </button>
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
            // $(".summernote_editor").summernote({
            //     toolbar: [
            //         ['style', ['bold', 'italic', 'underline', 'clear']],
            //         ['font', ['strikethrough', 'superscript', 'subscript']],
            //         ['fontsize', ['fontsize']],
            //         ['color', ['color']],
            //         ['table', ['table']],
            //         ['para', ['ul', 'ol', 'paragraph']],
            //         ['view', ['fullscreen', 'codeview']]
            //     ],
            //     height:100
            // })
        })
    </script>
@endpush






