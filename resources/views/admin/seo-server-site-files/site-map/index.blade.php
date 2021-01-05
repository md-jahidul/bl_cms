@extends('layouts.admin')
@section('title', 'Site Map')
@section('card_name', 'Site Map File Info')

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <h4 class="pb-1"><strong>Site Map</strong></h4>
                        <form method="POST" action="{{ url('site-map/update-or-create') }}" class="form" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('txt') ? ' error' : '' }}">
                                    <label>URL Set</label>
                                    <input class="form-control" name="url_set" value="{{ isset($parentTag->url_set) ? $parentTag->url_set : '' }}">
                                    <div class="help-block"></div>
                                    @if ($errors->has('txt'))
                                        <div class="help-block">  {{ $errors->first('txt') }}</div>
                                    @endif
                                </div>

                                @if(!$subTags->isEmpty())
                                    @foreach($subTags as $key => $subTag)
                                    <slot id="inputFormRow">
                                            <div class="form-group col-md-4 {{ $errors->has('loc') ? ' error' : '' }}">
                                                <label>Loc</label>
                                                <input class="form-control" name="loc[]" value="{{ isset($subTag->loc) ? $subTag->loc : '' }}">
                                                <div class="help-block"></div>
                                                @if ($errors->has('change_freq'))
                                                    <div class="help-block">  {{ $errors->first('change_freq') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ $errors->has('change_freq') ? ' error' : '' }}">
                                                <label>ChangeFreq</label>
                                                <input class="form-control" name="change_freq[]" value="{{ isset($subTag->change_freq) ? $subTag->change_freq : '' }}">
                                                <div class="help-block"></div>
                                                @if ($errors->has('txt'))
                                                    <div class="help-block">  {{ $errors->first('txt') }}</div>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-3 {{ $errors->has('txt') ? ' error' : '' }}">
                                                <label>Priority</label>
                                                <input class="form-control" name="priority[]" value="{{ isset($subTag->priority) ? $subTag->priority : '' }}">
                                                <div class="help-block"></div>
                                                @if ($errors->has('txt'))
                                                    <div class="help-block">  {{ $errors->first('txt') }}</div>
                                                @endif
                                            </div>

                                        @if($key == 0)
                                            <div class="form-group col-md-1 {{ $errors->has('txt') ? ' error' : '' }}">
                                                <button class="btn-sm btn-outline-success mt-2 cursor-pointer" type="button" id="addRow">
                                                    <i class="la la-plus"></i>
                                                </button>
                                            </div>
                                            @else
                                                <div class="form-group col-md-1">
                                                    <button class="btn-sm btn-outline-danger mt-2 cursor-pointer" type="button" id="removeRow">
                                                       <i class="la la-trash"></i>
                                                    </button>
                                                </div>
                                        @endif
                                    </slot>
                                @endforeach
                                @else
                                    <slot id="inputFormRow">
                                        <div class="form-group col-md-4">
                                            <label>Loc</label>
                                            <input class="form-control" name="loc[]">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>ChangeFreq</label>
                                            <input class="form-control" name="change_freq[]">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Priority</label>
                                            <input class="form-control" name="priority[]">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <button class="btn-sm btn-outline-success mt-2 cursor-pointer" type="button" id="addRow">
                                                <i class="la la-plus"></i>
                                            </button>
                                        </div>
                                    </slot>
                                @endif

                                <slot id="newRow"></slot>

{{--                                <div class="form-group col-md-4 {{ $errors->has('txt') ? ' error' : '' }}">--}}
{{--                                    <label>Loc</label>--}}
{{--                                    <input class="form-control" name="txt" value="{{ isset($robotsTxt->txt) ? $robotsTxt->txt : '' }}">--}}
{{--                                </div>--}}
{{--                                --}}
{{--                                <div class="form-group col-md-4 {{ $errors->has('txt') ? ' error' : '' }}">--}}
{{--                                    <label>ChangeFreq</label>--}}
{{--                                    <input class="form-control" name="txt" value="{{ isset($robotsTxt->txt) ? $robotsTxt->txt : '' }}">--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-3 {{ $errors->has('txt') ? ' error' : '' }}">--}}
{{--                                    <label>Priority</label>--}}
{{--                                    <input class="form-control" name="txt" value="{{ isset($robotsTxt->txt) ? $robotsTxt->txt : '' }}">--}}
{{--                                </div>--}}

{{--                                <div class="form-group col-md-1 {{ $errors->has('txt') ? ' error' : '' }}">--}}
{{--                                    <button class="btn-sm btn-outline-danger mt-2 cursor-pointer" type="button" id="removeRow">--}}
{{--                                        <i class="la la-trash"></i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}


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
    <script type="text/javascript">
        $(function () {
            // add row
            $('#addRow').click(function () {
                var html = '';
                html += '<slot id="inputFormRow">'
                html += '<div class="form-group col-md-4">';
                html += '<label>Loc</label>';
                html += '<input class="form-control" name="loc[]">';
                html += '</div>';

                html +=  '<div class="form-group col-md-4">';
                html +=  '    <label>ChangeFreq</label>'
                html +=  '    <input class="form-control" name="change_freq[]">';
                html +=  '</div>';

                html +=  '<div class="form-group col-md-3">';
                html +=  '   <label>Priority</label>';
                html +=  '   <input class="form-control" name="priority[]">';
                html +=  '</div>';

                html +=  '<div class="form-group col-md-1">';
                html +=  '   <button class="btn-sm btn-outline-danger mt-2 cursor-pointer" type="button" id="removeRow">';
                html +=  '       <i class="la la-trash"></i>';
                html +=  '    </button>';
                html +=  '</div>';
                html += '</slot>'

                $('#newRow').append(html);
            });

            // remove row
            $(document).on('click', '#removeRow', function () {
                $(this).closest('#inputFormRow').remove();
            });
        })
    </script>
@endpush




