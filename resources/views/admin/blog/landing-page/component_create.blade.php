@extends('layouts.admin')
@section('title_en', 'Landing Page Component')
@section('card_name', 'Landing Page Component')
@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ url('landing-page-component') }}">Component List</a></li>
    <li class="breadcrumb-item active"> Component Create</li>
@endsection
@section('action')
    <a href="{{ url('landing-page-component') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('landing-page-component.store') }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('type') ? ' error' : '' }}">
                                    <label for="type" class="required">Component Type</label>
                                    <select class="form-control" name="component_type" id="type"
                                            required data-validation-required-message="Please select type">
                                        <option value="">---Select Type---</option>
                                        <option data-alias="latest_news" value="latest_news">Latest News</option>
                                        <option data-alias="featured_topics" value="featured_topics">Featured Topics</option>
                                        <option data-alias="news_archive" value="news_archive">News Archive</option>
                                    </select>
                                    <div class="help-block"></div>
                                    @if ($errors->has('type'))
                                        <div class="help-block">  {{ $errors->first('type') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('sliding_speed') ? ' error' : '' }}">
                                    <label for="sliding_speed" class="">Sliding Speed</label>
                                    <input type="number" id="sliding_speed" name="sliding_speed" class="form-control" placeholder="Enter alt text"
                                           value="{{ old("sliding_speed") ? old("sliding_speed") : '' }}">
                                    <span>Default 10 second</span>
                                    <div class="help-block"></div>
                                    @if ($errors->has('sliding_speed'))
                                        <div class="help-block">  {{ $errors->first('sliding_speed') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title English</label>
                                    <input type="text" name="title_en"  class="form-control" placeholder="Enter title in English"
                                           value="{{ old("title_en") ? old("title_en") : '' }}" required data-validation-required-message="Enter title in English">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title Bangla</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title in Bangla"
                                           value="{{ old("title_bn") ? old("title_bn") : '' }}" required data-validation-required-message="Enter title in Bangla">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Short Description En</label>
                                    <textarea name="short_desc_en" class="form-control" rows="4">{{ old("short_desc_en") ? old("short_desc_en") : '' }}</textarea>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Short Description En</label>
                                    <textarea name="short_desc_bn" class="form-control" rows="4">{{ old("short_desc_bn") ? old("short_desc_bn") : '' }}</textarea>
                                </div>

                                <div class="form-group select-role col-md-6 {{ $errors->has('role_id') ? ' error' : '' }} slider-section">
                                    <label for="role_id">Select Post For Sliding</label>
                                    <div class="role-select">
                                        <select class="select2 form-control" multiple="multiple" id="multi_items" name="slider_items[]">
                                            @foreach($blogPosts as  $post)
                                                <option value="{{ $post->id }}">{{ $post->title_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('role_id'))
                                        <div class="help-block">  {{ $errors->first('role_id') }}</div>
                                    @endif
                                </div>

                                <div class="form-group select-role col-md-6 {{ $errors->has('role_id') ? ' error' : '' }}">
                                    <label for="role_id">Select Post For Card</label>
                                    <div class="role-select">
                                        <select class="select2 form-control" multiple="multiple" id="multi_items" name="items[]">
                                            @foreach($blogPosts as  $post)
                                                <option value="{{ $post->id }}">{{ $post->title_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('role_id'))
                                        <div class="help-block">  {{ $errors->first('role_id') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Page Header</label>
                                    <textarea name="page_header" class="form-control" rows="4">
                                        {{ old("page_header") ? old("page_header") : '' }}
                                    </textarea>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Page Header BN</label>
                                    <textarea name="page_header_bn" class="form-control" rows="4">
                                        {{ old("page_header_bn") ? old("page_header_bn") : '' }}
                                    </textarea>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Schema Markup</label>
                                    <textarea name="schema_markup" class="form-control" rows="4">
                                        {{ old("schema_markup") ? old("schema_markup") : '' }}
                                    </textarea>
                                </div>

                                <div class="col-md-6 mt-1">
                                    <label></label>
                                    <div class="form-group">
                                        <label for="title" class="mr-1">Status:</label>
                                        <input type="radio" name="status" value="1" id="active" checked>
                                        <label for="active" class="mr-1">Active</label>

                                        <input type="radio" name="status" value="0" id="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
                                </div>

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> SAVE
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop
<style>
    form .select-role.validate input:focus, form .select-role.issue input:focus, form .select-role.validate input{
        border-color: unset;
        -webkit-box-shadow: unset;
        -moz-box-shadow: unset;
        box-shadow: unset;
        border-width: 0;
        color : unset;
    }
</style>

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#type').change(function () {
                if($(this).val() === "news_archive") {
                    $(".slider-section").hide()
                } else {
                    $(".slider-section").show()
                }
            })
        });
    </script>
@endpush






