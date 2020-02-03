@extends('layouts.admin')
@section('title', 'Item Edit')
@section('card_name', 'Item Edit')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url("ecarrer-items/$parent_id/list") }}">Item List</a></li>
    <li class="breadcrumb-item active"> {{$ecarrer_item->title}}</li>
@endsection
@section('action')
    <a href="{{ url("ecarrer-items/$parent_id/list") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel</a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">


                    <div class="card-body card-dashboard">
                        <form id="general_section" role="form" action="{{ url("ecarrer-items/$parent_id/$ecarrer_item->id/update") }}" method="POST" novalidate enctype="multipart/form-data">
                            @csrf
                            {{method_field('POST')}}
                            <div class="row">
                                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title (English)</label>
                                    <input type="text" name="title"  class="form-control section_name" placeholder="Enter title (english)"
                                           value="{{ $ecarrer_item->title }}" required data-validation-required-message="Enter slider title (english)">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label>
                                        <textarea name="description" class="form-control" rows="5"
                                                  placeholder="Enter description">{{ $ecarrer_item->description }}</textarea>
                                    </div>
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
                                    @if( !empty($ecarrer_item->image) )
                                        <img style="height:70px;width:70px;display:block" src="{{ config('filesystems.file_base_url') . $ecarrer_item->image}}" id="imgDisplay">
                                    @else
                                        <img style="height:70px;width:70px;display:none" id="imgDisplay">
                                    @endif
                                    
                                </div>

                                <div class="col-md-6">
                                    <label for="alt_text"></label>
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="is_active" value="1" id="input-radio-15" @if( $ecarrer_item->is_active == 1 ) checked @endif>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="is_active" value="0" id="input-radio-16" @if( $ecarrer_item->is_active == 0 ) checked @endif>
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>


                                <!-- Include additional field layout for individual section requirement -->
                                @if( $ecarrer_section_slug == 'life_at_bl_teams' )
                                    @include('admin.ecarrer-items.additional.call_to_actions')
                                @endif

                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> SAVE
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $ecarrer_item->id }}"/>
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

            

        });
    </script>

@endpush



