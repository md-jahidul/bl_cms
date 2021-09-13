<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
        <label for="name_en" class="required">Title</label>
        <input type="text" name="title" class="form-control"
               placeholder="e.g: Redirection for product dynamic link"
               value="{{ $redirection->title ?? old("title") }}" required
               data-validation-required-message="Title">
        <div class="help-block"></div>
        @if ($errors->has('title'))
            <div class="help-block">{{ $errors->first('title') }}</div>
        @endif
    </div>

    <div class="form-group col-md-3 {{ $errors->has('redirection_for') ? ' error' : '' }}">
        <label for="redirection_for" class="required">Redirection For</label>
        <select class="form-control" name="redirection_for" id="redirection_for">
            @foreach($redirectionForList as $key => $redirectionFor)
                <option
                    value="{{$key}}" {{$page == 'edit' ? ($redirection->redirection_for ===  $key ? 'selected' : '') : '' }}>
                    {{$redirectionFor}}
                </option>
            @endforeach
        </select>
        <div class="help-block"></div>
        @if ($errors->has('redirection_for'))
            <div class="help-block">  {{ $errors->first('redirection_for') }}</div>
        @endif
    </div>

    <div class="form-group col-md-3 {{ $errors->has('identifier') ? ' error' : '' }}">
        <label for="name_bn">
            Identifier
            (<i id="identifier_notation"> </i>)
        </label>
        <input type="text" name="identifier" class="form-control"
               placeholder="Enter Identifier"
               value="{{ $redirection->identifier ?? old("identifier") }}">
        <div class="help-block"></div>
        @if ($errors->has('identifier'))
            <div class="help-block">  {{ $errors->first('identifier') }}</div>
        @endif
    </div>

    <div class="form-group col-md-6 {{ $errors->has('from_url') ? ' error' : '' }}">
        <label for="tag_color" class="required">From URL Slug (without host)</label>
        <input type="text" name="from_url" class="form-control" placeholder="Enter from URL"
               required value="{{ $redirection->from_url ?? old("from_url") }}">
    </div>

    <div class="form-group col-md-6 {{ $errors->has('to_url') ? ' error' : '' }}">
        <label for="tag_color" class="required">To URL Slug (without host)</label>
        <input type="text" name="to_url" class="form-control" placeholder="Enter to URL"
               required value="{{ $redirection->to_url ?? old("to_url") }}">
    </div>

    <div class="form-actions col-md-12 ">
        <div class="pull-right">
            <button type="submit" class="btn btn-primary">
                @if($page == 'create')
                    <i class="la la-save"></i> SAVE
                @elseif($page == 'edit')
                    <i class="la la-pencil-square"></i> UPDATE
                @endif
            </button>
        </div>
    </div>
</div>
@csrf

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')
    <script>
        $('#redirection_for').change(function () {

            switch ($(this).val()) {
                case "product":
                    $('#identifier_notation').html("Enter Product Code");
                    break;
                case "dynamic_link":
                    $('#identifier_notation').html("Enter Dynamic Link");
                    break;
                default:
                    $('#identifier_notation').html("Enter according to selected Url For");
                    break;
            }
        });

        $('#redirection_for').trigger('change');
    </script>
@endpush
