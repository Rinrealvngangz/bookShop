@extends('layouts.main')
@section('name')
    <h1>Users</h1>
@endsection
@section('root')
    <a href="{{route('user.index')}}">
    Users
    </a>
@endsection
@section('model')
    users detail
@endsection
@section('content')


    <div class="container-fluid">

        <div class="row justify-content-center">

            <div class="col-lg-10 col-xl-6 col-xxl-2 mr-6">
                <div class="card card-default mt-6">
                    <div class="card-body text-center p-4">
                        <a href="javascript:0" data-toggle="modal" data-target="#modal-contact" class="text-secondary d-inline-block mb-3">
                            <div class="image mb-3 mt-n9">
                                <img src="{{$users->photo ? $users->photo->file : 'no user photo'}}" width="150" height="150" class="img-fluid rounded-circle" alt="Avatar Image">
                            </div>

                            <h5 class="card-title text-dark">{{$users->lastName}}&nbsp{{$users->firstName}}</h5>

                            <ul class="list-unstyled">
                                <li class="d-flex mb-1">
                                    <i class="mdi mdi-map mr-1"></i>
                                    @if(count($users->roles) ==0)
                                        <td>{{__('No active')}}</td>
                                    @else
                                        <td>
                                            @foreach($users->roles as $role)
                                                <span class="mb-1 mr-1 badge badge-pill badge-info">{{$role->name}}</span>
                                            @endforeach
                                        </td>
                                    @endif
                                </li>
                                <li class="d-flex">
                                    <i class="mdi mdi-email mr-1"></i>
                                    <span>{{$users->email}}</span>
                                </li>
                            </ul>
                        </a>
                        <div class="row justify-content-center">
                              <div class="m-sm-1">
                                  @if(Auth::user()->id === $users->id || auth()->user()->hasRole('Administrator'))
                            {!! Form::open(['method'=>'GET' , 'route' => ['user.edit',$users->id]]) !!}
                            {{ Form::button('Update', ['class' => 'btn btn-outline-primary', 'type' => 'submit']) }}
                            {!! Form::close() !!}
                                      @endif
                              </div>

                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection


