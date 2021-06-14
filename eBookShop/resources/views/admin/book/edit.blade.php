@extends('layouts.main')
@section('style')
    <style>
        body {
            padding: 20px;
        }
        .image-area {
            position: relative;
            width: 50%;
            background: #333;
        }
        .image-area img{
            max-width: 100%;
            height: auto;
        }
        .remove-image {
            display: none;
            position: absolute;
            top: -10px;
            right: -10px;
            border-radius: 10em;
            padding: 2px 6px 3px;
            text-decoration: none;
            font: 700 21px/20px sans-serif;
            background: #555;
            border: 3px solid #fff;
            color: #FFF;
            box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
            text-shadow: 0 1px 2px rgba(0,0,0,0.5);
            -webkit-transition: background 0.5s;
            transition: background 0.5s;
        }
        .remove-image:hover {
            background: #E54E4E;
            padding: 3px 7px 5px;
            top: -11px;
            right: -11px;
        }
        .remove-image:active {
            background: #E54E4E;
            top: -10px;
            right: -11px;
        }
    </style>
@endsection
@section('name')
    <h1>Update</h1>
@endsection
@section('root')
    <a href="{{route('book.index')}}">
        Books
    </a>

@endsection
@section('model')
    Update book
@endsection
@section('content')
    <div class="container rounded bg-white">
        {!! Form::open(['method' => 'PATCH' ,'route' => ['book.update',$book->id],'enctype' => 'multipart/form-data']) !!}
            <input type="hidden" value="" name="updated_at">
        <input type="hidden" value="" name="original_Price">
        <input type="hidden" value="" name="percent_discount">
            <div class="row">
                <div class="p-3 py-3">
                    <div class="row mt-12">

                        <div class="col-md-12">
                            <label for="title" class="labels">Title</label>
                            <input id="title" name="title" type="text" class="form-control" placeholder="title name" value="{{$book->title}}">
                        </div>

                    </div>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <label for="weight" class="labels">weight</label>
                            <input name="weight" id="weight" type="text" class="form-control" placeholder="number weight" value="{{$book->weight}}"
                                   onkeypress="javascript:return isNumber(event)">
                        </div>
                        <div class="col-md-3">
                            <label for="size" class="labels">Size</label>
                            <input id="size" name="size" type="number" class="form-control" min="0" value="{{$book->size}}" step="0.1" placeholder="number size">
                        </div>
                        <div class="col-md-3">
                            <label for="number_of_pages" class="labels">Number of pages</label>
                            <input name="number_of_pages" id="number_of_pages" type="text" class="form-control" placeholder="number page" value="{{$book->number_of_pages}}"
                                   onkeypress="javascript:return isNumber(event)">
                        </div>
                        <div class="col-md-3">
                            <label for="formality" class="labels">Formality</label>
                            <input name="formality" type="text" class="form-control" placeholder="enter formality" value="{{$book->formality}}">
                        </div>

                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label>Author</label>
                            <select  class="form-control selectpicker" data-live-search="true" name="author_id">
                                 @foreach($authors as $author)
                                    @if($book->author->id === $author->id)
                                <option value="{{$author->id}}" selected>{{$author->full_name}}</option>
                                    @else
                                        <option value="{{$author->id}}">{{$author->full_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Publisher</label>
                            <select class="form-control selectpicker" data-live-search="true" name="publisher_id">
                                @foreach($publishers as $publisher)
                                    @if($book->publisher->id === $publisher->id)
                                    <option value="{{$publisher->id}}" selected>{{$publisher->name}}</option>
                                    @else
                                        <option value="{{$publisher->id}}">{{$publisher->name}}</option>
                                    @endif
                                        @endforeach

                            </select>
                        </div>
                    </div>
                    <div  class="row mt-4">
                        <div class="col-md-3">
                            <label>Category</label>
                            <select class="form-control selectpicker" data-live-search="true" name="categories_id">
                                @foreach($categories as $category)
                                    @if($book->categories->id === $category->id)
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @else
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3"><label for="foreign_book" class="labels">Foreign book</label>
                            <select class="form-control" name="foreign_book">

                                <option value="0">Nuoc ngoai</option>

                                <option value="1">Trong nuoc</option>

                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="publication_date">Publisher date (date and time)</label>
                            <input class="form-control" type="date" id="publication_date" value="{{$book->publication_date}}" name="publication_date">
                        </div>

                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="input-24" class="labels">Image</label>
                            <div class="file-loading">
                                <input id="input-24" name="input24[]" type="file" multiple>
                            </div>
                    </div>
                    </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="labels">Price</label>
                                <input name="price" type="text" class="form-control"
                                       onkeypress="javascript:return isNumber(event)"
                                       placeholder="enter price" value="{{$book->price}}">
                            </div>

                        </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <label for="describe" class="labels">Describe</label>
                            <textarea name="describe" class="form-control"  rows="10" id="describe">{{$book->describe}}</textarea>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mt-5 text-center">
                <button class="btn btn-primary profile-button" type="submit">Update</button>
            </div>
        {!! Form::close() !!}

    </div>
    @if(count($errors) >0)
        <div class="alert alert-danger">

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
@section('script')
    <script src={{asset("https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js")}}></script>
    <script>

        function isNumber(evt) {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                return false;
            return true;
        }
        ClassicEditor
            .create( document.querySelector( '#describe' ) )
            .catch( error => {
                console.error( error );
            } );

            $('.automatic-slider').unslider({
            autoplay: true
        });
        $(document).ready(function() {
            const localhost = "http://127.0.0.1:8000";
           var arrImage =[];

           var initialPreviewConfig =[];
             @foreach($book->imagebooks as $image)
            var imageConfig ={};
                   var src = "{{$image->file}}";
                  var nameImg =src.split('/')[2];
                  var img =localhost+src;
                 imageConfig.caption = nameImg;
                 imageConfig.downloadUrl =img;
                 imageConfig.url = localhost +"/book/site/{{$book->id}}/file-delete";
                 imageConfig.size =930321;
                 imageConfig.width = "120px";
                 imageConfig.key = {{$image->id}};
                 imageConfig.extra = {id: {{$image->id}},_token: "{{csrf_token()}}"};
            initialPreviewConfig.push(imageConfig);
                 arrImage.push(img)
            @endforeach

            $("#input-24").fileinput({
                initialPreview: arrImage,
                theme: 'fa',
                initialPreviewAsData: true,
                initialPreviewConfig: initialPreviewConfig,
                overwriteInitial: false,
                maxFileSize: 100000,
                showUpload: false
            }).on('filesorted', function(e, params) {
                console.log('file sorted', e, params);
            }).on('fileuploaded', function(e, params) {
                console.log('file uploaded', e, params);
            }).on('filesuccessremove', function(e, id) {
                console.log('file success remove', e, id);
            });
        });
    </script>
@endsection
