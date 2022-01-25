@extends('layouts.admin')
@section('title', ucwords($page) . " SMS Language Config")
@section('card_name', ucwords($page) . " SMS Language Config")
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ucwords($page)}} SMS Language Config</li>
@endsection
@section('content')

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">
                SMS Language {{ucwords($page)}} Form
            </h1>
        </div>

        <!-- /.card-header -->
        <div class="card-body">
            @if($page === 'edit')
                <form action="{{ route('sms-languages.update', $smsLanguage->id) }}" method="post" class="form" enctype="multipart/form-data">
                    @method('put')
                    @else
                        <form action="{{ route('sms-languages.store') }}" method="post" class="form" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                        <div class="form-group">
                                            <label for="feature" class="required">Feature: </label>
                                            <select class="form-control" name="feature" id="feature" required>
                                                @foreach($features as $key => $feature)
                                                    <option value="{{$key}}" {{($page === 'edit' && $key === $smsLanguage->feature) ? 'selected' : ''}}>
                                                        {{$feature}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="help-block">
                                                @if ($errors->has('feature'))
                                                    <span class="invalid-feedback">{{ $errors->first('feature') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="platform" class="required">Platform:</label>
                                            <select class="form-control" name="platform" id="platform" required>
                                                @foreach($platforms as $key => $platform)
                                                    <option
                                                        value="{{$key}}" {{($page === 'edit' && $key === $smsLanguage->platform) ? 'selected' : ''}}>
                                                        {{$platform}}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <div class="help-block">
                                                @if ($errors->has('platform'))
                                                    <span class="invalid-feedback">{{ $errors->first('platform') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="concat_char" class="required">
                                            Concat Char:
                                            <i style="cursor: pointer" class="la la-question-circle text-bold-600" title="concatenate dynamic values when concat char is found in the SMS Body"></i>
                                        </label>
                                        <input name="concat_char" id="concat_char" required value="{{($page === 'edit') ? $smsLanguage->concat_char : old('concat_char')}}" class="form-control" maxlength="1">

                                        <div class="help-block">
                                            @if ($errors->has('concat_char'))
                                                <span class="invalid-feedback">{{ $errors->first('concat_char')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="sms_bn" class="required">SMS BN</label>
                                        <textarea required type="text" name="sms_bn" class="form-control" id="sms_bn"
                                                  placeholder="SMS in Bangla">{{($page === 'edit') ? $smsLanguage->sms_bn : old('sms_bn')}}</textarea>
                                        <div class="help-block">
                                            @if ($errors->has('sms_bn'))
                                                <span class="invalid-feedback">{{ $errors->first('sms_bn') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="code" class="required">SMS EN</label>
                                        <textarea required type="text" name="sms_en" class="form-control"
                                                  placeholder="SMS in English">{{($page === 'edit') ? $smsLanguage->sms_en : old('sms_en')}}</textarea>
                                        <div class="help-block">
                                            @if ($errors->has('sms_en'))
                                                <span class="invalid-feedback">{{ $errors->first('sms_en') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="code" class="required">Status</label>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="status-active">Active</label>
                                                <input type="radio" name="status" value="1" id="status-active"
                                                       class="radio-inline" {{($page === 'edit' && $smsLanguage->status) ? 'checked' : ''}}>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="status-draft">Draft</label>
                                                <input type="radio" name="status" value="0" id="status-draft"
                                                       class="radio-inline" {{($page === 'edit' && !$smsLanguage->status) ? 'checked' : ''}}>
                                            </div>
                                        </div>
                                        <div class="help-block">
                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback">{{ $errors->first('status') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="form-actions">
                                <div class="col-md-4">
                                    <button type="submit" id="submitForm" class="btn btn-success">
                                        {{ucwords($page)}} Config
                                    </button>
                                </div>
                            </div>
                        </form>

        </div>
    </div>


@endsection

@section('content_right_side_bar')
    <h1>
        List
    </h1>
@endsection
