@extends('layouts.main')


@section('content')

    <div class="card card-primary">
        <div class="container-fluid">
            <div class="card-header">
                <h2 class="card-title">Update Permission</h2>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {!! Form::model($permission, ['method' => 'PATCH' ,'route' => ['permission.update',$permission->id]]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Permission') !!}
                {!! Form::text('name', $permission->name, ['class' => 'form-control']) !!}

            </div>
            <div class="form-group">
                {!! Form::label('name_assign_role', 'Assign Role') !!}
            <div class="row" name="name_assign_role">
               @foreach($role as $roles)
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" name="arrayIdRole[]" type="checkbox" value={{$roles->id}}
                                {{ (is_array($arrayIdRole) and in_array($roles->id, $arrayIdRole)) ? ' checked' : '' }}
                                 >
                                <label class="form-check-label">{{$roles->name}}</label>

                            </div>
                        </div>
                    </div>
            @endforeach

            </div>
            </div>
            {{ Form::button('Update the Permission!', ['class' => 'btn btn-success', 'type' => 'submit']) }}
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


