    <div class="row">
        <div class="col-md-offset-1 col-md-3 col-xs-12">
            <select name="division" class="form-control filter" id="division">
                <option value=""> Select Devision</option>
                @foreach($divisions as $div)
                <option value="{{$div['division']}}">{{$div['division']}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-8 col-xs-12">
            <a href="javascript:;" class="btn btn-danger all_card_delete float-right">Delete All</a>
        </div>

    </div>


<div class="col-md-12 mt-1">
    <table class="table table-striped table-bordered dataTable"
           id="payment_card_list" role="grid">
        <thead>
            <tr>
                <th>SL.</th>
                <th>Code</th>
                <th>Division</th>
                <th>Area</th>
                <th>Branch</th>
                <th>Address</th>
                <th>Status</th>
                <th class="filter_data">Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@push('page-js')


<script>
    $(function () {

        //change show/hide status of easy payment card
        $("#payment_card_list").on('click', '.card_change_status', function (e) {
            var cardId = $(this).attr('href');

            $.ajax({
                url: '{{ route("payment.card.status.change")}}',
                cache: false,
                type: "GET",
                data: {
                    cardId: cardId
                },
                success: function (result) {
                    if (result.success == 1) {
                        swal.fire({
                            title: 'Payment card status is changed!',
                            type: 'success',
                            timer: 3000,
                            showConfirmButton: false
                        });

                        $('#payment_card_list').DataTable().ajax.reload();

                    } else {
                        swal.close();
                        swal.fire({
                            title: result.message,
                            timer: 3000,
                            type: 'error',
                        });
                    }

                },
                error: function (data) {
                    swal.fire({
                        title: 'Status change process failed!',
                        type: 'error',
                    });
                }
            });
            e.preventDefault();
        });

        //delete easy payment card
        $("#payment_card_list").on('click', '.delete_card', function (e) {
            var deleteUrl = $(this).attr('href');
            var cnfrm = confirm("Do you want to delete this card?");
            if (cnfrm) {
                $.ajax({
                    url: deleteUrl,
                    cache: false,
                    type: "GET",
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: 'Payment card is deleted!',
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });

                            $('#payment_card_list').DataTable().ajax.reload();

                        } else {
                            swal.close();
                            swal.fire({
                                title: result.message,
                                timer: 3000,
                                type: 'error',
                            });
                        }

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Delete process failed!',
                            type: 'error',
                        });
                    }
                });
            }
            e.preventDefault();
        });
        
        
        //delete all easy payment card
        $('.all_card_delete').on('click', function (e) {
            var deleteUrl = "{{ URL('delete-easy-payment-card') }}";
            var cnfrm = confirm("Do you want to delete all cards?");
            if (cnfrm) {
                $.ajax({
                    url: deleteUrl,
                    cache: false,
                    type: "GET",
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: 'All payment cards are deleted!',
                                type: 'success',
                                timer: 3000,
                                showConfirmButton: false
                            });

                            $('#payment_card_list').DataTable().ajax.reload();

                        } else {
                            swal.close();
                            swal.fire({
                                title: result.message,
                                timer: 3000,
                                type: 'error',
                            });
                        }

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Delete process failed!',
                            type: 'error',
                        });
                    }
                });
            }
            e.preventDefault();
        });



        $("#payment_card_list").dataTable({
            scrollX: true,
            processing: true,
            searching: false,
            serverSide: true,
            ordering: false,
            autoWidth: false,
            pageLength: 20,
            lengthChange: false,
            ajax: {
                url: '{{ route("easypaymentcard.list.ajax") }}',
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    division: function () {
                        return $("#division").val();
                    }
                }
            },
            columns: [

                {
                    name: 'sl',
                    render: function () {
                        return null;
                    }
                },
                {
                    name: 'code',
                    render: function (data, type, row) {
                        return row.code;
                    }
                },
                {
                    name: 'division',
                    render: function (data, type, row) {
                        return row.division;
                    }
                },
                {
                    name: 'area',
                    render: function (data, type, row) {
                        return row.area;
                    }
                },
                {
                    name: 'branch_name',
                    render: function (data, type, row) {
                        return row.branch_name;
                    }
                },
                {
                    name: 'address',
                    render: function (data, type, row) {
                        return row.address;
                    }
                },
                {
                    name: 'status',
                    render: function (data, type, row) {
                        return row.status;
                    }
                },
                {
                    name: 'actions',
                    className: 'filter_data',
                    render: function (data, type, row) {
                        let detail_question_url = "{{ URL('delete-easy-payment-card') }}" + "/" + row.id;
                        return `<div class="btn-group" role="group" aria-label="Delete">
                        <a href=" ` + detail_question_url + ` "class="btn btn-sm btn-icon btn-outline-danger delete_card"><i class="la la-trash"></i></a>
                      </div>`
                    }
                }
            ],
            "fnCreatedRow": function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            }

        });

        $(document).on('change', '.filter', function (e) {
            $('#payment_card_list').DataTable().ajax.reload();
        });
    });
</script>

@endpush



