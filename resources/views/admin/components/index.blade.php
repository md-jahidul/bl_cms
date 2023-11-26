<section>
    <div class="card">
        <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                <h4 class="pb-1"><strong>Components List</strong></h4>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <td width="3%"><i class="icon-cursor-move icons"></i></td>
                        <th width="5%">Component Type</th>
                        <th width="8%">Title</th>
                        <th width="12%" class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody id="sortable">
                    @foreach($components as $list)
                        @php
                            $componentType = "";
                            if (isset($list->type)){
                                $componentType = $list->type;
                            } else {
                                $componentType = $list->component_type;
                            }
                        @endphp
                        <tr data-index="{{ $list->id }}" data-position="{{ $list->component_order }}">
                            <td><i class="icon-cursor-move icons"></i></td>
                            <td>{{ ucwords(str_replace('_', ' ', $componentType)) }} {!! $list->status == 0 ? '<span class="inactive"> ( Inactive )</span>' : '' !!}</td>
                            <td>{{ $list->name  }}</td>
                            <td class="text-right">
                                <a href="{{ url("$edit/$list->id") }}" role="button" class="btn-sm btn-outline-info border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                <a href="#" remove="{{ url("$destroy/$list->id") }}" class="border-0 btn-sm btn-outline-danger delete_btn" data-id="{{ $list->id }}" title="Delete">
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
    <script type="text/javascript">
        var auto_save_url = "{{ url($componentSort) }}";
    </script>
@endpush





