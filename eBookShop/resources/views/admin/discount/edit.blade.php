@extends('layouts.main')


@section('content')

    <div class="card card-primary">
        <div class="container-fluid">
            <div class="card-header">
                <h2 class="card-title">Update discount</h2>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {!! Form::model($discount, ['method' => 'PATCH' ,'route' => ['discount.update',$discount->id]]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Discount') !!}
                {!! Form::text('name', $discount->name, ['class' => 'form-control']) !!}

            </div>

            <div class="form-group">
                {!! Form::label('value', 'Value') !!}
                {!! Form::text('value',round($discount->value * 100 / 100), ['class' => 'form-control']) !!}

            </div>

            {{ Form::button('Update discount!', ['class' => 'btn btn-success', 'type' => 'submit']) }}
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


