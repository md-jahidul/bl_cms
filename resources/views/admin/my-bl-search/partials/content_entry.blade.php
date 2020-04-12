<section id="bottom-border">
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form class="form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="display_title">Display Title</label>
                                                    <input
                                                        type="text"
                                                        id="display_title"
                                                        class="form-control"
                                                        spellcheck="true"
                                                        placeholder="e.g. Profile"
                                                        name="display_title">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="search_content">Search Content</label>
                                                    <div class="edit-on-delete form-control" id="search-content"></div>
                                                    <small class="info">Press Enter or Comma to create a new search tag, Backspace or Delete to remove the last one.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @php
                                                    $actionList = Helper::navigationActionList();
                                                @endphp
                                                <div class="form-group">
                                                    <label for="display_title">Navigate Action</label>
                                                    <select name="component_identifier" class="browser-default custom-select"
                                                            id="navigate_action" required>
                                                        <option value="">Select Action</option>
                                                        @foreach ($actionList as $key => $value)
                                                            <option
                                                                value="{{ $key }}">
                                                                {{ $value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div id="append_div" class="col-md-6">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="display_title">Description</label>
                                                <textarea
                                                    type="text"
                                                    id="display_title"
                                                    class="form-control"
                                                    rows="8"
                                                    spellcheck="true"
                                                    placeholder="e.g. Profile"
                                                    name="display_title">
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('style')
    <link rel="stylesheet" href="{{asset('app-assets/vendors/css/forms/tags/tagging.css')}}">
@endpush

@push('page-js')
   <script src="{{asset('app-assets')}}/vendors/js/forms/tags/tagging.min.js" type="text/javascript"></script>
   <script src="{{asset('app-assets')}}/js/scripts/forms/tags/tagging.js" type="text/javascript"></script>

    <script>
        $(function () {
            // add dial number
            let dial_html = ` <div class="form-group other-info-div">
                                        <label>Dial Number</label>
                                        <input type="text" name="other_info" class="form-control"  placeholder="Enter Valid Number" required>
                                        <div class="help-block"></div>
                                    </div>`;

           let url_html = ` <div class="form-group other-info-div">
                                        <label>Redirect External URL</label>
                                        <input type="text" name="other_info" class="form-control"  placeholder="Enter Valid URL" required>
                                        <div class="help-block"></div>
                                    </div>`;


            $('#navigate_action').on('change', function () {
                let action = $(this).val();
                if (action == 'DIAL') {
                    $("#append_div").html(dial_html);
                } else if (action == 'URL') {
                    $("#append_div").html(url_html);
                } else {
                    $(".other-info-div").remove();
                }
            })
        });
    </script>

@endpush
