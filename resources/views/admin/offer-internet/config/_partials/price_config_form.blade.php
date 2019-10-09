<div class="card collapse-icon accordion-icon-rotate left">
    <div id="price_heading" class="card-header">
        <a data-toggle="collapse" data-parent="#settings_panel" href="#price_config"
           aria-expanded="true"
           aria-controls="price_config" class="card-title lead">Price Filter</a>
    </div>
</div>
<div id="price_config" role="tabpanel" aria-labelledby="price_heading" class="collapse show">
    <div class="card-content">
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    <form class="form" action="#"
                          method="POST">
                        @csrf
                        @method('post')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-money"></i>Create Price
                                Filter</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="lower_price">Lower<small
                                                class="text-danger">*</small></label>
                                        <input required type="number"
                                               value="@if(old('lower')){{old('lower')}}@endif"
                                               id="lower_price" min="1"
                                               class="form-control price_filter_input limit-input"
                                               placeholder="Max 2000" name="lower">
                                        <small class="form-text text-muted">Enter
                                            amount in Tk.</small>
                                        @error('lower')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="upper_price">Upper</label>
                                        <input required type="number"
                                               value="@if(old('upper')){{old('upper')}}@endif"
                                               id="upper_price"
                                               class="form-control price_filter_input limit-input"
                                               placeholder="Max 2000" name="upper" min="1">
                                        <small class="form-text text-muted">Enter
                                            amount in Tk.</small>
                                        @error('lower')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-1 add-button">
                                    <button type="button" id="add_price_filter"
                                            class="btn btn-sm btn-icon btn-outline-info" title="Save">
                                        <i class="la la-save"></i>Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="offset-1 col-md-4">
                    <h5>Price Filter List</h5>
                    <table class="table table-striped table-bordered base-style"
                           id="price_filter_table" role="grid" aria-describedby="Example1_info">
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

        let priceFilterTable = null;
        $(function () {

            let savePriceFilter = function (param) {
                return $.ajax({
                    url: '{{route('internet-pack.filter.price.save')}}',
                    method: 'post',
                    data: param
                });
            }
            // datatable for price filter

            priceFilterTable = $("#price_filter_table").dataTable({
                scrollX: true,
                processing: true,
                searching: false,
                paging: false,
                serverSide: true,
                ordering: false,
                ajax: {
                    url: '{{ route('internet-pack.filter.price.list') }}',
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
                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger price-filter-del" data-id="` + row.id + `"><i class="la la-remove"></i></button>
                          </div>`
                        }
                    }
                ],
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                }
            });

            $('#add_price_filter').on('click', function (e) {
                e.preventDefault();
                let lower_price = $("#lower_price").val();
                let upper_price = $("#upper_price").val();

                if(upper_price !='' && parseInt(lower_price) > parseInt(upper_price)){
                    Swal.fire(
                        'Input Error!',
                        'Lower input cannot be greater than Upper Input',
                        'error',
                    );

                    return false;
                }

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

                let callSavePriceFilter = savePriceFilter(new function () {
                    this._token = '{{csrf_token()}}';
                    this.lower = lower_price;
                    if (upper_price != '') {
                        this.upper = upper_price;
                    }
                })

                callSavePriceFilter.done(function (data) {
                    $('#price_filter_table').DataTable().ajax.reload();
                    Swal.fire(
                        'Success!',
                        'Successfully Added',
                        'success',
                    );
                    $("#lower_price").val('');
                    $("#upper_price").val('');


                }).fail(function (jqXHR, textStatus, errorThrown) {
                    // If fail
                    //console.log("error:" , jqXHR.responseJSON);
                    let errorResponse = jqXHR.responseJSON;
                    Swal.fire(
                        'Error!',
                        errorResponse.errors,
                        'error',
                    );
                });
            })

            $(document).on('click', '.price-filter-del', function (e) {
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
                            url: '{{route('internet-pack.filter.delete')}}',
                            method: 'post',
                            data: {
                                _token: '{{csrf_token()}}',
                                id: id
                            }
                        });

                        call.done(function () {
                            $('#price_filter_table').DataTable().ajax.reload();
                            Swal.fire(
                                'Success!',
                                'Successfully Deleted',
                                'success',
                            );
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            let errorResponse = jqXHR.responseJSON;
                            Swal.fire(
                                'Error!',
                                errorResponse.errors,
                                'error',
                            );
                        });


                    }
                });
            })

            $(document).on('input','.price_filter_input',function () {
                let input = $(this).val();

                if(input == 0) $(this).val('');

                if(input > 2000){
                    Swal.fire(
                        'Input Error!',
                        'Price Value must be less than 2000 tk',
                        'error',
                    );

                    $(this).val('');
                }
            })


        });
    </script>
@endpush
