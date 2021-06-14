@extends('layouts.main')
@section('name')
    <h1>View</h1>
@endsection
@section('root')
    <a href="{{route('book.index')}}">
        Books
    </a>

@endsection
@section('model')
    view
@endsection
@section('content')
    <div class="container rounded bg-white">
    <div class="tm-section tm-container-inner">
        <div class="row">
            <div class="col-md-6">
                <div class="unslider">
                <div class="automatic-slider unslider-horizontal">
                    <ul class="unslider-wrap unslider-carousel">
                        @foreach($book->imagebooks as $image)
                        <li>
                            <figure class="tm-description-figure">
                                <img src={{asset($image->file)}} alt="Image_{{$image->file}}" class="img-fluid" />
                            </figure>
                        </li>
                        @endforeach
                    </ul>
                </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="tm-description-box">
                    <h2 class="text-dark tm-gallery-title">{{$book->title}}</h2>
                        <table class="table table-borderless card-table table-responsive table-responsive-large" style="width:100%">

                            <tbody>
                            <tr>
                                <td class="text-dark">Publisher name</td>

                                <td>{{$book->publisher->name}}</td>
                            </tr>
                            <tr>
                                <td class="text-dark">Author</td>
                                <td>{{$book->author->full_name}}</td>
                            </tr>
                               <tr>
                                   <td class="text-dark">Publisher date</td>
                                   <td>{{$book->publication_date}}</td>
                               </tr>
                             <tr>
                                 <td class="text-dark">Weight(gr)</td>
                                 <td>{{$book->weight}}</td>
                             </tr>
                            <tr>
                                <td class="text-dark">Size</td>
                                <td>{{$book->size}}</td>
                            </tr>
                            <tr>
                                <td class="text-dark">Number of pages</td>
                                <td>{{$book->number_of_pages}}</td>
                            </tr>
                            <tr>
                                <td class="text-dark">Formality</td>
                                <td>{{$book->formality}}</td>
                            </tr>
                            <tr>
                                <td class="text-dark">Category</td>
                                <td>{{$book->categories->name}}</td>
                            </tr>
                            <tr>
                                <td class="text-dark">Price</td>
                                <td class="text-info">{{$book->price}}</td>
                            </tr>
                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="row p-3 py-3">
        <div class="container rounded bg-white card-header justify-content-between pb-5">
            <h3 class="text-dark tm-gallery-title">Description</h3>
            <div class="mt-4">
                  <span>
                 {!!$book->describe!!}
              </span>
            </div>
            {!! Form::open(['method' => 'GET' ,'route' => ['book.index']]) !!}
            <div class="d-flex justify-content-end mt-5">
                <button class="btn btn-secondary btn-pill" type="submit">
                    <i class="mdi mdi-arrow-left-bold"></i> Back
                </button>
            </div>
            {!! Form::close() !!}
        </div>


    </div>

@endsection

@section('script')
    <script>
        $('.automatic-slider').unslider({
            autoplay: true
        });
    </script>

@endsection
