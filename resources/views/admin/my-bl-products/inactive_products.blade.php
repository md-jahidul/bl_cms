@extends('layouts.admin')
@section('title', 'MyBl Inactive Product List')
@section('card_name', 'MyBl Inactive Product List')
@section('breadcrumb')
    <li class="breadcrumb-item active">MyBl Inactive Product Panel</li>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">

                    <div class="col-md-12 mt-3">

                        <table class="table table-striped table-bordered dataTable"
                               id="product_list" role="grid">
                            <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Product Code</th>
                                <th>Renew Prod. Code</th>
                                <th>Recharge Prod. Code</th>
                                <th>Description</th>
                                <th class="filter_data">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($inactiveProducts as $product)
                                <tr>
                                    <th>{{$loop->iteration}}.</th>
                                    <th>{{$product->product_code}}</th>
                                    <th>{{$product->renew_product_code}}</th>
                                    <th>{{$product->recharge_product_code}}</th>
                                    <th>{{$product->short_description}}</th>
                                    <th>
                                        <a class="btn btn-success btn-sm" title="Activate Product"
                                           onclick="return confirm('Are you sure to activate the product?')"
                                           href="{{route('mybl.products.activate', $product->product_code)}}">
                                            <i class="ft-check-circle"></i>
                                        </a>
                                    </th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </section>

@endsection



@push('page-js')

    <script>
        $(document).ready(function () {
            $('#product_list').DataTable();
        });

    </script>
@endpush
