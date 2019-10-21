{{--@extends('vendor.authorize.layouts.auth')--}}
@extends('layouts.admin')

@section('title', 'Permission')
@section('card_name', 'Permission')
@section('breadcrumb')
    <li class="breadcrumb-item active">Permission</li>
@endsection
@section('action')
    <!-- <a href="{{ url('sliders/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add Slider
    </a> -->
@endsection

@php

    function mapStr($str){
        /* $func = ['index','create','store','show','edit','update','destroy','App\\Http\\Controllers\\AssetLite','*Sortable'];
        $rplc = ['Show List','View Create Form','Insert Data','Show Details','View Edit Form','Update Data','Delete','AssetLite Features','Enable Sorting'];
        return str_replace($func,$rplc,$str); */

        $sortableItems = "/parentFooterSortable|parentMenuSortable|partnerOfferSortable|sliderImageSortable|quickLaunchSortable/";
        $func = ['/index/','/create/','/store/','/show/','/edit/','/update/','/destroy/','/App\\Http\\Controllers\\AssetLite/', $sortableItems];
        $rplc = ['Show List','View Create Form','Insert Data','Show Details','View Edit Form','Update Data','Delete','AssetLite Features','Ordering'];
        return preg_replace($func,$rplc,$str);
    }

    function arrayMerge($arr)
    {
        $actions = [];
        foreach ($arr as $key => $items){
            $count = 0;
            foreach ($items as $item){

                $actions[$key . '_' . ++$count ] = $item;
            }
        }
        return $actions;
    }
    $count = 0;

@endphp

@section('content')

    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div id="tree" class="card-body card-dashboard">
                    {!! Form::open(['url' => '/' . Config("authorization.route-prefix") . '/permissions', 'class' => 'form-horizontal']) !!}

                    <div class="form-group row mb-0 pt-1 pb-1">
                        <div class="form-group {{ $errors->has('role_id') ? 'has-error' : ''}} col-md-8 row">
                            <strong>{!! Form::label('role_id', 'Role', ['class' => 'control-label mt-1 ml-2']) !!}</strong>
                            <div class="col-md-8">
                                {!! Form::select('role_id', $roles, null, ['placeholder' => 'Please select ...', 'class' => 'form-control', 'required' => 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary float-right update']) !!}
                        </div>
                    </div>

                    {{--                    <ul id="tree">--}}
                    @foreach($actions as $namespace => $controllers)
                        <h3 class="mb-2">{{ mapStr($namespace) }}</h3>
                        {{--  <li>{{ mapStr($namespace) }}--}}
                        {{--      <button class="btn select-all">Select All</button>--}}
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Controller</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($controllers as $controller => $methods)
                                @php
                                    $actions = arrayMerge(  $methods );
                                @endphp
                                <tr class="item{{ $loop->iteration -1 }}">
                                    <td style="vertical-align:middle"><label>{{ $loop->iteration -1  }}</label></td>
                                    <td style="vertical-align:middle"><label>{{ str_replace("Controller","", $controller)  }}</label></td>
                                    <td>
                                        @foreach( $actions as $method => $action)
                                            <label style="display: block">
{{--                                                @if($controller == 'HomeController' && $action == 'index')--}}
{{--                                                    {{ Form::checkbox('actions[]', $namespace . '-' . $controller . '-' . explode ("_",$method)[0] . '-' . $action, null, ['class' => 'field', 'checked']) }}--}}
{{--                                                @else--}}
{{--                                                @endif--}}
                                                    {{ Form::checkbox('actions[]', $namespace . '-' . $controller . '-' . explode ("_",$method)[0] . '-' . $action, null, ['class' => 'field']) }}
                                                    {{ mapStr($action) }}
                                            </label>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{--                            </li>--}}
                    @endforeach

                    <div class="pb-2">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary float-right mb-2 update']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </section>
@endsection

@push('styles')
    <link href="/vendor/authorize/css/tree.css" rel="stylesheet">
@endpush

{{--@push('scripts')--}}
@push('page-js')
{{--    <script src="/vendor/authorize/js/app.js"></script>--}}
    <script src="/vendor/authorize/js/tree.js"></script>
    <script>
        $(function () {
            $('#role_id').on('change', function () {

                // alert('hi');
                var role_id = $(this).val();
                $('#tree').find('input[type=checkbox]:checked').prop('checked', '');
                if (role_id > 0) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': Laravel.csrfToken
                        },
                        type: "POST",
                        url: '{{ url('/' . Config("authorization.route-prefix") . '/permissions/getSelectedRoutes') }}',
                        data: {role_id: role_id},
                        cache: false,
                        success: function (res) {

                            console.log(res);

                            $.each(res.selectedActions, function (key, val) {
                                var value = val.replace(/\\/g, '\\\\');
                                $('input[type="checkbox"][value="' + value + '"]').prop('checked', 'checked');
                            });
                        },
                        error: function (xhr, status, error) {
                            alert("An AJAX error occured: " + status + "\nError: " + error);
                        }
                    });
                }
            });

            $('.select-all').on('click',function(){
                $(this).parent().find('.indicator').trigger('click');
                $(this).parent().find('li input.field').each(function(i,ele){
                    $(this).attr('checked', !$(this).attr('checked') );
                })
            });

            $('.update').on('click',function(){
                $('.item0').find('input[type="checkbox"]').attr('checked',true);
            });
        });
    </script>
@endpush

<style>
    .item0{
        display: none;
    }
</style>
