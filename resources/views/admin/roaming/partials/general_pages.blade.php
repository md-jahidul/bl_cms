<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <h4 class="pb-1"><strong>General Pages</strong></h4>
            <div class="row">

                <div class="col-md-12 col-xs-12">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="22%">Page</th>
                                <th width="22%">Title</th>
                                <th width="">Short Text</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $p)
                            <tr>
                                <td>{{ $p->page_type }}</td>
                                <td>
                                    {{ $p->title_en }}
                                </td>
                                <td>
                                   {{ $p->short_text_en }}
                                </td>

                                <td class="text-center">

                                    <a href="{{ url('roaming/general-page-component/page/'.$p->id)}}" class=" page_edit">
                                        <i class="la la-edit"></i>
                                    </a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>
</div>
