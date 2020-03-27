<div class="card">
    <div class="card-content collapse show">
        <div class="card-body card-dashboard">
            <h4 class="pb-1"><strong>Info & Tips List</strong>
            <a href="{{ url('roaming/info-tips-create') }}" class="btn btn-sm btn-info pull-right">Add Info & Tips</a>
            </h4>
            <div class="row">

                <div class="col-md-12 col-xs-12">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="22%">Name</th>
                                <th width="22%">Card Text</th>
                                <th width="22%">URL</th>
                                <th width="">Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($info as $v)
                            <tr>

                                <td>
                                    {{ $v->name_en }} 
                                </td>
                                <td>
                                   {{ $v->card_text_en }} 
                                </td>
                                <td>
                                   {{ $v->url_slug }} 
                                </td>
                                <td>
                                   {{ $v->category_name }} 
                                </td>
                                
                                <td class="text-center">

                                    <a href="{{ url('roaming/edit-info-component/'.$v->id)}}" class="btn btn-sm btn-info">
                                        Components
                                    </a>
                                    <a href="{{ url('roaming/edit-info/'.$v->id)}}" class="btn btn-sm btn-outline-primary">
                                        <i class="la la-edit"></i>
                                    </a>
                                    <a href="{{ url('roaming/delete-info/'.$v->id)}}" class="btn btn-sm btn-outline-red delete_offers">
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
    </div>
</div>

@push('page-js')

<script type="text/javascript">

$(function(){
    $(".delete_offers").on('click', function(){
       var conf = confirm("Do you want to delete this offer?");
       if(conf){
           return true;
       }
       return false;
    });
});
</script>

@endpush