@extends('layouts.main')
@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <form method="POST" action={{route('user.update',$users->id)}} enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle" width="200" height="200" src="{{$users->photo ? $users->photo->file : 'no user photo'}}" alt="">
                        <span class="font-weight-bold">{{$users->userName}}</span>
                        <span class="text-black-50">{{$users->email}}</span>

                    </div>
                </div>
                <div class="col-md-9 border-right">
                    <div class="p-3 py-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Users Settings</h4>
                        </div>
                        <div class="row mt-3">

                            <div class="col-md-6">
                                <label for="firstName" class="labels">First Name</label>
                                <input name="firstName" type="text" class="form-control" placeholder="first name" value="{{$users->firstName}}">
                            </div>
                            <div class="col-md-6"><label for="lastName" class="labels">Last Name</label>
                                <input name="lastName" type="text" class="form-control" value="{{$users->lastName}}" placeholder="lastname">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12"><label for="userName" class="labels">User name</label>
                                <input name="userName" type="text" class="form-control" placeholder="enter phone number" value={{$users->userName}}></div>
                            <div class="col-md-12"><label for="email" class="labels">Email</label>
                                <input name="email" type="text" class="form-control" placeholder="enter address" value={{$users->email}}></div>
                            <div class="col-md-12"><label for="password" class="labels">Password</label>
                                <input name="password" type="text" class="form-control" placeholder="password" value=""></div>
                            <div class="form-group">
                                <label for="photo_id">Choose file image</label>
                                <input type="file" class="form-control-file" name ="photo_id" id="photo_id">
                            </div>
                        </div>

                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
                    </div>
                </div>

            </div>
        </form>
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
