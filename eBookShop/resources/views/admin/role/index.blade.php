@extends('layouts.main')
@section('name')
    <h1>Access</h1>
@endsection
@section('root')
    <a href="{{route('admin.index')}}">
        App
    </a>
@endsection
@section('model')
    role-permission
@endsection
@section('content')

    <div class="col-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between">
                <h2>Data Table Access</h2>
                <div class="dropdown d-inline-block mb-1">
                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a  type="button" data-toggle="modal"
                           data-target="#exampleModal"
                           class="dropdown-item" href="#">
                            <i class=" mdi mdi-plus-circle"></i> Create Role
                        </a>
                        <a type="button" data-toggle="modal" href="#"
                           data-target="#exampleModalsmallEdit"
                           class="dropdown-item">
                            <i class=" mdi mdi-plus-circle"></i> Create Permission</a>
                        <a type="button" data-toggle="modal" href="#"
                           data-target="#exampleModalsmallPermission"
                           class="dropdown-item" onclick="editPermission()" >Edit permission</a>

                    </div>
                </div>


            </div>

            <div class="card-body">
                <div class="basic-data-table">
                    <table id="basic-data-table" class="table nowrap" style="width:100%">
              <thead>
              <tr>
                <th>Id</th>
                <th>Role</th>
                <th>Permissions</th>
                  <th>Tools</th>
              </tr>
              </thead>
              <tbody>
              @foreach($role as $roles )
                  <tr id="sid{{$roles->id}}">
                      <td>{{$roles->id}}</td>
                      <td>{{$roles->name}}</td>
                      <td>
                                  @if($roles->name === "Administrator")
                                      <span class="badge badge-info">
                                    {{ __('Full Permission') }}
                                      </span>
                                      @else
                              @foreach($roles->permissions as $permissionsName)
                                  <span class="badge badge-info">
                                       {{ __($permissionsName->name)}}

                                 </span>
                              @endforeach
                                  @endif
                      </td>
                      <td>
                          <button class="mb-1 btn btn-success" data-toggle="modal"
                                  data-target="#exampleModalForm" data-value="{{$roles->id}}" onclick="getRoleId(this)">
                              <span><i class="mdi mdi-pencil"></i></span>
                          </button>
                          <button class="mb-1 btn btn-danger" data-value="{{$roles->id}}" onclick="deleteRoleById(this)">
                              <span><i class="mdi mdi-trash-can"></i></span>
                          </button>

                      </td>
                  </tr>

              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>Id</th>
                <th>Role</th>
                <th>Permissions</th>
                  <th>Tools</th>
              </tr>
              </tfoot>
            </table>
                    @include('admin.role.create')
                    @include('admin.permission.create')
                    @include('admin.permission.edit')
                    <div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog"  data-keyboard="false"
                         data-backdrop="static"   aria-labelledby="exampleModalFormTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalFormTitle">Edit role</h5>
                                    <button type="button" onclick="remove()" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(['method' => 'PATCH', 'id'=>'form-role']) !!}

                                    {!! Form::close() !!}


                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="remove()" class="btn btn-secondary btn-pill" data-dismiss="modal">Close</button>
                                    <button type="submit" id="btn-submit" class="btn btn-success btn-pill">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
      </div>
    </div>


@endsection

@section('script')
    <script src={{asset("error-handler/exception.js")}}></script>
    <script>
    $overlay = $('<div id="overlay"/>').css({
    position: 'fixed',
    display: 'none',
    top: 0,
    left: 0,
    color: '#adbcbf',
    width: '100%',
    height: $(window).height() + 'px',
    opacity: 0.4,
    background: '#f5f6f7 url("/images/Blocks-1s-200px.gif") no-repeat center'
    });

    $('#role-submit').click(function (e) {
    e.preventDefault();
    $overlay.appendTo("#exampleModal");
    $('#overlay').show();
    setTimeout(function () {
    $.ajax({
    type: 'POST',
    catch: false,
    url: "{{route('role.store')}}",
    data: {
    "_token": '{{csrf_token()}}',
    'name': $('#name').val()
    },
    success: function (data) {

        var tools = '<td>'+' <button data-target="#exampleModalForm" ' +
            'data-toggle="modal" class="mb-1 btn btn-success"'+' data-value='+'"' +data.role.id +'"'
            +' onclick="getRoleId(this)"' + '>'+
            ' <span><i class="mdi mdi-pencil"></i></span> </button>' +
             ' <button class="mb-1 btn btn-danger"'+' data-value='+'"' +data.role.id +'"'
            +' onclick="getRoleId(this)"' + '>'+
            ' <span><i class="mdi mdi-trash-can"></i></span> </button>' +
            '</td>';

        var $row = $('<tr id="sid'+data.role.id+'"' +'>' +
            '<td>' + data.role.id + '</td>' +
            '<td>' + data.role.name + '</td>' +
            '<td>' + '</td>' +
            tools +
            '</tr>');
        var rowPermission = '<span>No permission</span>';
        if (typeof data.role.permissions !== "undefined") {
            var array = data.role.permissions;
            array.forEach(function (item) {
                rowPermission = '<span class="badge badge-info">' + item.name + '</span>' + '  ';
                $row.find("td").eq(2).append(rowPermission);
            })
        } else {

            $row.find("td").eq(2).append(rowPermission);
        }
        $('table> tbody:last').append($row);
        $(".alert-highlighted span").text(data.success);
        $('.alert-highlighted').show();
        $('#overlay').hide();
        $('#exampleModal').modal('hide');
        $('.alert-highlighted').fadeOut(5000);
    },
    error: function (error){
        console.log(error);
        $.fn.handlerError(error);
      }
    })
    },1000)
    })
    let id;
    function getRoleId(item){
       id=  item.getAttribute("data-value");
        $.ajax({
            type: 'GET',
            catch: false,
            url: 'role/' + id + '/edit',
            data: {
                "_token": '{{csrf_token()}}',
            },
            success: function (data) {
              var html =
                  $( '<div class="form-group">'+
                '<label for="name" class="col-form-label">Name</label> ' +
                '<input name="name" id="name" type="text" class="form-control" readonly placeholder="role name" value='+'"'+data.role.name +'"'+'>'+
                   ' <div class="invalid-feedback name"></div>'
           +' </div>'+
                  '<div class="form-group">'+
                  '<label>Permission</label>'
                  +'<div id="checkPermission" class="row">' +
                  '</div>'+
                  '</div>') ;

              if(data.role.name ==="Administrator"){
                    $label = '<span class="badge badge-success m-sm-3">You have full permission!</span>';
                  $(html).find("#checkPermission").append($label);
                  $('#btn-submit').attr('disabled','disabled');
              }else{
                  $('#btn-submit').removeAttr('disabled');
                  var roleHasPermission =data.permissions;

                  roleHasPermission.forEach(function (item) {
                      if(jQuery.inArray(item.id,data.arrayRoleHasPermission) !== -1 && jQuery.isArray(data.arrayRoleHasPermission)){
                          $row =
                              '<div class="m-sm-3">'+
                              '<label class="control outlined control-checkbox">'+ item.name
                            + '<input   name="arrayIdPermission[]" type="checkbox" value='+'"'+
                              item.name+'"' + ' checked="checked"' +'>' +
                              '<div class="control-indicator"></div>'
                              + '</label>'
                             + '</div>'

                          $(html).find("#checkPermission").append($row);
                      }else{
                          $row =  '<div class="m-sm-3">'+
                              '<label class="control outlined control-checkbox">'+ item.name
                              + '<input   name="arrayIdPermission[]" type="checkbox" value='+'"'+
                              item.name+'"' + '' +'>' +
                              '<div class="control-indicator"></div>'
                              + '</label>'
                              + '</div>'
                          $(html).find("#checkPermission").append($row);
                      }
                  })
              }
            $('#form-role').append(html);

            },
            error: function (error){
                console.log(error);
            }
        })

    }
    function remove(){
        $('#form-role').children('.form-group').remove();
    }
    function removeFormModalSmall(){
        $('#arrayPermission option').each(function() {
                $(this).remove();
        });

    }
     function deleteRoleById(item){
        let id=  item.getAttribute("data-value");
         Swal.fire({
             title: 'Are you sure delete role ?',
             text: "You won't be able to revert this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#29CC97',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
             $overlay.appendTo(".swal2-container");
             $('#overlay').show();
             if (result.isConfirmed) {
                 $.ajax({
                     type: 'DELETE',
                     catch: false,
                     url: 'role/' + id,
                     data: {
                         "_token": '{{csrf_token()}}'
                     },
                     success: function (data) {
                         console.log(data.result)
                         if(data.result !=='error'){
                             $('#overlay').hide();
                             Swal.fire(
                                 'Deleted!',
                                 data.result,
                                 'success'
                             )
                             $("tr#sid"+id).remove();
                             $(".alert-highlighted span").text("Delete role success!");
                             $('.alert-highlighted').show();
                             $('.alert-highlighted').fadeOut(5000);
                         }else{
                             $('#overlay').hide();
                             $(".alert-highlighted").removeClass('alert-success');
                             $(".alert-highlighted").addClass('alert-danger');
                             $(".alert-highlighted span").text("Already registered! cannot delete role");
                             $('.alert-highlighted').show();
                             $('.alert-highlighted').fadeOut(5000);
                         }
                     },
                     error:function (error){
                         console.log(error);
                     }
                 })
             }
         })
     }


    $('#btn-submit').click(function (e){
        e.preventDefault();
        $overlay.appendTo("#exampleModalForm");
        $('#overlay').show();
        setTimeout(function (){
            $.ajax({
                type: 'PUT',
                catch: false,
                url: 'role/' + id,
                data:  $('#form-role').serialize() ,
                success: function (data) {

                    if(data.result.length ===0){
                        $("tr#sid"+id).find("td").eq(2).text('');
                        $rowRole =  $('<span>No active</span>');
                        $("tr#sid"+id).find("td").eq(2).append($rowRole);
                    }else{
                        console.log(id);
                        $("tr#sid"+id).find("td").eq(2).text('');
                        $.each(data.result,function(index,value) {
                            console.log(value.name);
                            $rowRole = '<span class="badge badge-info">' + value.name + '</span>&nbsp' ;
                            $("tr#sid"+id).find("td").eq(2).append($rowRole);
                        })
                    }
                    console.log(data.result);
                    $(".alert-highlighted span").text(data.success);
                    $('.alert-highlighted').show();
                    $('#overlay').hide();
                    $('#exampleModalForm').modal('hide');
                    $('.alert-highlighted').fadeOut(5000);
                    remove();

                },
                error:function (error){
                    $.fn.handlerError(error);
                }
            })
        },1000)
    })
    function editPermission(){
        $.ajax({
            type: 'GET',
            catch: false,
            url: 'permission/',
            data:  $('#form-permission').serialize() ,
            success: function (data) {
                console.log(data.arrPermissions);
                data.arrPermissions.forEach(function (item) {
                     var permission =  '<option>'+item.name +'</option>';
                    $('#form-permission').find('#arrayPermission').append(permission);

                });
                },
            error:function (error) {
                $.fn.handlerError(error);
            }
        });
    }
    $('#btn-cancel-register').click(function (e) {
        e.preventDefault();
        $overlay.appendTo("#exampleModalsmallPermission");

        Swal.fire({
            title: 'Are you sure delete permission ?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#29CC97',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#overlay').show();
                setTimeout(function () {
                    $.ajax({
                        type: 'PATCH',
                        catch: false,
                        url: 'permission/' + 'updatePermission',
                        data: $('#form-permission').serialize(),
                        success: function (data) {

                            var result = data.result;
                            if (result === 'you do not choose' || result === 'Permission name is require!') {
                                $(".alert-highlighted").removeClass('alert-success');
                                $(".alert-highlighted").addClass('alert-danger');
                                $(".alert-highlighted span").text(result);
                                $('.alert-highlighted').show();
                                $('#overlay').hide();
                                $('.alert-highlighted').fadeOut(5000);
                            } else {
                                console.log(result);
                                result.forEach(function (item) {
                                    if (item.roleHasPermission.length === 0) {
                                        $("tr#sid" + item.roleId).find("td").eq(2).text('');
                                    } else {
                                        $("tr#sid" + item.roleId).find("td").eq(2).text('');
                                        item.roleHasPermission.forEach(function (permission) {
                                            $row = '<span class="badge badge-info">' + permission + '</span>&nbsp';
                                            $("tr#sid" + item.roleId).find("td").eq(2).append($row);
                                        })
                                    }
                                })
                                $(".alert-highlighted span").text("Success cancel register permission!");
                                $('.alert-highlighted').show();
                                $('#overlay').hide();
                                $('#exampleModalsmallPermission').modal('hide');
                                $('.alert-highlighted').fadeOut(5000);
                                removeFormModalSmall();
                            }
                        },
                        error: function (error) {
                            $.fn.handlerError(error);
                        }
                    })
                }, 1000)
            }
        })
    });

    $('#btn-create-permission').click(function (e) {
        e.preventDefault();
        $overlay.appendTo("#exampleModalsmallEdit");
        $('#overlay').show();
        setTimeout(function () {
            $.ajax({
                type: 'POST',
                catch: false,
                url: "{{route('permission.store')}}",
                data: $('#form-create-permission').serialize(),
                success: function (data) {
                    $(".alert-highlighted span").text(data.result);
                    $('.alert-highlighted').show();
                    $('#overlay').hide();
                    $('#exampleModalsmallEdit').modal('hide');
                    $('.alert-highlighted').fadeOut(5000);
                    setTimeout(function (){
                        location.reload();
                    },1000)
                },
                error:function (error){
                    $.fn.handlerError(error);
                }
            })
        }, 1000)
    });
  </script>

@endsection

