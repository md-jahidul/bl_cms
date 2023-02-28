@extends('layouts.admin')
@section('title', 'Programs')
@section('card_name', 'Programs')
@section('breadcrumb')
    <li class="breadcrumb-item active">Programs</li>
@endsection
@section('action')
    <a href="{{ url('programs/ennovatorbatches/create') }}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Add New
    </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <h4 class="menu-title pb-1"><strong>Ennovators Previous Batches</strong></h4>
                    <table class="table table-striped table-bordered"
                           role="grid" aria-describedby="Example1_info" style="">
                        <thead>
                        <tr>
                            <th width="3%">SL</th>
                            <th>Title</th>
                            <th width="30%">Slug</th>
                            <th width="15%">Status</th>
                            <th width="22%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if( !empty($sections) )
                        @foreach($sections as $key=> $section)
                            {{-- @php( $sectionType = str_replace(" ", "-", strtolower( $section->type->name ) )) --}}
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $section->title_en }}</td>
                                <td>{{ $section->slug }}</td>
                                <td>{{ ($section->is_active == 1) ? 'Active' : 'Inactive' }}</td>
                                <td class="text-center" width="22%">
                                    <a href="{{ url("programs/ennovatorbatches/$section->id/edit") }}" role="button" class="btn btn-outline-success border-0"><i class="la la-pencil" aria-hidden="true"></i></a>
                                    <a href="{{ url("programs/ennovatorbatches/destroy/$section->id") }}" role="button" class="btn btn-outline-success border-0" onclick="return confirm('Are you sure?');"><i class="la la-trash" aria-hidden="true"></i></a>
                                    @if( $section->has_items == 1 )
                                        <a href="{{ url("ecarrer-items/$section->id/list") }}" class="btn btn-outline-warning"><i class="la la-edit"></i> Section Items <span class="ml-1 badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{--{{ $childNumber }}--}}</span></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@stop


