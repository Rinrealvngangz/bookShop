
<div class="modal fade" id="exampleModalsmallEdit" tabindex="-1" role="dialog"  data-backdrop="static"
     data-keyboard="false"
     aria-labelledby="exampleModalSmallTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalSmallTitle">Create permission</h5>
                <button  onclick="removeFormModalSmall()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['id'=>'form-create-permission']) !!}
                <div class="form-group">
                    <label for="name" class="col-form-label">Permission Name</label>
                    <input name="name" id="name" type="text" class="form-control" placeholder="permission name" value="">
                    <div class="invalid-feedback name"></div>
                </div>

                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-create-permission" class="btn btn-success btn-pill">Save</button>
            </div>
        </div>
    </div>
</div>


