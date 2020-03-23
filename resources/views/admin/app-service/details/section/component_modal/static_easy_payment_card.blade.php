<!-- Modal -->
<div class="modal fade" id="static_easy_payment_card" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal_xl_custom " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel"><strong>Static Component: Easy payment card</strong></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <form id="product_details_form" role="form" action="{{ route('app_service.details.store', [$tab_type, $product_id ]) }}" method="POST" novalidate enctype="multipart/form-data">
                @csrf
              <div class="modal-body">
                <div class="row">

                		{{ Form::hidden('sections[section_name]', 'Easy Payment card' ) }}
                		{{ Form::hidden('sections[section_type]', 'static_easy_payment_card' ) }}
                		{{ Form::hidden('sections[tab_type]', $tab_type ) }}
                		{{ Form::hidden('sections[category]', 'component_sections' ) }}
                		{{ Form::hidden('component[0][component_type]', 'easy_payment_card' ) }}

                  
                  <div class="col-sm-12">
                    <div class="static_component_preview form-group">
                      <img class="img-fluid" style="border: 1px solid #eee;max-width: 400px;" src="{{asset('app-assets/images/app_services/static_easy_payment_card.png')}}" alt="">
                    </div>
                  </div>

                  <br>
                  <br>
  							
							
    							<div class="col-md-6">
    							    <div class="form-group">
    							        <label for="title" class="mr-1">Status:</label>
    							        <input type="radio" name="sections[status]" value="1" id="active" checked>
    							        <label for="active" class="mr-1">Active</label>

    							        <input type="radio" name="sections[status]" value="0" id="inactive">
    							        <label for="inactive">Inactive</label>
    							    </div>
    							</div>

    							<div class="form-group col-md-6">
    									<!-- 0 - NO, 1 - Yes : Component has multiple component or not -->
    									{{ Form::hidden('sections[multiple_component]', 0 ) }}
    							</div>

                    

                </div>

              </div>
              <div class="modal-footer">
              		{{ Form::hidden('sections[id]', null, ['class' => 'section_id'] ) }}
              		{{ Form::hidden('component[0][id]', null, ['class' => 'component_id'] ) }}

                <a type="button" href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                <button id="form_save" type="submit" name="save" class="btn btn-primary">Add Easy payment card</button>
                <button id="form_update" type="submit" name="update" class="btn btn-primary" style="display: none;">Update</button>
              </div>
          </form>
        </div>
    </div>
</div><!-- /.modal -->
<!-- Modal -->


@push('page-css')
 <style>
     .modal-xl.modal_xl_custom {
         max-width: 80%;
         margin-left: 10%;
       	margin-right: 10%;
     }
 </style>
@endpush