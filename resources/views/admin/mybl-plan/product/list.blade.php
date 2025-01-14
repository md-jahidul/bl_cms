<div class="col-md-12 mt-3">
    <table class="table full-width table-striped table-bordered dataTable"
           id="product_list" role="grid">
        <thead>
        <tr>
            <th>Sl.</th>
            <th>Sim Type</th>
            <th>Content Type</th>
            <th>Product Code</th>
            <th>Validity</th>
            <th>Validity Unit</th>
            <th>Market Price</th>
            <th>Price</th>
            <th>Discount(%)</th>
            <th>Savings Amount</th>
            <th>Status</th>
            <th class="filter_data">Actions</th>
        </tr>
    </thead>
    <tbody>
    @php $sl = 1 @endphp
    @if($defaultProduct)
        <tr>
            <td>{{ $sl++ }}</td>
            <td>{{ strtoupper($defaultProduct->sim_type) }}</td>
            <td>{{ strtoupper($defaultProduct->content_type) ?: 'N/A' }}</td>
            <td>{{ $defaultProduct->product_code }}&nbsp;<span class="badge badge-info d-inline">Default</span></td>
            <td>{{ $defaultProduct->validity }}</td>
            <td>{{ strtoupper($defaultProduct->validity_unit) }}</td>
            <td>{{ $defaultProduct->market_price }} (BDT)</td>
            <td>{{ $defaultProduct->discount_price }} (BDT)</td>
            <td>{{ $defaultProduct->discount_percentage }}%</td>
            <td>{{ $defaultProduct->savings_amount }} (BDT)</td>
            <td><span class="badge @if($defaultProduct->is_active == 1) badge-success @else badge-warning @endif">
                        {{ $defaultProduct->is_active == 1 ? "Active" : "Inactive" }}</span>
            </td>
            <td><a href="{{ route('mybl-plan.products.edit', $defaultProduct->id) }}" class="btn btn-sm btn-icon btn-outline-success edit"><i class="la la-eye"></i></a></td>
        </tr>
    @endif
    @foreach($myBlPlanProducts as $key => $product)
        @if($product->is_default == 1) @continue @endif
        <tr>
            <td>{{ $sl++ }}</td>
            <td>{{ strtoupper($product->sim_type) }}</td>
            <td>{{ strtoupper($product->content_type) ?: 'N/A' }}</td>
            <td>{{ $product->product_code }}</td>
            <td>{{ $product->validity }}</td>
            <td>{{ strtoupper($product->validity_unit) }}</td>
            <td>{{ $product->market_price }} (BDT)</td>
            <td>{{ $product->discount_price }} (BDT)</td>
            <td>{{ $product->discount_percentage }}%</td>
            <td>{{ $product->savings_amount }} (BDT)</td>
            <td><span class="badge @if($product->is_active == 1) badge-success @else badge-warning @endif">
                {{ $product->is_active == 1 ? "Active" : "Inactive" }}</span>
            </td>
            <td><a href="{{ route('mybl-plan.products.edit', $product->id) }}" class="btn btn-sm btn-icon btn-outline-success edit"><i class="la la-eye"></i></a></td>
        </tr>
    @endforeach
    </tbody>
    </table>
</div>

@push('style')
<link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">
@endpush

@push('page-js')
    <script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>


    <script>
        $(function () {
            $("#product_list").dataTable({
                scrollX: true,
                pageLength: 25,
                searching: true,
            })
        });
    </script>
@endpush


