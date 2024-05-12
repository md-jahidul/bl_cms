<div class="row">
    <div class="form-group col-md-6 {{ $errors->has('from_url') ? ' error' : '' }}">
        <label for="tag_color" class="required">From URL Slug (without host)</label>
        <input type="text" name="from_url" class="form-control" placeholder="Enter from URL"
               required value="{{ $redirection->from_url ?? old("from_url") }}">
        <span class="text-warning">Ex: /cms/app-service Or /product/productCode</span>
    </div>

    <div class="form-group col-md-6 {{ $errors->has('to_url') ? ' error' : '' }}">
        <label for="tag_color" class="required">To URL Slug (without host)</label>
        <input type="text" name="to_url" class="form-control" placeholder="Enter to URL"
               required value="{{ $redirection->to_url ?? old("to_url") }}">
        <span class="text-warning">Ex: /en/apps-and-services/apps Or /en/prepaid/internet/1-gb-toffee-1-day</span>
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
