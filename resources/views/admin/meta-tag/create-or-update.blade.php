<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h5 class="menu-title"><strong>SEO Meta Tag Info</strong></h5><hr>
                <div class="card-body card-dashboard">
                    <form role="form" action="{{ isset($metaTag) ? route('meta-tag.update', $metaTag->id) : route('meta-tag.store') }}"
                          method="POST" novalidate enctype="multipart/form-data">
                        @csrf
                        @if (isset($metaTag))
                            {{method_field('PUT')}}
                        @else
                            {{method_field('POST')}}
                        @endif

                        <div class="row">
                            <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                <label for="title" class="required">Title (English)</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title"
                                       value="{{ old("title") ? old("title") : $metaTag->title ?? null }}">
                                <div class="help-block"></div>
                                @if ($errors->has('title'))
                                    <div class="help-block">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            @if(!isset($action['dynamic_route_key']))
                                <div class="form-group col-md-6 {{ $errors->has('dynamic_route_key') ? ' error' : '' }}">
                                    <label class="required"> Key</label>
                                    <input type="text" class="form-control slug-convert required" name="dynamic_route_key" placeholder="Key" value="{{ old("dynamic_route_key") ? old("dynamic_route_key") : $metaTag->dynamic_route_key ?? null }}">
                                    <small class="text-info">
                                        <strong>i.e:</strong> page-name (no spaces)<br>
                                    </small>
                                    @if ($errors->has('dynamic_route_key'))
                                        <div class="help-block text-danger">
                                            {{ $errors->first('dynamic_route_key') }}
                                        </div>
                                    @endif
                                </div>
                            @else
                                {{ Form::hidden('dynamic_route_key', $action['dynamic_route_key'] ) }}
                                {{ Form::hidden('redirect_to', $action['redirect_to'] ) }}
                            @endif
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4 ">
                                <label for="page_header">Page Header (HTML)</label>
                                <textarea type="text" name="page_header" rows="7" class="form-control">{{ old("page_header") ? old("page_header") : $metaTag->page_header ?? null }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 ">
                                <label for="page_header_bn">Page Header Bangla (HTML)</label>
                                <textarea type="text" name="page_header_bn" rows="7" class="form-control">{{ old("page_header_bn") ? old("page_header_bn") : $metaTag->page_header_bn ?? null }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> Title, meta, canonical and other tags
                                </small>
                            </div>

                            <div class="form-group col-md-4 ">
                                <label for="schema_markup">Schema Markup</label>
                                <textarea type="text" name="schema_markup" rows="7" class="form-control">{{ old("schema_markup") ? old("schema_markup") : $metaTag->schema_markup ?? null }}</textarea>
                                <small class="text-info">
                                    <strong>Note: </strong> JSON-LD (Recommended by Google)
                                </small>
                            </div>

                            <div class="form-actions col-md-12">
                                <div class="pull-right">
                                    <button id="save" class="btn btn-primary"><i
                                            class="la la-check-square-o"></i> Save
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

