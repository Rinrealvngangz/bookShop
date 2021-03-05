@extends('layouts.main')

@section('content')


    @if(Session::has('error-create-Role'))
        <div class="alert alert-danger" role="alert">
            <p >{{session('error-create-Role')}}</p>
        </div>
    @elseif(Session::has('error-exists-Permis'))
        <div class="alert alert-danger" role="alert">
            <p >{{session('error-exists-Permis')}}</p>
        </div>
    @endif
    <div class="card card-primary">
        <div class="container-fluid">
            <div class="card-header">
                <h2 class="card-title">Create Role</h2>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            {!! Form::open(['method'=>'POST' , 'route' => ['role.store']]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Role') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}

            </div>
            <div class="form-group">
                <div class='form-group'>
                    <label for='roles_permissions'>Add Permission</label>

                    <input type='text' class='form-control' data-role="tagsinput" name='roles_permissions' id="roles_permissions"
                           value="">

                </div>
                {{ Form::button('Create  Role!', ['class' => 'btn btn-success', 'type' => 'submit']) }}
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
