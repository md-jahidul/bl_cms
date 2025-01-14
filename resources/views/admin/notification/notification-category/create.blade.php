@extends('layouts.admin')
@section('title', 'Notification Category')
@section('card_name', 'Notification Category')
@section('breadcrumb')

    @if(isset($notificationCategory))
        <li class="breadcrumb-item active">Update Notification Category</li>
    @else
        <li class="breadcrumb-item active">Create Notification Category</li>
    @endif

@endsection

@section('action')
    <a href="{{route('notificationCategory.index')}}" class="btn btn-primary  round btn-glow px-2"><i class="la la-plus"></i>
        Notification Category List
    </a>
@endsection

@section('content')
    <div class="card mb-0 px-1" style="box-shadow:none;">
        <div class="card-content">
            <div class="card-body">
                <form class="form" method="POST" action="@if(isset($notificationCategory)) {{route('notificationCategory.update',$notificationCategory->id)}}
                @else {{route('notificationCategory.store')}} @endif" novalidate >
                    @csrf
                    @if(isset($notificationCategory))
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

                                       value="@if(isset($notificationCategory)) {{$notificationCategory->name}} @elseif(old("name")) {{old("name")}} @endif" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Notification Category..">
                                @if(isset($notificationCategory))
                                    <input type="hidden" name="id" value="{{$notificationCategory->id}}">
                                @endif
                                <small class="text-danger"> @error('name') {{ $message }} @enderror </small>

                            </div>

                        </div>


                        <div class="col-5 mb-2" >

                            <button type="submit" id="submitForm" style="width:100%" class="btn @if(isset($notificationCategory)) btn-success @else btn-info @endif ">
                                @if(isset($notificationCategory)) Update Notification Category @else Create Notification Category @endif
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