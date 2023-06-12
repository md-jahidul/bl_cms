@extends('layouts.admin')
@section('title', 'Edit Match')
@section('card_name', 'Edit Match')
@section('breadcrumb')
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form"
                              action="{{ route('matches.update', $match->id) }}"
                              method="POST"
                              class="form"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="home_team_id" class="required">
                                            Home Team Name :
                                        </label>
                                        <div class="controls">
                                            <select name="home_team_id" id="home_team_id" required class="form-control @error('home_team_id') is-invalid @enderror">
                                                <option value="">Select Home Team</option>
                                                @foreach ($teams as $team)
                                                    <option value="{{$team->id}}" {{ $team->id == $match->home_team_id ? 'selected' : ""}}>{{$team->team_name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                            <small class="text-danger"> @error('home_team_id') {{ $message }} @enderror </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="away_team_id" class="required">
                                            Away Team Name :
                                        </label>
                                        <div class="controls">
                                            <select name="away_team_id" id="away_team_id" required class="form-control @error('away_team_id') is-invalid @enderror">
                                                <option value="">Select Away Team</option>
                                                @foreach ($teams as $team)
                                                    <option value="{{$team->id}}" {{ $team->id == $match->away_team_id ? 'selected' : ""}}>{{$team->team_name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="help-block"></div>
                                            <small class="text-danger"> @error('away_team_id') {{ $message }} @enderror </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('start_time') ? ' error' : '' }}">
                                    <label for="start_time">Match Start Time</label>
                                    <div class='input-group'>
                                        <input type='text' class="form-control" name="start_time" id="start_time"
                                               placeholder="Please Enter Match Start Time"
                                               value="{{ isset($match) ? $match->start_time : old('start_time') }}"
                                               autocomplete="off" required/>
                                    </div>
                                    <div class="help-block"></div>
                                    @if ($errors->has('start_time'))
                                        <div class="help-block">{{ $errors->first('start_time') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="url" class="required">Ticketing Time(Hour)</label>
                                    <input class="form-control"
                                           type="number"
                                           name="ticketing_time"
                                           id="ticketing_time"
                                           placeholder="Enter Ticketing Time"
                                           value="{{ $match->ticketing_time }}"
                                           required>
                                    @if($errors->has('ticketing_time'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('ticketing_time') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="signed_cookie" class="required">Signed Cookie</label>
                                    <input class="form-control"
                                           name="signed_cookie"
                                           id="signed_cookie"
                                           placeholder="Enter Signed Cookie"
                                           value="{{ $match->signed_cookie }}"
                                           readonly
                                    >
                                    @if($errors->has('signed_cookie'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('signed_cookie') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="url" class="required">URL</label>
                                    <input class="form-control"
                                           name="url"
                                           id="url"
                                           placeholder="Enter URL"
                                           value="{{ $match->url }}"
                                           required>
                                    @if($errors->has('url'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('url') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="url" class="required">Number Of Sets</label>
                                    <input class="form-control"
                                           type="number"
                                           name="number_of_seats"
                                           id="number_of_seats"
                                           placeholder="Enter Seats Count"
                                           value="{{ $match->number_of_seats }}"
                                           required>
                                    @if($errors->has('number_of_seats'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('number_of_seats') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="eventInput3">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1" {{ $match->status == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $match->status == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 icheck_minimal skin mt-2">
                                    <fieldset>
                                        <input type="checkbox" id="is_hidden" value="1" name="is_hidden"  @if($match->is_hidden) checked @endif>
                                        <label for="is_hidden">Is Hidden</label>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success mt-2">
                                    <i class="ft-save"></i> Update
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/js/pickers/dateTime/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/forms/selects/select2.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/summernote.css') }}">
@endpush

@push('page-js')
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('theme/vendors/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $(".product-list").select2()
            $('.report-repeater').repeater();

            let startTime = $('#start_time');

            function dateTime(element){
                var date = new Date();
                date.setDate(date.getDate());
                element.datetimepicker({
                    format : 'YYYY-MM-DD HH:mm:ss',
                    showClose: true,
                });
            }

            dateTime(startTime)
        });
    </script>
@endpush
