@extends('layouts.main')

@section('content')

    <div class="card card-primary">
        <div class="container-fluid">
            <div class="card-header">
                <h2 class="card-title">Create discount</h2>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {!! Form::open(['method'=>'POST' , 'route' => ['discount.store']]) !!}

            <div class="form-group">
                <div class='form-group'>
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name',null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('value', 'Value') !!}
                    {!! Form::number('value', null, ['class' => 'form-control value','min'=>"1", 'max'=>"100"]) !!}
                </div>

                {{ Form::button('Create discount!', ['class' => 'btn btn-success', 'type' => 'submit']) }}

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


        @section('styles')

            <link rel="stylesheet" href="/css/admin/bootstrap-tagsinput.css" >

        @endsection

        @section('script-tagsinput')

            <script src="/js/admin/bootstrap-tagsinput.js"></script>
            <script src="/js/2WayDataBinding.js"></script>
            <script>
                $(function () {
                    $(".alert-danger").fadeTo(2000, 500).slideUp(500, function () {
                        $(".alert-danger").slideUp(500);
                    });

                });
            </script>


@endsection
