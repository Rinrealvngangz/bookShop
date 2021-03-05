@extends('layouts.main')



@section('content')

<div class="card card-primary">
  <div class="container-fluid">
              <div class="card-header">
                <h2 class="card-title">Update Role</h2>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              {!! Form::model($role, ['method' => 'PATCH' ,'route' => ['role.update',$role->id]]) !!}

              <div class="form-group">
      {!! Form::label('name', 'Role') !!}
      {!! Form::text('name', $role->name, ['class' => 'form-control']) !!}

               </div>
               <div class="form-group">
      <div class='form-group'>
               <label for='roles_permissions'>Add Permission</label>

               <input type='text' class='form-control' data-role="tagsinput" name='roles_permissions' id="roles_permissions"
                value="@foreach($role->permissions as $permissions) {{$permissions->name.',' }}  @endforeach">

      </div>
    {{ Form::button('Update the Role!', ['class' => 'btn btn-success', 'type' => 'submit']) }}
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




@endsection
