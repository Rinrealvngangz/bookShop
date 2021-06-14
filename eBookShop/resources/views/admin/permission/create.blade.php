
    <div class="modal fade" id="exampleModalsmallPermission" tabindex="-1" role="dialog"  data-backdrop="static"
         data-keyboard="false"
         aria-labelledby="exampleModalSmallTitle" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalSmallTitle">Edit permission</h5>
                    <button  onclick="removeFormModalSmall()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['id'=>'form-permission']) !!}
                    <div class="form-group">
                        <label for="arrayPermission">Choose permission</label>
                        <select class="select2bs4" name="arrayPermission[]" id="arrayPermission" multiple="multiple" data-placeholder="Select a permission" style="width: 100%;">

                        </select>
                        <div class="invalid-feedback permission"></div>
                        </div>
                    <div class="m-sm-3">
                        <label class="control outlined control-checkbox"> Cancel register users
                            <input id="cancelUser" name="cancelUser" type="checkbox" value="0">
                            <div class="control-indicator"></div>
                        </label>
                    </div>

                    <div class="m-sm-3">
                        <label class="control outlined control-checkbox"> Cancel register role
                            <input id="cancelRole" name="cancelRole" type="checkbox" value="1">
                            <div class="control-indicator"></div>
                        </label>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-cancel-register" class="btn btn-success btn-pill">Cancel registration</button>
                </div>
            </div>
        </div>
    </div>

