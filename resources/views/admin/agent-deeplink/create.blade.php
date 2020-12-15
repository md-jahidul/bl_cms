@extends('layouts.admin')
@section('title', 'Agent Create')
@section('card_name', 'Agent Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="{{ url('deeplink/agent/list') }}"> Agent List</a></li>
    <li class="breadcrumb-item active"> Agent Create</li>
@endsection
@section('action')
    <a href="{{ url('deeplink/agent/list') }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form role="form" action="{{ route('deeplink.agent.store') }}" method="POST" novalidate enctype="multipart/form-data" id="createUser">
                            @include('admin.agent-deeplink.agent-form.form')
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
    <script type="text/javascript" src="{{ asset('theme/js/scripts/forms/validation/form-validation.min.js') }}"></script>
   <script src="{{ asset('theme/js/scripts/forms/validation/1_11_1_jquery.validate.min.js') }}"></script>
    <script>
   $(document).ready(function() {

            $("#createUser").validate({
                rules: {
                    msisdn: {
                        required: true,
                        minlength:11,
                        maxlength: 13,

                    }
                },
                messages: {
                    msisdn: {
                        required: "Phone Number field is required"
                    }
                },
                submitHandler: function(form) {
                    if ($(form).valid()) {
                        form.submit();
                    }
                    return false; // prevent normal form posting
                }

            });

        });
    </script>
@endpush








