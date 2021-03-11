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
        @if(str_contains($role->name,'administrator'))
          {!! Form::label('hasAdmin', 'You have full permission!') !!}
        @else
      <div class="form-group">
          {!! Form::label('name_assign_permission', 'Assign Permission') !!}
          <div class="row" name="name_assign_permission">
              @foreach($permission as $permissions)
                  <div class="col-sm-4">
                      <div class="form-group">
                          <div class="form-check">
                              <input class="form-check-input" name="arrayIdPermiss[]" type="checkbox" value={{$permissions->name}}
                                  {{ (is_array($arrayIdPermiss) and in_array($permissions->id, $arrayIdPermiss)) ? ' checked' : '' }}
                              >
                              <label class="form-check-label">{{$permissions->name}}</label>

                          </div>
                      </div>
                  </div>
              @endforeach

          </div>
      </div>
      @endif
          {{ Form::button('Update!', ['class' => 'btn btn-success', 'type' => 'submit']) }}
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




@endsection
