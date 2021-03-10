@extends('layouts.main')


@section('content')
    <div class="card card-primary">
        <div class="container-fluid">
            {!! Form::model($user, ['method' => 'PUT' ,'route' => ['user.addRole',$user->id]]) !!}

            <div class="form-group">
    {!! Form::label('name_assign_role', 'Assign Role') !!}
    <div class="row" name="name_assign_role">
        @foreach($role as $roles)
            <div class="col-sm-4">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" name="arrayIdRole[]" type="checkbox" value={{$roles->name}}
                            {{ (is_array($arrayIdRole) and in_array($roles->id, $arrayIdRole)) ? ' checked' : '' }}
                        >
                        <label class="form-check-label">{{$roles->name}}</label>

                    </div>
                </div>
            </div>
        @endforeach

    </div>
                {{ Form::button('Add Role for user!', ['class' => 'btn btn-success', 'type' => 'submit']) }}
                {!! Form::close() !!}
</div>
        </div>
    </div>
@endsection
