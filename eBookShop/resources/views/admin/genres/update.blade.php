@extends('layouts.main')

@section('content')


    <div class="card card-primary">
        <div class="container-fluid">
            <div class="card-header">
                <h2 class="card-title">Update Permission</h2>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {!! Form::model($gen,['method'=>'PUT' , 'route' => ['genres.update',$gen->id]]) !!}
            <div class='form-group'>
                <label for='cate-name-updated'>Update Genres</label>

            </div>
            <div class="form-group">
                {!! Form::label('name', 'Name Genres') !!}
                {!! Form::text('name', $gen->name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('name', 'Name category') !!}

                <select name='cate-belong' class="form-control" id="cate-belong" >
                    <option value= '{{$gen->Categories->id}}'>{{$gen->Categories->name}}</option>
{{--                    {!!  $htmlOption !!}--}}
                </select>
            </div>
            {{ Form::button('Update  category', ['class' => 'btn btn-success', 'type' => 'submit']) }}
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
