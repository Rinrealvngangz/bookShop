@extends('layouts.main')
@section('content')
    <div class="container rounded bg-white">
        <form method="POST" action={{route('user.store')}}>
            @csrf
        @method('POST')
            <div class="row">
        <div class="p-3 py-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Crate Users</h4>
            </div>
            <div class="row mt-3">

                <div class="col-md-3">
                    <label for="firstName" class="labels">First Name</label>
                    <input name="firstName" type="text" class="form-control" placeholder="first name" value="">
                </div>
                <div class="col-md-6"><label for="lastName" class="labels">Last Name</label>
                    <input name="lastName" type="text" class="form-control" value="" placeholder="lastname">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12"><label for="userName" class="labels">User name</label>
                    <input name="userName" type="text" class="form-control" placeholder="enter phone number" value=""></div>
                <div class="col-md-12"><label for="email" class="labels">Email</label>
                    <input name="email" type="text" class="form-control" placeholder="enter address" value=""></div>
                <div class="col-md-12"><label for="password" class="labels">Password</label>
                    <input name="password" type="password" class="form-control" placeholder="password" value=""></div>

                <div class="col-md-12">
                    <label for="password-confirm" class="labels">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" placeholder="password confirm" name="password_confirmation" >
                </div>
            </div>

        </div>
            </div>
            <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Create</button></div>
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
