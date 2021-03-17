@extends('layouts.main')

@section('content')

    <div class="card card-primary">
        <div class="container-fluid">
            <div class="card-header">
                <h2 class="card-title">Create Genres</h2>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {!! Form::open(['method'=>'POST' , 'route' => ['genres.store']]) !!}


            <div class="form-group">
                <div class='form-group'>
                    <label for='genres-name'>Add Genres</label>

                    <input type='text' class='form-control'  name='genres-name' id="genres-name"
                           value="" placeholder="enter name genres">
                    <label for="exampleFormControlSelect1">Belong to category</label>
                    <select name='cate-belong' class="form-control" id="cate-belong" >
                        <option value="" selected disabled hidden>Choose here</option>
                        {!!  $htmlOption !!}
                    </select>

                </div>
                {{ Form::button('Create  Genres!', ['class' => 'btn btn-success', 'type' => 'submit']) }}
                {!! Form::close() !!}


            </div>
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


        @section('styles')

            <link rel="stylesheet" href="/css/admin/bootstrap-tagsinput.css" >

        @endsection

        @section('script-tagsinput')

            <script src="/js/admin/bootstrap-tagsinput.js"></script>
            <script>
                $(function () {
                    $(".alert-danger").fadeTo(2000, 500).slideUp(500, function () {
                        $(".alert-danger").slideUp(500);
                    });
                });
            </script>

@endsection
