@section('component_type_selector')

	<!-- # Section add component -->
	<div class="card">
		<div class="card-content collapse show">
			<div class="card-body card-dashboard">
				<h4 class="pb-1"><strong>Add section components</strong></h4>
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label for="category_type">Select Component Type</label>
							<select id="component_type" class="form-control" name="component_type" aria-invalid="false">
                                <option value="text_with_image_right">APPS - Text with image right</option>

                                <option value="title_text_editor">VAS - Title with text editor</option>
                                <option value="editor_only_section">VAS - Editor Only</option>
                                <option value="accordion_section">VAS - Accordion</option>


								<option value="text_with_image_bottom">APPS - Text with image bottom</option>
								<option value="slider_text_with_image_right">APPS - Slider text with image right</option>
								<option value="video_with_text_right">APPS - Video with text right</option>
								<option value="multiple_image_banner">APPS - Multiple image banner</option>
								<option value="pricing_sections">APPS - Pricing Multiple table</option>
							</select>
						</div>
						<div class="form-group">
							<a id="add_component_btn" href="{{ route("app-service-product.create") }}" class="btn btn-primary  round btn-glow px-1" data-toggle="modal" data-target="#text_with_image_right"><i class="la la-plus"></i>
								Add Component
							</a>
						</div>
					</div>
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="category_type">Component Preview</label>
							<div id="component_preview" class="component_preview" style="max-width: 400px;min-height: 200px;">
								<img id="component_preview_img" class="img-fluid" style="border: 1px solid #eee;" src="{{asset('app-assets/images/app_services/text_with_image_right.png')}}" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection




@section('component_modal_toadd')

<!-- # VAS Component modal -->
@include('admin.app-service.details.section.component_modal.title_text_editor')
@include('admin.app-service.details.section.component_modal.editor_only_section')

<!-- Accordion content -->
@include('admin.app-service.details.section.component_modal.accordion.accordion')

<!-- # Apps Component modal -->
@include('admin.app-service.details.section.component_modal.text_with_image_right')
@include('admin.app-service.details.section.component_modal.text_with_image_bottom')
@include('admin.app-service.details.section.component_modal.video_with_text_right')
@include('admin.app-service.details.section.component_modal.pricing_sections')


<!-- multi image slider -->
@include('admin.app-service.details.section.component_modal.slider.slider_text_with_image_right')
@include('admin.app-service.details.section.component_modal.slider.edit_slider_text_with_image_right')
@include('admin.app-service.details.section.component_modal.slider.single_item_edit_slider_text_with_image_right')
<!-- multi image banner -->
@include('admin.app-service.details.section.component_modal.multi_banner.multiple_image_banner')
@include('admin.app-service.details.section.component_modal.multi_banner.edit_multiple_image_banner')
@include('admin.app-service.details.section.component_modal.multi_banner.single_item_edit_multiple_image_banner')

@endsection



