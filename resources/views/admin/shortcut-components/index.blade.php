@extends('layouts.admin')
@section('title', 'Shortcut Components List')
@section('card_name', 'Shortcut Components List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><strong>Shortcut Components List</strong></li>
@endsection
@section('action')
    <a href="{{route('shortcut-component.create')}}" class="btn btn-primary round btn-glow px-2"><i
            class="la la-plus"></i>
        Create Shortcut
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
                            <td ><i class="icon-cursor-move icons"></i></td>
                            <th >Title</th>
                            <th >Icon</th>
                            <th >Customer Type</th>
                            <th >Status</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody id="componentSortable">
                        @foreach($components as $index=> $component)
                            <tr width="3%" data-index="{{ $component['id'] }}" data-position="{{ $component['display_order'] }}"
                                data-component-id="{{ $component['component_id'] ?? 0 }}" style="width: 100%">
                                <td><i class="icon-cursor-move icons"></i></td>
                                <td>{{ $component['title_en'] }}</td>
                                <td>
                                    <img style="height:100px;width:100px" src="{{asset($component['icon'])}}"
                                         alt="" srcset="">
                                </td>
                                <td>{{ $component['customer_type'] }}</td>
                                <td>{{ $component['status'] == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a href="{{ route('shortcut-component.edit', $component['id']) }}" role="button"
                                       class="btn-sm btn-outline-info border-0"><i class="la la-pencil"
                                                                                   aria-hidden="true"></i></a>
                                    <a href="#" remove="{{ route("shortcut-components.destroy", $component['id']) }}"
                                       class="border-0 btn btn-danger delete_btn" data-id="{{ $component['id'] }}"
                                       title="Delete the component">
                                        <i class="la la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

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

@push('page-js')
    <script>
        (function () {
            let titleEn = $("input[name='title_en']");
            let titleBn = $("input[name='title_bn']");
            let active = $("#active");
            let inactive = $("#inactive");
            let enable_yes = $("#can_enable_yes");
            let disable_no = $("#can_disable_no");

            $('.create_component').click(function () {
                $('#form').prop('action', "{{ route('lms-components.store') }}")
                $('#submit').text('Save')
                titleEn.val('');
                titleBn.val('');
                inactive.prop("checked", true)
                disable_no.prop("checked", true)
            })

            $('.edit').click(function () {
                $('#form').prop('action', "{{ route('lms-components.update') }}")
                $('#submit').text("Update")

                let componentID = $(this).attr('data-id')
                $("input[name='id']").val(componentID);


                $.ajax({
                    url: "{{ url("lms-components/edit") }}/" + componentID,
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
                    url: "{{ url('shortcut-components-sort') }}",
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
                        window.location.replace("{{ url('shortcut-components') }}");
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
