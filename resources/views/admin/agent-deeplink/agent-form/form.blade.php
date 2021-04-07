<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('name') ? ' error' : '' }}">
        <label for="name" class="required">Name</label>
        <input type="text" name="name"  class="form-control" placeholder="Enter agent name"
               value="{{ old("name") ? old("name") : '' }}" required data-validation-required-message="Enter agent name">
        <div class="help-block"></div>
        @if ($errors->has('name'))
            <div class="help-block">  {{ $errors->first('name') }}</div>
        @endif
    </div>

    <div class="form-group col-md-6 {{ $errors->has('email') ? ' error' : '' }}">
        <label for="email" class="required">Email address</label>
        <input type="email" name="email"  class="form-control" placeholder="Enter email address"
               value="{{ old("email") ? old("email") : '' }}" required data-validation-required-message="Enter email address">
        <div class="help-block"></div>
        @if ($errors->has('email'))
            <div class="help-block">  {{ $errors->first('email') }}</div>
        @endif
    </div>

    <div class="form-group select-role col-md-6 mb-0 {{ $errors->has('msisdn') ? ' error' : '' }}">

        <label for="msisdn" class="required">Phone number</label>
        <input type="number" name="msisdn"  class="form-control" placeholder="Enter Phone number"
               value="{{ old("msisdn") ? old("msisdn") : '' }}" required data-validation-required-message="Enter Phone number">
        <div class="help-block"></div>
        @if ($errors->has('msisdn'))
            <div class="help-block">  {{ $errors->first('msisdn') }}</div>
        @endif

    </div>
    <div class="form-group col-md-6 {{ $errors->has('address') ? ' error' : '' }}">
        <label for="password">Address</label>
        <input type="text" name="address"  class="form-control" placeholder="Enter address"
               value="{{ old("address") ? old("address") : '' }}">
        <div class="help-block"></div>
        @if ($errors->has('address'))
            <div class="help-block">  {{ $errors->first('address') }}</div>
        @endif
    </div>


    <div class="form-actions col-md-12 ">
        <div class="pull-right">
            <button type="submit" class="btn btn-primary"><i
                    class="la la-check-square-o"></i> SAVE
            </button>
        </div>
    </div>
</div>
@csrf
