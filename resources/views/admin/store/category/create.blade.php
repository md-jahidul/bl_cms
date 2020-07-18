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
                                <label for="name" class="required">Enter Category Name:</label>
                                <input type="text"
                                       required

                                       value="@if(isset($storeCategory)) {{$storeCategory->name}} @elseif(old("name")) {{old("name")}} @endif" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Store Category..">
                                @if(isset($storeCategory))
                                    <input type="hidden" name="id" value="{{$storeCategory->id}}">
                                @endif
                                <small class="text-danger"> @error('name') {{ $message }} @enderror </small>

                            </div>

                        </div>


                        <div class="col-5 mb-2" >

                            <button type="submit" id="submitForm" style="width:100%" class="btn @if(isset($storeCategory)) btn-success @else btn-info @endif ">
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
