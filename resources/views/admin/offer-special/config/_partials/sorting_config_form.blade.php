<div class="card collapse-icon accordion-icon-rotate left">
    <div id="sorting_heading" class="card-header">
        <a data-toggle="collapse" data-parent="#settings_panel" href="#sorting_config"
           aria-expanded="false"
           aria-controls="sorting_config" class="card-title lead">Sorting Filter</a>
    </div>
</div>
<div id="sorting_config" role="tabpanel" aria-labelledby="sorting_heading" class="collapse">
    <div class="card-content">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row skin skin-square">
                        <div class="col-md-3 col-sm-12">
                            <fieldset>
                                <input type="checkbox" id="price_low_high" value="price_low_high" name="sorting_filters"
                                       data-label="Price Low to High" @if(in_array('price_low_high', $sort_filters)) checked @endif>
                                <label for="price_low_high">Price Low to High</label>
                            </fieldset>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <fieldset>
                                <input type="checkbox" id="price_high_low" value="price_high_low" name="sorting_filters"
                                       data-label="Price High To Low" @if(in_array('price_high_low', $sort_filters)) checked @endif>
                                <label for="price_high_low">Price High To Low</label>
                            </fieldset>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <button class="btn btn-sm btn-outline-info" id="save_sort_filter">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('page-js')
    <script>
        $(function () {
            let saveSortFilter = function (param) {
                return $.ajax({
                    url: '{{route('special.filter.sort.save')}}',
                    method: 'post',
                    data: param
                });
            }

            $(document).on('click','#save_sort_filter',function (e) {
                e.preventDefault();
                let sort_filters = [];
                $.each($("input[name='sorting_filters']:checked"), function(){
                    sort_filters.push({
                        name  : $(this).data('label'),
                        value : $(this).val(),
                    });
                });

                if(sort_filters.length < 1) {
                    Swal.fire(
                        'Error!',
                        'Please check atleast one',
                        'error',
                    );
                    return false;
                }

                // ajax call
                let callSaveSortFilter = saveSortFilter(new function () {
                    this._token = '{{csrf_token()}}';
                    this.filters = sort_filters
                })

                callSaveSortFilter.done(function (data) {
                    Swal.fire(
                        'Success!',
                        'Successfully Saved',
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
            })
        });
    </script>
@endpush
