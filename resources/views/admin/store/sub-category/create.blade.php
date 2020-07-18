@extends('layouts.admin')
@section('title', 'Store Sub Category')
@section('card_name', 'Store Sub Category')
@section('breadcrumb')

    @if(isset($storeSubCategory))
        <li class="breadcrumb-item active">Update Store Sub Category</li>
    @else
        <li class="breadcrumb-item active">Create Store Sub Category</li>
    @endif

@endsection

@section('action')
    <a href="{{route('subStore.index')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Store Sub Category List
    </a>
@endsection

@section('content')
    <div class="card mb-0 px-1" style="box-shadow:none;">
        <div class="card-content">
            <div class="card-body">
                <form class="form" method="POST" action="@if(isset($storeSubCategory)) {{route('subStore.update',$storeSubCategory->id)}}
                @else {{route('subStore.store')}} @endif" novalidate >
                    @csrf
                    @if(isset($storeSubCategory))
                        @method('put')
                    @else
                        @method('post')
                    @endif
                    <div class="form-body">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id" class="required">
                                  Select  Category Name :
                                </label>
                                <div class="controls">
                                    <select name="category_id" id="category_id"  class="form-control @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option @if(old("category_id")) {{ (old("category_id") == $category->id ? "selected":"") }}
                                                    @elseif(isset($store) && ($category->id == $store->category_id)) selected  @endif
                                                    value="{{$category->id}}" {{ (old("category_id") == $category->id ? "selected":"") }}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block"></div>
                                    <small class="text-danger"> @error('category_id') {{ $message }} @enderror </small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="required">Enter Sub Category Name:</label>
                                <input type="text"
                                       required

                                       value="@if(isset($storeSubCategory)) {{$storeSubCategory->name}} @elseif(old("name")) {{old("name")}} @endif" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Store Sub Category..">
                                @if(isset($storeSubCategory))
                                    <input type="hidden" name="id" value="{{$storeSubCategory->id}}">
                                @endif
                                <small class="text-danger"> @error('name') {{ $message }} @enderror </small>

                            </div>

                        </div>


                        <div class="col-5 mb-2" >

                            <button type="submit" id="submitForm" style="width:100%" class="btn @if(isset($storeSubCategory)) btn-success @else btn-info @endif ">
                                @if(isset($storeSubCategory)) Update Store Sub Category @else Create Store Sub Category @endif
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
