@extends('layouts.admin')
@section('title', 'Store Category')
@section('card_name', 'Store Category')
@section('breadcrumb')

    @if(isset($storeCategory))
        <li class="breadcrumb-item active">Update Store Category</li>
    @else
        <li class="breadcrumb-item active">Create Store Category</li>
    @endif

@endsection

@section('action')
    <a href="{{route('storeCategory.index')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Store Category List
    </a>
@endsection

@section('content')
    <div class="card mb-0 px-1" style="box-shadow:none;">
        <div class="card-content">
            <div class="card-body">
                <form class="form" method="POST" action="@if(isset($storeCategory)) {{route('storeCategory.update',$storeCategory->id)}}
                @else {{route('storeCategory.store')}} @endif" novalidate >
                    @csrf
                    @if(isset($storeCategory))
                        @method('put')
                    @else
                        @method('post')
                    @endif
                    <div class="form-body">

                        <div class="col-5">
                            <div class="form-group">
                                <label for="name_en" class="required">Enter Category Name(English):</label>
                                <input type="text"
                                       required

                                       value="@if(isset($storeCategory)) {{$storeCategory->name_en}} @elseif(old("name_en")) {{old("name_en")}} @endif"
                                       name="name_en" class="form-control @error('name_en') is-invalid @enderror" id="name_en" placeholder="Enter Store Category..">
                                @if(isset($storeCategory))
                                    <input type="hidden" name="id" value="{{$storeCategory->id}}">
                                @endif
                                <small class="text-danger"> @error('name_en') {{ $message }} @enderror </small>

                            </div>

                        </div>

                        <div class="col-5">
                            <div class="form-group">
                                <label for="name_bn" class="required">Enter Category Name(Bangla):</label>
                                <input type="text"
                                       required
                                       value="@if(isset($storeCategory)) {{$storeCategory->name_bn}} @elseif(old("name_bn")) {{old("name_bn")}} @endif"
                                       name="name_bn" class="form-control @error('name_bn') is-invalid @enderror" id="name_bn" placeholder="Enter Store Category..">
                                @if(isset($storeCategory))
                                    <input type="hidden" name="id" value="{{$storeCategory->id}}">
                                @endif
                                <small class="text-danger"> @error('name_bn') {{ $message }} @enderror </small>

                            </div>

                        </div>


                        <div class="col-5">
                            <div class="form-group">
                                <label for="is_active">Active Status:</label>
                                <select value="@if(isset($storeCategory)) {{$storeCategory->is_active}} @elseif(old("is_active")) {{old("is_active")}} @endif"
                                        class="form-control" id="is_active"
                                        name="is_active">
                                    <option value="1"
                                            @if(isset($storeCategory) && $storeCategory->is_active == "1") selected @endif>
                                        Active
                                    </option>
                                    <option value="0"
                                            @if(isset($storeCategory) && $storeCategory->is_active == "0") selected @endif>
                                        InActive
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="col-5 mb-2" >
                            <button type="submit" id="submitForm" style="float:right;" class="btn @if(isset($storeCategory)) btn-success @else btn-info @endif ">
                                @if(isset($storeCategory)) Update Store Category @else Create Store Category @endif
                            </button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>


@endsection

@section('content_right_side_bar')
    <h1>
        List
    </h1>
@endsection


@push('style')

@endpush
@push('page-js')


@endpush
