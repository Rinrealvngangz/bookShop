@extends('layouts.main')

@section('content')



    <div class="container-fluid">

        <div class="row">

            <div class="d-flex flex-column align-items-center text-center p-2 py-2">
                <img src="{{$users->photo ? $users->photo->file : 'no user photo'}}" alt="" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
            </div>
            <div class="col-sm-12">
                <div class="col-xs-12 col-sm-12">
                    <h2>{{$users->lastName . " " . $users->firstName}}</h2>
                    <p><strong>User Name: </strong> {{$users->userName}}</p>
                    <p><strong>Email: </strong> {{$users->email}} </p>
                    <p><strong>Role: </strong>
                        @if(count($users->roles)==0)
                        <span class="tags">No active </span>
                        @else
                            @foreach($users->roles as $role)
                            <span class="badge badge-info">{{$role->name}} </span>
                            @endforeach
                         @endif

                    </p>
                </div>

            </div>

        </div>
        <div class="btn-group">

            {!! Form::open(['method'=>'GET' , 'route' => ['user.create',$users->id]]) !!}
            {{ Form::button('Add role', ['class' => 'btn btn-outline-secondary', 'type' => 'submit']) }}
            {!! Form::close() !!}


            {!! Form::open(['method'=>'GET' , 'route' => ['user.edit',$users->id]]) !!}
            {{ Form::button('Update', ['class' => 'btn btn-outline-primary', 'type' => 'submit']) }}
            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE' , 'route' => ['user.destroy',$users->id]]) !!}
            {{ Form::button('Delete', ['class' => 'btn btn-outline-danger', 'type' => 'submit']) }}
            {!! Form::close() !!}
        </div>



    </div>

@endsection


