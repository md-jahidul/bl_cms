<div class="form-group col-md-6 {{ $errors->has('start_date') ? ' error' : '' }}">
    <label for="start_date">Start Date</label>
    <div class='input-group'>
        <input type='text' class="form-control" name="start_date" id="start_date"
               value="{{ old("start_date") ? old("start_date") : '' }}"
               placeholder="Please select start date" />
    </div>
    <div class="help-block"></div>
    @if ($errors->has('start_date'))
        <div class="help-block">{{ $errors->first('start_date') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('end_date') ? ' error' : '' }}">
    <label for="end_date">End Date</label>
    <input type="text" name="end_date" id="end_date" class="form-control"
           placeholder="Please select end date"
           value="{{ old("end_date") ? old("end_date") : '' }}" autocomplete="0">
    <div class="help-block"></div>
    @if ($errors->has('end_date'))
        <div class="help-block">{{ $errors->first('end_date') }}</div>
    @endif
</div>
