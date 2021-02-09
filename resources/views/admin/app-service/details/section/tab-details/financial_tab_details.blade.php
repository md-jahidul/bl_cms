@section('component_type_selector')
	<!-- # Section add component -->
{{--	<div class="card">--}}
{{--		<div class="card-content collapse show">--}}
{{--			<div class="card-body card-dashboard">--}}
{{--				<h4 class="pb-1"><strong>Add section components</strong></h4>--}}
{{--				<div class="row">--}}
{{--					<div class="col-sm-4">--}}
{{--						<div class="form-group">--}}
{{--							<label for="category_type">Select Component Type</label>--}}
{{--							<select id="component_type" class="form-control" name="component_type" aria-invalid="false">--}}
{{--								<option value="editor_only_section">Editor Only</option>--}}
{{--								<option value="title_text_editor">Title with text editor</option>--}}
{{--								<option value="accordion_section">Accordion</option>--}}
{{--								<option value="static_easy_payment_card">Static Component - Easy payment card</option>--}}
{{--                                <option value="pricing_sections">Pricing Multiple table</option>--}}
{{--                            </select>--}}
{{--						</div>--}}
{{--						<div class="form-group">--}}
{{--							<a id="add_component_btn" href="{{ route("app-service-product.create") }}" class="btn btn-primary  round btn-glow px-1" data-toggle="modal" data-target="#title_text_editor"><i class="la la-plus"></i>--}}
{{--								Add Component--}}
{{--							</a>--}}
{{--						</div>--}}
{{--					</div>--}}


{{--					<div class="col-sm-4"></div>--}}
{{--					<div class="col-sm-4">--}}
{{--						<div class="form-group">--}}
{{--							<label for="category_type">Component Preview</label>--}}
{{--							<div id="component_preview" class="component_preview" style="max-width: 400px;min-height: 200px;">--}}
{{--								<img id="component_preview_img" class="img-fluid" style="border: 1px solid #eee;" src="{{asset('app-assets/images/app_services/title_text_editor.png')}}" alt="">--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--	</div>--}}
@endsection

@section('component_modal_toadd')

<!-- # VAS Component modal -->
{{--@include('admin.app-service.details.section.component_modal.title_text_editor')--}}
{{--@include('admin.app-service.details.section.component_modal.editor_only_section')--}}

<!-- # Table Component modal -->
{{--@include('admin.app-service.details.section.component_modal.pricing_sections')--}}

<!-- Accordion content -->
{{--@include('admin.app-service.details.section.component_modal.accordion.accordion')--}}

<!-- static component -->
{{--@include('admin.app-service.details.section.component_modal.static_easy_payment_card')--}}


@endsection
