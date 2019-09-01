@extends('layouts.admin')
@section('title', 'questions List')
@section('card_name', 'Question List')
@section('breadcrumb')
    <li class="breadcrumb-item active">Short-Cuts List</li>
@endsection

{{-- @section('content_header')
    <p class="rounded">
       @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('danger') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @error('short_cut')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @enderror
        
    </p>
@endsection --}}

@section('main-content')

    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <div class="card-title">Short-Cuts List</div>
                </div>
                
                <!-- /.card-header -->
                <div class="card-body">

                   
                    <form action="{{route('UserShortcut.store')}}" method="post">
                        @csrf
                        @method('post')
                            <div class="row">
                                @foreach ($short_cuts as $key => $short_cut)
                                    <div class="col-1 my-1">
                                        <input value="{{$short_cut->id}}" @if (in_array ( $short_cut->tittle, $list_of_shortcuts)) checked @endif name="shortcut[]" type="checkbox" id="{{$short_cut->tittle}}">
                                    </div>
                                    <div class="col-3 my-1">
                                        <label for="{{$short_cut->tittle}}">{{$short_cut->tittle}}</label>
                                    </div>
                                @endforeach
                            </div>
                        <button type="submit" class="btn btn-info">Add</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <div class="card-title">Added ShortCuts List</div>
                </div>
                
                <!-- /.card-header -->
                <div class="card-body">
                    
                    <form action="{{route('serial.update',auth()->user()->id)}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            @foreach ($added_short_cuts as $added_short_cut)
                            
                                <div class="col-2 my-1">
                                    <select name="{{$added_short_cut->id}}" id="{{$added_short_cut->id.'p'}}" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                        <option value="0">0</option>
                                        <option @if ($added_short_cut->serial=="1") selected @endif value="1">1</option>
                                        <option @if ($added_short_cut->serial=="2") selected @endif value="2">2</option>
                                        <option @if ($added_short_cut->serial=="3") selected @endif value="3">3</option>
                                        <option @if ($added_short_cut->serial=="4") selected @endif value="4">4</option>
                                        <option @if ($added_short_cut->serial=="5") selected @endif value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-4 my-1">
                                    <label class="mr-sm-2 pt-2" for="{{$added_short_cut->id.'p'}}">{{$added_short_cut->tittle}}</label>
                                </div>
                        
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-sm btn-info">Set Priority</button>
                    </form>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>


@endsection

@section('content_right_side_bar')
    <h1>
        info
    </h1>
@endsection


@push('style')
    <link rel="stylesheet" href="{{asset('plugins')}}/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{asset('plugins')}}/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="{{asset('plugins')}}/icheck-bootstrap/icheck-bootstrap.min.css">
@endpush
@push('script')
    <script src="{{asset('plugins')}}/datatables/jquery.dataTables.js"></script>
    <script src="{{asset('plugins')}}/datatables/dataTables.bootstrap4.js"></script>
    <script src="{{asset('plugins')}}/sweetalert2/sweetalert2.min.js"></script>
    <script>
        
        // $(function () {
        //     $("#example1").DataTable();
        //     $('#example2').DataTable({
        //     "paging": true,
        //     "lengthChange": true,
        //     "lengthMenu": [[5,10, 25, 50], [5,10, 25, 50]],
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     });
        // });
        // $(function () {
        //     $("#example1").DataTable();
        //     $('#example3').DataTable({
        //     "paging": true,
        //     "lengthChange": true,
        //     "lengthMenu": [[5,10, 25, 50], [5,10, 25, 50]],
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     });
        // });

        

    </script>
@endpush