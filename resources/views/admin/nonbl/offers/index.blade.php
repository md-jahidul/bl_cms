@extends('layouts.admin')
@section('title', 'Non Bl Offer List')
@section('card_name', 'Non Bl Offer List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><strong>Non Bl Offer List</strong></li>
@endsection
@section('action')
    <a href="{{ route('generic-slider.create') }}" class="btn btn-primary round btn-glow px-2">
        <i class="la la-plus"></i> Create New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="pb-1 mb-0"><strong>Sortable Components</strong></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr width="100%">
                            <td width="3%"><i class="icon-cursor-move icons"></i></td>
                            <th width="25%">Component Type</th>
                            <th class="text-center">User Can Enable/Disable</th>
                            <th width="25%" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="componentSortable">
                        @foreach($offers as $index => $component)
                            <tr width="3%" data-index="{{ $component['id'] }}" data-position="{{ $component['display_order'] }}"
                                data-component-id="{{ $component['component_id'] ?? 0 }}" style="width: 100%">
                                <td><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $component['title_en'] }}</td>
                                <td class="text-center">
                                    @if(isset($component['is_eligible']))
                                        {{ $component['is_eligible'] == 1 ? "Yes" : "No" }}
                                    @endif
                                </td>
                                <td class="action">
                                    @if(isset($component['is_api_call_enable']))
                                        @if($component['is_api_call_enable'] == 0)
                                            <a href="{{ route("nonbl.offers.status.update", $component['id']) }}" data-value="enable  {{ $component['title_en'] }}"
                                               class="btn btn-danger border-0 change_status" title="Click to enable">Disabled</a>
                                        @else
                                            <a href="{{ route("nonbl.offers.status.update", $component['id']) }}" data-value="disable {{ $component['title_en'] }}"
                                               class="btn btn-success border-0 change_status" title="Click to disable">Enabled</a>
                                        @endif
                                    @else
                                        <button type="button"
                                                class="btn btn-secondary border-0" title="Click to disable" disabled="disabled"> Enabled</button>
                                        <button type="button"
                                                class="btn btn-secondary-info border-0"><i class="la la-pencil" aria-hidden="true" disabled="disabled"></i></button>
                                        <button type="button"
                                                class="btn btn-secondary-info border-0"><i class="la la-trash" aria-hidden="true" disabled="disabled"></i></button>
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
                        <h4 class="modal-title" id="myModalLabel17">Add Non Bl Component</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form role="form" action="" method="POST"
                          id="form" novalidate>
                        <div class="modal-body">
                            <div class="card-body card-dashboard">
                                <div class="row">
                                    <input type="hidden" name="id" value="">

                                    <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                        <label for="title" class="required">Title EN</label>
                                        <input type="text" name="title_en"  class="form-control" placeholder="Enter english label"
                                               required data-validation-required-message="Enter footer menu english label">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_en'))
                                            <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                        <label for="title" class="required">Title BN</label>
                                        <input type="text" name="title_bn"  class="form-control" placeholder="Enter label in Bangla"
                                               required data-validation-required-message="Enter label in Bangla">
                                        <div class="help-block"></div>
                                        @if ($errors->has('title_bn'))
                                            <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                        @endif
                                    </div>
                                    @if($errors->has('component_size'))
                                        <p class="text-left">
                                            <small class="danger text-muted">{{ $errors->first('component_size') }}</small>
                                        </p>
                                    @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="required mr-1">User Can Enable/Disable:</label> <br>
                                            <input type="radio" name="is_eligible" value="1" id="active">
                                            <label for="active" class="mr-1">Yes</label>

                                            <input type="radio" name="is_eligible" value="0" id="inactive" checked>
                                            <label for="inactive">No</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="required mr-1">Status:</label>

                                            <input type="radio" name="is_api_call_enable" value="1" id="can_enable_yes">
                                            <label for="can_enable_yes" class="mr-1">Enable</label>

                                            <input type="radio" name="is_api_call_enable" value="0" id="can_disable_no" checked>
                                            <label for="can_disable_no">Disable</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="submit"></button>
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                        </div>
                        @csrf
                        @method('POST')
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
        #componentSortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-css')
    <link href="{{ asset('css/sortable-list.css') }}" rel="stylesheet">
    <style>
        #componentSortable tr td{
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }
    </style>
@endpush

@push('page-js')
    <script>
        (function () {
            let titleEn = $("input[name='title_en']");
            let titleBn = $("input[name='title_bn']");
            let active = $("#active");
            let inactive = $("#inactive");
            let enable_yes = $("#can_enable_yes");
            let disable_no = $("#can_disable_no");

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
                    url: "{{ url('non-bl-offers-components-sort') }}",
                    data: {
                        position: positions
                    },
                    success: function (data) {
                        console.log(data)
                        if (data.status === "error") {
                            alert('Opps, something went wrong!!')
                        }
                    },
                    error: function () {
                        alert('Opps, something went wrong!!')
                        window.location.replace("{{ url('non-bl-offers') }}");
                    }
                });
            }

            $("#componentSortable").sortable({
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
