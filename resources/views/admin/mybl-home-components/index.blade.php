@extends('layouts.admin')
@section('title', 'Components List')
@section('card_name', 'Home Components List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><strong>Components List</strong></li>
@endsection
@section('action')
{{--    <a href="{{ url("slider/$sliderId/$type/image/create") }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>--}}
{{--        Add Slider Image--}}
{{--    </a>--}}
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1 mb-0"><strong>Fixed Components</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="3%">SL</th>
                            <th>Component Type</th>
                            {{--                            <th>Component Status</th>--}}
                            {{--                            <th class="text-right">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($components['fixed_components'] as $index=> $component)
                            <tr data-index="{{ $component['id'] }}" data-position="{{ $component['display_order'] }}"
                                data-component-id="{{ $component['component_id'] ?? 0 }}">
                                {{--                                <tr>--}}
                                <td width="3%">{{ $loop->iteration }}</td>
                                <td>{{ $component['title_en'] }}{{--{!! $component->is_active == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}--}}</td>
                                {{--                                    <td class="action" width="8%">--}}
                                {{--                                        @if($component->is_active == 0)--}}
                                {{--                                            <a href="{{ route("update-component-status", [ $component->page_id, $component->id ]) }}"--}}
                                {{--                                               class="btn btn-success border-0" title="Click to enable"> Enable</a>--}}
                                {{--                                        @else--}}
                                {{--                                            <a href="{{ route("update-component-status", [ $component->page_id, $component->id ]) }}"--}}
                                {{--                                               role="button" class="btn btn-danger border-0" title="Click to disable"> Disable</a>--}}
                                {{--                                        @endif--}}
                                {{--                                    </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                    <h4 class="pt-2 pb-1 mb-0"><strong>Sortable Components</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th>Component Type</th>
                            <th class="text-center">User Can Enable/Disable</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="sortable">
                            @foreach($components['sortable_components'] as $index=> $component)
                                <tr data-index="{{ $component['id'] }}" data-position="{{ $component['display_order'] }}"
                                    data-component-id="{{ $component['component_id'] ?? 0 }}">
{{--                                <tr>--}}
                                    <td width="3%"><i class="icon-cursor-move icons"></i></td>
                                    <td>{{ $component['title_en'] }}{{--{!! $component->is_active == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}--}}</td>
                                    <td class="text-center">
                                        @if(isset($component['is_eligible']))
                                            {{ $component['is_api_call_enable'] == 1 ? "Yes" : "No" }}
                                        @endif
                                    </td>
                                    <td class="action" width="8%">
                                        @if(isset($component['is_eligible']))
                                            @if($component['is_eligible'] == 0)
                                                <a href="{{ route("components.status.update", $component['id']) }}" data-value="enable  {{ $component['title_en'] }}"
                                                   class="btn btn-danger border-0 change_status" title="Click to enable"> Disabled</a>
                                            @else
                                                <a href="{{ route("components.status.update", $component['id']) }}" data-value="disable {{ $component['title_en'] }}"
                                                   class="btn btn-success border-0 change_status" title="Click to disable"> Enabled</a>
                                            @endif
                                                <a href="" data-id="{{ $component['id'] }}" data-toggle="modal" data-target="#large" role="button"
                                                   class="btn btn-info border-0 edit"><i class="la la-pencil" aria-hidden="true"></i></a>
                                        @else
                                            <button type="button"
                                                  class="btn btn-secondary border-0" title="Click to disable" disabled="disabled"> Enabled</button>
                                            <button type="button"
                                               class="btn btn-secondary-info border-0"><i class="la la-pencil" aria-hidden="true" disabled="disabled"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{--Modal Start--}}
    <div class="col-lg-12 col-md-6 col-sm-12">
        <!-- Modal -->
        <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel17">Referees List</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" action="{{ route("mybl.home.components.update") }}" method="POST" novalidate>
                        <div class="modal-body">
                            <div class="card-body card-dashboard">
                                <div class="row">
                                     <input type="hidden" name="id" value="">

                                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                        <label for="title" class="required">Title EN</label>
                                        <input type="text" name="title_en"  class="form-control" placeholder="Enter english label"
                                               value="{{--{{ $menu->en_label_text }}--}}" required data-validation-required-message="Enter footer menu english label">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_en'))
                                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                        <label for="title" class="required">Title BN</label>
                                        <input type="text" name="title_bn"  class="form-control" placeholder="Enter label in Bangla"
                                               value="{{--{{ $menu->bn_label_text }}--}}" required data-validation-required-message="Enter label in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_bn'))
                                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="required mr-1">User Can Enable/Disable:</label> <br>

                                            <input type="radio" name="is_api_call_enable" value="1" id="can_enable_yes" {{--@if($menu->status == 1) {{ 'checked' }} @endif--}}>
                                            <label for="can_enable_yes" class="mr-1">Yes</label>

                                            <input type="radio" name="is_api_call_enable" value="0" id="can_disable_no" {{--@if($menu->status == 0) {{ 'checked' }} @endif--}}>
                                            <label for="can_disable_no">No</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="required mr-1">Status:</label>

                                            <input type="radio" name="is_eligible" value="1" id="active" {{--@if($menu->status == 1) {{ 'checked' }} @endif--}}>
                                            <label for="active" class="mr-1">Enable</label>

                                            <input type="radio" name="is_eligible" value="0" id="inactive" {{--@if($menu->status == 0) {{ 'checked' }} @endif--}}>
                                            <label for="inactive">Disable</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Update</button>
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                        </div>
                    @csrf
                    @method('PUT')
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--Modal End--}}

@stop

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #sortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>
        (function () {
            $('.edit').click(function () {
                let componentID = $(this).attr('data-id')
                $("input[name='id']").val(componentID);
                let titleEn = $("input[name='title_en']");
                let titleBn = $("input[name='title_bn']");
                let active = $("#active");
                let inactive = $("#inactive");
                let enable_yes = $("#can_enable_yes");
                let disable_no = $("#can_disable_no");

                $.ajax({
                    url: "{{ url("mybl-home-components/edit") }}/" + componentID,
                    methods: "get",
                    success: function (data) {
                        titleEn.val(data.title_en)
                        titleBn.val(data.title_bn)
                        if (data.is_eligible === 1){
                            active.prop("checked", true)
                        } else {
                            inactive.prop("checked", true)
                        }
                        if (data.is_api_call_enable === 1){
                            enable_yes.prop("checked", true)
                        } else {
                            disable_no.prop("checked", true)
                        }
                    }
                })
            })

            function saveNewPositions()
            {
                var positions = [];
                $('.update').each(function () {
                    positions.push({
                        'id' : $(this).attr('data-index'),
                        'serial' : $(this).attr('data-position'),
                        'component_id' : $(this).attr('data-component-id')
                    });
                })
                $.ajax({
                    methods: "POST",
                    url: "{{ url('mybl-home-components-sort') }}",
                    data: {
                        position: positions
                    },
                    success: function (data) {
                        console.log(data)
                        if (data.status === "error") {
                            alert('Opps, something went wrong!!')
                            {{--window.location.replace("{{ url('mybl-home-components') }}");--}}
                        }
                    },
                    error: function () {
                        alert('Opps, something went wrong!!')
                        window.location.replace("{{ url('mybl-home-components') }}");
                    }
                });
            }

            $("#sortable").sortable({
                update: function (event, ui) {
                    // console.log(auto_save_url)
                    $(this).children().each(function (index) {
                        if ($(this).attr('data-position') != (index + 1)) {
                            $(this).attr('data-position', (index + 1)).addClass('update')
                        }
                    });
                    saveNewPositions();
                }
            });

            $('.change_status').click(function (event) {
                event.preventDefault()
                let status = $(this).attr('data-value');
                let url = $(this).attr('href');
                var confirmPopupParams = {
                    title: 'Are you sure?',
                    text: "You want to " + status,
                    type: 'warning',
                    // html: jQuery().html(),
                    showCancelButton: true,
                    confirmButtonColor: '#77ba6a',
                    cancelButtonColor: '#a9afa9',
                    confirmButtonText: 'Yes'
                };

                var successPopupParams = {
                    title: 'Updated!',
                    text: 'Component status has been changed',
                    type: 'success'
                }

                Swal.fire(confirmPopupParams).then((result) => {
                    if (result.value) {
                        Swal.fire(successPopupParams);
                        setTimeout(function(){
                            window.location.replace(url)
                        }, 2000)
                    }
                })
            });

        })();
    </script>
@endpush





