@extends('layouts.master-layout')


@section('main-content')

    <!-- general form elements -->
    <div class="col-md-6 offset-md-3 pt-5">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Question</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('question.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="q_name">Question name</label>
                        <input type="text" name="question_text" class="form-control" id="q_name" placeholder="Enter question">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Point</label>
                        <input type="number" name="point" class="form-control" id="exampleInputPassword1" placeholder="Enter point">
                    </div>

                    <div class="form-group">
                        <label>Tag</label>
                        <select class="form-control" name="tag_id">
                            <option>--Select tag--</option>
                            @if(isset($tags))
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <spen class="text-muted mt-5">Options</spen><spen class="text-muted mt-5 offset-9">Answer</spen>
                    <hr class="mt-1">

                    <div class="form-group row option">
                        <label for="option" class="col-sm-2 control-label options-count">Option - 1</label>
                        <div class="col-sm-8">
                            <input type="text" name="option[]" class="form-control option-1" id="option" placeholder="Enter option">
                        </div>
                        {{-- Answer--}}
                        <div class="col-sm-2">
                            <input type="radio" name="answer[]" data-id="option-1" value="1" class="answer">
                        </div>
                    </div>

                    <button type="button" class="btn-sm btn-success offset-8 create-option"><i class="fa fa-plus"></i> Add more option</button>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card -->


    {{--{!! Form::open(array('url' => 'foo/bar','method' => 'POST')) !!}--}}

    {{--{{Form::text("username",--}}
             {{--old("username") ? old("username") : (!empty($user) ? $user->username : null),--}}
             {{--[--}}
                {{--"class" => "form-group user-email",--}}
                {{--"placeholder" => "Username",--}}
             {{--])--}}
    {{--}}--}}

    {{--{{Form::password("password",--}}
             {{--[--}}
                {{--"class" => "form-group",--}}
                {{--"placeholder" => "Your Password",--}}
             {{--])--}}
    {{--}}--}}

    {{--{!! Form::close() !!}--}}

@stop

@push('scripts')
    <script>
        $(function () {

            // $(document).on('click', '.answer', function () {
            //     var get_option = $(this).attr('data-id')
            //     var option_value = $('.'+get_option).val();
            //     $(this).val(option_value)
            //     console.log(option_value);
            // })

            var click_count = 1;
            $(document).on('click', '.create-option', function () {

                var option_count = $('.options-count')
                var total_option = option_count.length + 1
                click_count++

                var input = '<label for="option" class="col-sm-2 control-label mt-3 options-count delete-option'+total_option+'">Option - '+total_option+'</label>\n' +
                    ' <div class="col-sm-8 mt-3 delete-option'+total_option+'">\n' +
                    '     <input type="text" name="option[]" class="form-control option-'+total_option+'" id="option" placeholder="Enter option">\n' +
                    ' </div>\n' +
                    ' <div class="col-sm-1 mt-3 delete-option'+total_option+'">\n' +
                    '     <input type="radio" name="answer[]" data-id="option-'+total_option+'" value="'+total_option+'" class="answer" id="answer">\n' +
                    ' </div>\n' +
                    ' <div class="col-sm-1 mt-3 delete-option'+total_option+'">\n' +
                    '     <button type="button" class="btn-sm btn-danger remove-option delete-option'+total_option+'" data-id='+total_option+'><i data-id='+total_option+' class="fa fa-trash"></i></button>\n' +
                    ' </div>';
                $('.option').append(input)
            })

            $(document).on('click', '.remove-option', function (event) {
                var rowId = $(event.target).attr('data-id');
                $('.delete-option'+rowId).remove();
            })
        })
    </script>
@endpush





