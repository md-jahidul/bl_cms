@extends('layouts.master-layout')

@section('main-content')
    
    <div class="card">
        <div class="card-header">
            Create Page
        </div>
        <div class="card-body">
            {{-- <form action="" method="post"></form> --}}
            {{-- create page form --}}
            <form action="{{ route('page.update',$page->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">Title :</label>
                    <input value="{{$page->title}}" name="title" type="title" class="form-control" id="title" aria-describedby="tilehelper" placeholder="Enter your page title">
                    <small id="tilehelper" class="form-text text-muted">Enter your page title.</small>
                </div>
                <div class="form-group">
                    <label for="MetaData">Meta Data :</label>
                    <input value="{{$page->meta_data}}"  name="meta_data" type="text" class="form-control" id="MetaData" placeholder="Enter Meta Data">
                </div>
                <div class="form-group">
                    <label for="MetaDiscription">Meta Discription :</label>
                    <input value="{{$page->meta_discription}}"  name="meta_discription" type="text" class="form-control" id="MetaDiscription" placeholder="Enter Meta Discription">
                </div>
                <div class="form-group">
                    <label for="keywords">keywords :</label>
                    <input  value="{{$page->keywords}}"  name="keywords" aria-describedby="keywordshelper" type="text" class="form-control" id="MetaDiscription" placeholder="Enter Meta keywords">
                    <small id="keywordshelper" class="form-text text-muted">Enter commas to saperate the Keywords.</small>
                </div>
                 <div class="form-group">
                    <label for="page_build_data">Build Your Page:</label>
                    <small id="pageBuildershelper" class="form-text text-muted">build your page according to your needs.</small>
                    <textarea name="page_build_data" aria-describedby="pageBuildershelper" id="page_build_data" aria-describedby="page_build_data" class="form-control" rows="20">{{$page->page_build_data}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            {{-- create page form --}}


        </div>
    </div>
@stop
@push('scripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#page_build_data',
            plugins: "image link lists searchreplace fullscreen hr print preview " +
                "anchor code save emoticons directionality spellchecker " +
                "N1ED BootstrapEditor Flmngr ImgPen Translator",

            toolbar: "image | cut copy | undo redo | styleselect searchplace formatselect " +
                "link | fullscreen | bold italic underline strikethrough " +
                "| forecolor backcolor | removeformat | alignleft aligncenter " +
                "alignright alignjustify | bullist numlist outdent indent " +
                "| removeformat | Translator TranslatorReverse TranslatorConf " +
                "| blockquote hr anchor print spellchecker | preview " +
                "code save cancel | emoticons ltr rtl",
        });
    </script>
@endpush

