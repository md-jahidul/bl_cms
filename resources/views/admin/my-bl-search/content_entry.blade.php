@extends('layouts.admin')
@section('title', 'MyBl Search Content')
@section('card_name', 'MyBl Search Content')
@section('action')
    <a href="{{ route('mybl-search-content.index') }}" class="btn btn-info btn-sm btn-glow px-2">
        Back to List
    </a>
@endsection
@section('content')
    <section id="bottom-border">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form id="content-search-form"
                                action="{{ route('mybl-search-content.store') }}"
                                method="post" >
                                {{csrf_field()}}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="search_content">Search Content <span class="danger">*</span></label>
                                                        <div class="edit-on-delete form-control" id="search-content"></div>
                                                        <small class="info">Press Enter or Comma to create a new search tag, Backspace or Delete to remove the last one.</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="display_title">Display Title <span class="danger">*</span></label>
                                                        <input type="text" id="display_title" name="display_title" class="form-control"required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="connection_type">Connection Type <span class="danger">*</span></label>
                                                        <select name="connection_type" class="browser-default custom-select"
                                                                id="connection_type" required >
                                                            <option value="all">ALL</option>
                                                            <option value="prepaid">PREPAID</option>
                                                            <option value="postpaid">POSTPAID</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @php
                                                        $actionList = Helper::navigationActionList();
                                                    @endphp
                                                    <div class="form-group">
                                                        <label for="display_title">Navigate Action <span class="danger">*</span></label>
                                                        <select name="navigation_action" class="browser-default custom-select"
                                                                id="navigate_action" required>
                                                            <option value="">Select Action</option>
                                                            @foreach ($actionList as $key => $value)
                                                                <option
                                                                    value="{{ $key }}">
                                                                    {{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="append_div" class="col-md-6">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea
                                                        type="text"
                                                        id="description"
                                                        class="form-control"
                                                        rows="8"
                                                        spellcheck="true"
                                                        placeholder="e.g. Profile"
                                                        name="description">
                                                </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="deeplink">Deeplink</label>
                                                <input type="text" id="deeplink" name="deeplink" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="col-md-2 pull-right">
                                        <button type="submit" class="btn btn-block btn-primary mb-1">ADD
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <link rel="stylesheet" href="{{asset('app-assets/vendors/css/forms/tags/tagging.css')}}">
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
@endpush

@push('page-js')
   <script src="{{asset('app-assets')}}/vendors/js/forms/tags/tagging.min.js" type="text/javascript"></script>
   <script src="{{asset('app-assets')}}/js/scripts/forms/tags/tagging.js" type="text/javascript"></script>
   <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>

    <script>
        $(function () {
            // add dial number
            let dial_html = ` <div class="form-group other-info-div">
                                        <label>Dial Number <span class="danger">*</span></label>
                                        <input type="text" name="other_info" class="form-control"  placeholder="Enter Valid Number" required>
                                        <div class="help-block"></div>
                                    </div>`;

           let url_html = ` <div class="form-group other-info-div">
                                        <label>Redirect External URL <span class="danger">*</span></label>
                                        <input type="text" name="other_info" class="form-control"  placeholder="Enter Valid URL" required>
                                        <div class="help-block"></div>
                                    </div>`;


            $('#navigate_action').on('change', function () {
                let action = $(this).val();
                if (action == 'DIAL') {
                    $("#append_div").html(dial_html);
                } else if (action == 'URL') {
                    $("#append_div").html(url_html);
                } else {
                    $(".other-info-div").remove();
                }
            });

            $('#content-search-form').submit(function (event) {
                let tags = [];
                event.preventDefault();
                $("input[name='tag[]']").each(function () {
                    let value = $(this).val();
                    if (value) {
                        tags.push(value);
                    }
                });

                if (tags.length === 0) {
                    swal.fire({
                        title: 'Search Content cannot be empty',
                        type: 'error',
                    });
                }else{
                    $(this).unbind('submit').submit();
                }
            });
        });
    </script>

@endpush
