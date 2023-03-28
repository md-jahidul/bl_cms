@extends('layouts.admin')
@section('title', 'Group Components List')
@section('card_name', 'Group Components List')
@section('breadcrumb')
    <li class="breadcrumb-item active"><strong>Group Components List</strong></li>
@endsection
@section('action')
    <a href="{{route('group.components.create')}}" class="btn btn-primary round btn-glow px-2 create_component" role="button">
        <i class="la la-plus"></i>Add Group Component
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
                            <th width="25%">Component Type</th>
                            <th class="text-center">User Can Enable/Disable</th>
                            <th width="25%" class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody id="">
                        @foreach($components as $index=> $component)
                            <tr width="3%" data-index="{{ $component['id'] }}" data-position="{{ $component['display_order'] }}"
                                data-component-id="{{ $component['component_id'] ?? 0 }}" style="width: 100%">
                                <td>{{ $component['title_en'] }}</td>
                                <td class="text-center">
                                    @if(isset($component['is_eligible']))
                                        {{ $component['is_eligible'] == 1 ? "Yes" : "No" }}
                                    @endif
                                </td>
                                <td class="action text-right">
                                    
                                    @if($component['active'] == 0)
                                        <a href="{{ route('group.components.status.update', $component['id']) }}" data-value="enable  {{ $component['title_en'] }}"
                                            class="btn btn-danger border-0 change_status" title="Click to enable">Disabled</a>
                                    @else
                                        <a href="{{ route('group.components.status.update', $component['id']) }}" data-value="disable {{ $component['title_en'] }}"
                                            class="btn btn-success border-0 change_status" title="Click to disable">Enabled</a>
                                    @endif
                                
                                    <a href="{{route('group.components.edit', $component['id'])}}">
                                        <button type="button"class="btn btn-secondary-info border-0"><i class="la la-pencil" aria-hidden="true" ></i></button>
                                    </a>        
                                            
                                    <button  class="delete_component border-0 btn btn-danger delete_btn" data-id="{{ $component['id'] }}" title="Delete">
                                        <i class="la la-trash"></i>
                                    </button>
                                    
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

@push('page-js')
    <script>
        $(document).ready(function () {
            
            $('.change_status').click(function (event) {
                event.preventDefault()
                let status = $(this).attr('data-value');
                let url = $(this).attr('href');
                let confirmPopupParams = {
                    title: 'Are you sure?',
                    text: "You want to " + status,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#77ba6a',
                    cancelButtonColor: '#a9afa9',
                    confirmButtonText: 'Yes'
                };

                let successPopupParams = {
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
            
            $('.delete_component').click(function (event) {
                event.preventDefault()
                let id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure? ching',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#a9afa9',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('group-components/destroy') }}/"+id,
                            methods: "get",
                            success: function (res) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success',
                                );
                                setTimeout(redirect, 2000)
                                function redirect() {
                                    window.location.href = "{{ url('group-components') }}"
                                }
                            }
                        })
                    }
                })
            })
        });
    </script>
@endpush





