@extends('layouts.admin')
@section('title', 'Item Create')
@section('card_name', 'Item Create')
@section('breadcrumb')
    <li class="breadcrumb-item active"> Item Create</li>
@endsection
@section('action')
    <a href="{{ url("ecarrer-items/$parent_id/list") }}" class="btn btn-warning  btn-glow px-2"><i class="la la-list"></i> Cancel </a>
@endsection
@section('content')
    <section>
        <div class="card">
            <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                    <div class="card-body card-dashboard">
                        <form id="general_section" role="form" action="{{ route('ecarrer.items.store', $parent_id) }}" method="POST" novalidate enctype="multipart/form-data">
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
                                    <label for="title" class="required">Title</label>
                                    <input type="text" name="title"  class="form-control section_name" placeholder="Section name"
                                           value="{{ old("title") ? old("title") : '' }}" required data-validation-required-message="Please enter Section name">
                                    <div class="help-block"></div>
                                    @if ($errors->has('title'))
                                        <div class="help-block">  {{ $errors->first('title') }}</div>
                                    @endif
                                </div>


                                <!-- Include additional field layout for individual section requirement -->
                                @if( $ecarrer_section_slug != 'life_at_bl_events' )
                                    @include('admin.ecarrer-items.additional.description')
                                @endif


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
                                    <img style="height:70px;width:70px;display:none" id="imgDisplay">
                                </div>


                                <div class="col-md-6">
                                    <label for="alt_text"></label>
                                    <div class="form-group">
                                        <label for="title" class="required mr-1">Status:</label>

                                        <input type="radio" name="is_active" value="1" id="input-radio-15" checked>
                                        <label for="input-radio-15" class="mr-1">Active</label>

                                        <input type="radio" name="is_active" value="0" id="input-radio-16">
                                        <label for="input-radio-16">Inactive</label>
                                    </div>
                                </div>

                                <!-- Include additional field layout for individual section requirement -->
                                @if( $ecarrer_section_slug == 'life_at_bl_teams' )
                                    @include('admin.ecarrer-items.additional.call_to_actions')
                                @endif



                                <input type="hidden" name="carrer_parent_item" value="{{$parent_id}}">
                                <div class="form-actions col-md-12 ">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary"><i
                                                    class="la la-check-square-o"></i> SAVE
                                        </button>

                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>


                    </form>
                </div>
            </div>
        </div>
    </section>

@stop

@push('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/plugins/forms/validation/form-validation.css') }}">
@endpush
@push('page-js')
    

@endpush






