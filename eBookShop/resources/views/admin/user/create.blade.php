<div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalFormTitle">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="firstName" class="col-form-label">First Name</label>
                        <input name="firstName" id="firstName" type="text" class="form-control" placeholder="first name" value="">
                        <div class="invalid-feedback firstName"></div>

                    </div>
                    <div class="form-group">
                        <label for="lastName" class="col-form-label">Last Name</label>
                        <input name="lastName" id="lastName" type="text" class="form-control" value="" placeholder="lastname">
                        <div class="invalid-feedback lastName"></div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-form-label">Address</label>
                        <input name="address" id="address" type="text" class="form-control" value="" placeholder="address">
                        <div class="invalid-feedback address"></div>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber" class="col-form-label">PhoneNumber</label>
                        <input name="phoneNumber" id="phoneNumber" type="text" class="form-control" value="" placeholder="phoneNumber" onkeypress="javascript:return isNumber(event)" >
                        <div class="invalid-feedback phoneNumber"></div>
                    </div>
                    <div class="form-group">
                        <label for="userName" class="col-form-label">User Name</label>
                        <input name="userName" id="userName" type="text" class="form-control" placeholder="enter phone number" value="">
                        <div class="invalid-feedback userName"></div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email</label>
                        <input name="email" id="email" type="text" class="form-control" placeholder="enter address" value="">
                        <div class="invalid-feedback email"></div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-form-label">Password</label>
                        <input name="password" id="password" type="password" class="form-control" placeholder="password" value="">
                        <div class="invalid-feedback password"></div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="col-form-label">Confirm Password</label>
                        <input name="password_confirmation"  id="password_confirmation" type="password" class="form-control" placeholder="password confirm" value="">
                        <div class="invalid-feedback password_confirmation"></div>
                    </div>
                    <div class="form-group">
                        <label>Roles</label>
                        <select class="select2bs4" id="arrayRole" multiple="multiple" data-placeholder="Select a role" style="width: 100%;">
                            @foreach($arrRoles as $roles)
                                <option>{{$roles->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-pill" data-dismiss="modal">Close</button>
                <button type="submit" id="btn-submit" class="btn btn-primary btn-pill">Submit</button>
            </div>
        </div>
    </div>
</div>
