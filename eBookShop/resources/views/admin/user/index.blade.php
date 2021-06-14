@extends('layouts.main')
@section('name')
    <h1>Users</h1>
@endsection
@section('root')
    <a href="{{route('admin.index')}}">
        App
    </a>

@endsection
@section('model')
    Users
@endsection
@section('content')

    <div class="col-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom d-flex justify-content-between">
                <h2>User</h2>
                @if(auth()->user()->hasDirectPermission('Create')||auth()->user()->hasRole('Administrator') ||auth()->user()->hasRole('HR'))
                <button class="btn btn-outline-primary" type="button" data-toggle="modal"
                        data-target="#exampleModalForm">
                    <i class=" mdi mdi-plus-circle"></i> Create User

                </button>
               @endif
            </div>

            <div class="card-body">
                <div class="basic-data-table">
                    <table id="basic-data-table" class="table nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Last name</th>
                            <th>First name</th>
                            <th>Address</th>
                            <th>Phone number</th>
                            <th>User Name</th>
                            <th>E-mail</th>
                            <th>Role Name</th>
                            <td></td>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($user as $users )
                            <tr id="sid{{ $users->id }}">
                                <td>{{$users->id}}</td>
                                <td> {{$users->lastName }}</td>
                                <td> {{$users->firstName }} </td>
                                <td> {{$users->address }}</td>
                                <td> {{$users->phoneNumber }} </td>
                                <td><a href="{{route('user.show',$users->id)}}"> {{$users->userName}}</a></td>
                                <td>{{$users->email}}</td>

                                @if(count($users->roles) ==0)
                                    <td>{{__('No active')}}</td>
                                @else
                                    <td>

                                        @foreach($users->roles as $role)
                                            @if($role->name ==="Administrator")
                                            <span class="mb-2 mr-2 badge badge-pill badge-info">{{$role->name}}</span>
                                                 @break
                                            @else
                                                <span class="mb-2 mr-2 badge badge-pill badge-info">{{$role->name}}</span>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td class="text-right">
                                    <div class="dropdown show d-inline-block widget-dropdown">
                                        <a class="dropdown-toggle icon-burger-mini" href="#" role="button"
                                           id="dropdown-recent-order5" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false" data-display="static"></a>
                                        <ul class="dropdown-menu dropdown-menu-right"
                                            aria-labelledby="dropdown-recent-order5">
                                            <li class="dropdown-item">
                                                <a href="{{route('user.show',$users->id)}}">View</a>
                                            </li>
                                            @if(auth()->user()->hasDirectPermission('Delete') ||auth()->user()->hasRole('Administrator'))
                                            <li class="dropdown-item">
                                                <a onclick="deleteUser(this)" data-value="{{$users->id}}" type="button">Remove</a>
                                            </li>
                                            @endif
                                            @if(auth()->user()->hasDirectPermission('Edit')||auth()->user()->hasRole('Administrator'))
                                            <li class="dropdown-item">
                                                <a type="button" style="cursor:pointer" data-value="{{$users->id}}"
                                                   onclick="getIdUser(this)" data-toggle="" data-target=""
                                                   id="editRole" >
                                                    Assign access </a>
                                            </li>
                                                @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @include('admin.user.create',['arrRoles'=>$arrRole])
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static"
                         data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Role permissions</h5>
                                    <button type="button" id="btn-hidden" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="form-group">
                                    <div id="tree"></div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" id="btn-close" class="btn btn-secondary btn-pill"
                                            data-dismiss="modal">Close
                                    </button>
                                    <button type="submit" id="role-submit" class="btn btn-primary btn-pill">
                                        Save Changes
                                    </button>
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
        function isNumber(evt) {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
                return false;
            return true;
        }

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
        $overlayRole = $('<div id="overlayRole"/>').css({
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

        $('#btn-submit').click(function (e) {
            e.preventDefault();

            console.log($('tbody tr').find("td").eq(0).text());
            $overlay.appendTo("#exampleModalForm");
            $('#overlay').show();
            setTimeout(function () {
                $.ajax({
                    type: 'POST',
                    cache: false,
                    url: "{{route('user.store')}}",
                    data: {
                        "_token": '{{csrf_token()}}',
                        "lastName": $('#lastName').val(),
                        "firstName": $('#firstName').val(),
                        "address": $('#address').val(),
                        "phoneNumber": $('#phoneNumber').val(),
                        "userName": $('#userName').val(),
                        "email": $('#email').val(),
                        "password": $('#password').val(),
                        "password_confirmation": $("#password_confirmation").val(),
                        "arrayRole": $('#arrayRole').val()
                    },

                    success: function (data) {
                        var tools = '<td class="text-right">' +
                            '<div class="dropdown show d-inline-block widget-dropdown">' +
                            '<a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order5" data-toggle="dropdown" aria-haspopup="true" ' +
                            'aria-expanded="false" data-display="static"></a>' +
                            '<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order5">' +
                            '<li class="dropdown-item">' +
                            '<a href="' + 'user' + '/show/' + data.user.id + '">' + 'View' + '</a>' +
                            '</li>' +
                            '<li class="dropdown-item">' +
                            '<a onclick="deleteUser(this)" style="cursor:pointer" data-value=' + '"' + data.user.id + '"' + '>' + 'Remove' + '</a>' +
                            '</li>' +
                            '<li class="dropdown-item">' +
                            '<a data-toggle="" data-target="" id="editRole" onclick="getIdUser(this)"' +
                            ' type="button" style="cursor:pointer" data-value=' + '"' + data.user.id + '"' + '>' + 'Assign access' + '</a>' +
                            '</li>' +
                            '</ul>' +
                            '</div>' +
                            '</td>';

                        var rowName = '<td>' + '<a href="/user/' + data.user.id + '">' + data.user.userName + '</a>' + '</td>'
                        var $row = $('<tr id="sid'+data.user.id+'"' +'>' +
                            '<td>' + data.user.id + '</td>' +
                            '<td>' + data.user.lastName + '</td>' +
                            '<td>' + data.user.firstName + '</td>' +
                            '<td>' + data.user.address + '</td>' +
                            '<td>' + data.user.phoneNumber + '</td>' +
                            rowName +
                            '<td>' + data.user.email + '</td>' +
                            '<td>' + '</td>' +
                            tools +
                            '</tr>');
                        var rowRoles = '<span>No active</span>';
                        if (typeof data.user.roles !== "undefined") {
                            var array = data.user.roles;
                            array.forEach(function (item) {
                                rowRoles = '<span class="mb-2 mr-2 badge badge-pill badge-info">' + item.name + '</span>' + '  ';
                                $row.find("td").eq(7).append(rowRoles);
                            })
                        } else {

                            $row.find("td").eq(7).append(rowRoles);
                        }
                        $('table> tbody:last').append($row);
                        $(".alert-highlighted span").text(data.success);
                        $('.alert-highlighted').show();
                        $('#overlay').hide();
                        $('#exampleModalForm').modal('hide');
                        $('.alert-highlighted').fadeOut(5000);
                    },
                    error: function (data) {
                        $.fn.handlerError(data);
                    }
                });
            }, 500);

        });
        let tree;
        let id;

        function checkDuplicate(reportRecipient) {
            var reportRecipientsDuplicate = [];
            $.each(reportRecipient, function (i, el) {
                if ($.inArray(el, reportRecipientsDuplicate) === -1) {
                    reportRecipientsDuplicate.push(el);
                }
            })
            return reportRecipientsDuplicate;
        }

        function getIdUser(item) {

            id = item.getAttribute("data-value");
              @if(\Illuminate\Support\Facades\Auth::check()){
                  var ids = "{{\Illuminate\Support\Facades\Auth::user()->id }}";
                      var text =  $("tr#sid"+ids).find("td").eq(5).text();
                       var nameRole =  text.split(/(\s+)/)[2];
                               if(ids ===id && nameRole === "Administrator"){
                                   Swal.fire({
                                       title: 'You have full access!',
                                       confirmButtonColor: '#29CC97',
                                       showClass: {
                                           popup: 'animate__animated animate__fadeInDown'
                                       },
                                       hideClass: {
                                           popup: 'animate__animated animate__fadeOutUp'
                                       }
                                   })
                               }
                               else{
                                       item.setAttribute('data-toggle','modal');
                                       item.setAttribute('data-target','#exampleModal');
                                       tree = $('#tree').tree({
                                           primaryKey: 'id',
                                           uiLibrary: 'bootstrap4',
                                           dataSource: '/user/' + id + '/role',
                                           checkboxes: true,
                                           autoLoad: true
                                       });
                                       console.log(tree);

                               }
            }
            @endif
        }
        function getNameRole(tree) {
            var objRole = {};
            var roles = [];
            var arrAll = [];
            var data = tree.xhr.responseJSON;
            $.each(data, function (i, el) {
                objRole = {
                    id: el.id,
                    text: el.text,
                }
                roles.push(objRole);
            })
            arrAll.push(roles);
            arrAll.push(data);
            return arrAll;
        }

        function getParentNameByChild(tree) {
            var data = getNameRole(tree);
            var idRole = [];
            var result = [];
            $.each(data[0], function (i, el) {
                idRole.push(el.id);
            })
            var checkedId = tree.getCheckedNodes();
            $.each(checkedId, function (index, el) {
                //check role in data
                if (jQuery.inArray(el, idRole)) {
                    $.each(data[1], function (i, val) {
                        if (val.id === el) {
                            result.push(val.text);
                            checkedId = $.grep(checkedId, function (value) {
                                return value !== el;
                            });
                        }
                    })
                }
                $.each(data[1], function (i, item) {
                    $.each(item.children, function (pos, val) {
                        if (el === val.id) {
                            result.push(val.text);
                            if (jQuery.inArray(item.text, result) === -1) {
                                result.push(item.text);
                            }
                        }
                    });
                })
            })
            return checkDuplicate(result);
        }

        $('#btn-hidden').click(function (e) {
            e.preventDefault();
            tree.destroy();
        })
        $('#btn-close').click(function (e) {
            e.preventDefault();
            tree.destroy();
        })
        $('#role-submit').click(function (e) {
            e.preventDefault();
            $overlayRole.appendTo("#exampleModal");
            $('#overlayRole').show();
            var result = getParentNameByChild(tree);
            setTimeout(function () {

                $.ajax({
                    type: 'POST',
                    catch: true,
                    url: 'user/' + id + '/addRole',

                    data: {
                        "_token": '{{csrf_token()}}',
                        'data': result
                    },
                    success: function (data) {
                     //update role name after response success
                        var rowRole ;
               if(data.result.length ===0){
                $("tr#sid"+id).find("td").eq(7).text('');
                rowRole =  $('<span>No active</span>');
                $("tr#sid"+id).find("td").eq(7).append(rowRole);
               }else{
                $("tr#sid"+id).find("td").eq(7).text('');
                   $.each(data.result,function(index,value){
                    rowRole =  $('<span class="mb-2 mr-2 badge badge-pill badge-info">' + value + '</span>');
                  $("tr#sid"+id).find("td").eq(7).append(rowRole);
                   })
               }
                        console.log(data.success);
                        $(".alert-highlighted span").text(data.success);
                        $('.alert-highlighted').show();
                        $('#overlayRole').hide();
                        $('#exampleModal').modal('hide');
                        $('.alert-highlighted').fadeOut(5000);
                        tree.destroy();
                        console.log(data.result);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }, 1000)
        })

        function deleteUser(item){

           var id = item.getAttribute("data-value");
            Swal.fire({
                title: 'Are you sure delete user ?',
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
                            url: 'user/' + id,

                            data: {
                                "_token": '{{csrf_token()}}'
                            },
                            success: function (data) {
                                $('#overlay').hide();
                                Swal.fire(
                                    'Deleted!',
                                    data.success,
                                    'success'
                                )
                                $("tr#sid"+id).remove();

                            },
                            error:function (error){
                                console.log(error);
                            }
                        })
                }
            })
        }

    </script>
@endsection



