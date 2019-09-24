<div id="internet_heading" class="card-header">
    <a data-toggle="collapse" data-parent="#settings_panel" href="#internet_config"
       aria-expanded="true"
       aria-controls="internet_config" class="card-title lead">Internet Filter</a>
</div>
<div id="internet_config" role="tabpanel" aria-labelledby="internet_heading" class="collapse">
    <div class="card-content">
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    <form class="form" action="#"
                          method="POST">
                        @csrf
                        @method('post')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-globe"></i>Create Internet
                                Filter</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="internet_lower_price">Lower<small
                                                class="text-danger">*</small></label>
                                        <input required type="number"
                                               id="internet_lower_price" min="1"
                                               class="form-control"
                                               placeholder="Enter Lower Bound...." name="lower">
                                        <small class="form-text text-muted">Enter
                                            amount in mb.</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="internet_upper_price">Upper</label>
                                        <input required type="number"
                                               id="internet_upper_price"
                                               class="form-control"
                                               placeholder="Enter Upper Bound...." name="upper">
                                        <small class="form-text text-muted">Enter
                                            amount in mb.</small>
                                    </div>
                                </div>
                                <div class="col-md-1 add-button">
                                    <button type="button" id="add_internet_filter"
                                            class="btn btn-sm btn-icon btn-outline-info">
                                        <i class="la la-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="offset-1 col-md-4">
                    <h5>Internet Filter List</h5>
                    <table class="table table-striped table-bordered base-style dataTable"
                           style="width: 100%!important;"
                           id="internet_filter_table" role="grid" aria-describedby="Example1_info">
                        <thead>
                        <tr>
                            <th class="filter_data">Sl.</th>
                            <th class="filter_data"> Filters</th>
                            <th class="filter_data"></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('page-js')
    <script>
        let internetFilterTable = null;
        $(function () {

            let saveInternetFilter = function (param) {
                return $.ajax({
                    url: '{{route('mixed-bundle-offer.filter.internet.save')}}',
                    method: 'post',
                    data: param
                });
            }
            // datatable for internet filter

            internetFilterTable = $("#internet_filter_table").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                paging: false,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: '{{ route('mixed-bundle-offer.filter.internet.list') }}',
                },
                columns: [
                    {
                        name: 'sl',
                        className: 'filter_data',
                        render: function (data, type, row, meta) {
                            return null;
                        }
                    },
                    {
                        name: 'filters',
                        className: 'filter_data',
                        render: function (data, type, row, meta) {
                            if (row.upper == null) {
                                return row.lower + ' + ';
                            }
                            return row.lower + ' - ' + row.upper + ' ' + row.unit;
                        }
                    },

                    {
                        name: 'actions',
                        className: 'filter_data',
                        render: function (data, type, row) {
                            return `<div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger internet-filter-del" data-id="` + row.id + `"><i class="la la-remove"></i></button>
                          </div>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }
            });


            $('#add_internet_filter').on('click', function (e) {
                e.preventDefault();
                let lower_price = $("#internet_lower_price").val();
                let upper_price = $("#internet_upper_price").val();

                if (lower_price < 0) {
                    Swal.fire(
                        'Input Error!',
                        'Lower input cannot be negative value',
                        'error',
                    );

                    return false;
                }

                if (upper_price < 0 && upper_price != '') {
                    Swal.fire(
                        'Input Error!',
                        'Upper input should be greater than 0',
                        'error',
                    );

                    return false;
                }

                let callSaveInternetFilter = saveInternetFilter(new function () {
                    this._token = '{{csrf_token()}}';
                    this.lower = lower_price;
                    if (upper_price != '') {
                        this.upper = upper_price;
                    }
                })

                callSaveInternetFilter.done(function (data) {
                    $('#internet_filter_table').DataTable().ajax.reload();
                    Swal.fire(
                        'Success!',
                        'Successfully Added',
                        'success',
                    );
                    $("#internet_lower_price").val('');
                    $("#internet_upper_price").val('');


                }).fail(function (jqXHR, textStatus, errorThrown) {
                    // If fail
                    //console.log(textStatus + ': ' + errorThrown);
                    Swal.fire(
                        'Error!',
                        'Something went wrong.try Later',
                        'error',
                    );
                });
            })

            $(document).on('click', '.internet-filter-del', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                let call = null;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    html: jQuery('.delete_btn').html(),
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        call = $.ajax({
                            url: '{{route('mixed-bundle-offer.filter.delete')}}',
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                id: id
                            }
                        });

                        call.done(function () {
                            $('#internet_filter_table').DataTable().ajax.reload();
                            Swal.fire(
                                'Success!',
                                'Successfully Deleted',
                                'success',
                            );
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            // If fail
                            //console.log(textStatus + ': ' + errorThrown);
                            Swal.fire(
                                'Error!',
                                'Something went wrong.try Later',
                                'error',
                            );
                        });


                    }
                });
            })


        });
    </script>
@endpush
