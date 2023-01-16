@extends('layouts.admin')
@section('title', 'Section Edit')
@section('card_name', 'Section Edit')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('life-at-banglalink/general') }}">Section List</a></li>
    <li class="breadcrumb-item active"> {{$sections->title_en}}</li>
@endsection
@section('action')
    <a href="{{ url("life-at-banglalink/general") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel</a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">


                    <div class="card-body card-dashboard">
                        <form id="general_section" role="form" action="{{ url("life-at-banglalink/general/$sections->id/update") }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                <input type="hidden" name="section_category" value="{{ $sections->category }}">
                                <div class="form-group col-md-6 {{ $errors->has('title_en') ? ' error' : '' }}">
                                    <label for="title_en" class="required">Title_en (English)</label>
                                    <input type="text" name="title_en"  class="form-control section_name" placeholder="Enter title_en (english)"
                                           value="{{ $sections->title_en }}" required data-validation-required-message="Enter slider title_en (english)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_en'))
                                        <div class="help-block">  {{ $errors->first('title_en') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('slug') ? ' error' : '' }}">
                                    <label for="slug" class="required">Slug</label>
                                    <input type="text" name="slug"  class="form-control section_slug"
                                           value="{{ $sections->slug }}" required readonly  data-validation-required-message="Slug name can not be emply">
                                    <div class="help-block"></div>
                                    @if ($errors->has('slug'))
                                        <div class="help-block">  {{ $errors->first('slug') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
                                    <label for="title_bn" class="required">Title_bn (Bangla)</label>
                                    <input type="text" name="title_bn"  class="form-control" placeholder="Enter title_bn (english)"
                                           value="{{ $sections->title_bn }}" required data-validation-required-message="Enter slider title_bn (english)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title_bn'))
                                        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="category_type">Select section type</label>
                                    <select class="form-control" name="category_type" aria-invalid="false">
                                            <option value="news_on_top" @if($sections->category_type == 'news_on_top') selected @endif>Life at banglalink section</option>
                                            <option value="program_section" @if($sections->category_type == 'program_section') selected @endif>Program section</option>
                                        </select>
                                </div>

                                <div class="form-group col-md-5 {{ $errors->has('image_url') ? ' error' : '' }}">
                                    <label for="alt_text" class="">Banner Image (optional)</label>
                                    <div class="custom-file">
                                        <input type="file" name="image_url" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <span class="text-primary">Please given file type (.png, .jpg)</span>

                                    <div class="help-block"></div>
                                    @if ($errors->has('image_url'))
                                        <div class="help-block">  {{ $errors->first('image_url') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-1">
                                    <img src="{{ config('filesystems.file_base_url') . $sections->image}}"style="height:70px;width:70px;display:none" id="imgDisplay">
                                </div>
                                @include('layouts.partials.common_types.text_area_plane',['component'=>$sections])

                                @if( !empty($sections->additional_info) )
                                    @php $additional_info = json_decode($sections->additional_info); @endphp
                                @endif
                                <div class="form-group col-md-6 {{ $errors->has('sliding_speed') ? ' error' : '' }}">
                                    <label for="sliding_speed" class="required">Sliding Speed</label>
                                    <input type="text" name="sider_info[sliding_speed]" oninput="this.value =Number(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"  class="form-control" placeholder="Enter sliding speed (sec)"  min="1" max="300"
                                           value="{{ ( !empty( $additional_info->sider_info->sliding_speed ) ) ? $additional_info->sider_info->sliding_speed : old("additional_info.sider_info.sliding_speed") ?? '' }}"
                                           required data-validation-required-message="Enter price info">
                                    <div class="help-block"><small>Default value 10</small></div>
                                    @if ($errors->has('sliding_speed'))
                                        <div class="help-block">  {{ $errors->first('sliding_speed') }}</div>
                                    @endif
                                </div>


                                <div class="col-md-6">
                                    <label for="alt_text"></label>
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="is_active" value="1" id="input-radio-15" @if( $sections->is_active == 1 ) checked @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="is_active" value="0" id="input-radio-16" @if( $sections->is_active == 0 ) checked @endif>
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>

                                @include('admin.ecarrer-items.additional.call_to_actions',['ecarrer_item'=>$sections])

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> SAVE
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $sections->id }}"/>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop


@push('page-js')

    <script type="text/javascript">
        jQuery(document).ready(function($){


            $('input.section_name').on('keyup', function(){
                var sectionName = $('#general_section').find('.section_name').val();
                var sectionNameLower = sectionName.toLowerCase();
                var sectionNameRemoveSpace = sectionNameLower.replace(/\s+/g, '_');

                $('#general_section').find('.section_slug').empty().val(sectionNameRemoveSpace);

                // console.log(sectionNameRemoveSpace);
            });

            $('.remove_photo').on('click', function (e) {
            e.preventDefault();
            var cnfrm = confirm("Do you want to delete this photo?");
            if (cnfrm) {
                var itemId = $(this).attr('href');

                var thisObj = $(this);

                $.ajax({
                    url: '{{ url("ecarrer-items/photo-delete")}}/' + itemId,
                    cache: false,
                    type: "GET",
                    success: function (result) {
                        if (result.success == 1) {
                            swal.fire({
                                title: result.message,
                                type: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            $(thisObj).parents('.form-group').html("");

                        } else {
                            swal.close();
                            swal.fire({
                                title: result.message,
                                timer: 2000,
                                type: 'error',
                            });
                        }

                    },
                    error: function (data) {
                        swal.fire({
                            title: 'Status change process failed!',
                            type: 'error',
                        });
                    }
                });
            }


        });

        });
    </script>

@endpush



