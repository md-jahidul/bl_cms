@extends('layouts.admin')
@section('title', 'Search Content')
@section('card_name', 'Search Content| List')

@section('action')
    <a href="{{ route('mybl-search-content.create') }}" class="btn btn-info btn-sm btn-glow px-2">
       Add New
    </a>
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Display Title</th>
                                <th>Search Contents</th>
                                <th>Navigation Action</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($search_contents as $key=>$content)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $content->display_title }}</td>
                                    <td>{{ implode(',', json_decode($content->search_content , true)) }}</td>
                                    <td>{{ $content->navigation_action }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <form action="{{route('app-launch.delete', $content->id)}}" method="post">
                                                {{csrf_field()}}
                                                {{ method_field('delete') }}
                                                <button class="btn btn-sm btn-icon btn-outline-danger delete" type="submit"><i class="la la-remove"></i></button>
                                            </form>
                                            <a href="{{ route('mybl-search-content.edit', $content->id) }}" class="btn btn-sm btn-icon btn-outline-success edit" title="edit"><i class="la la-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $search_contents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop







