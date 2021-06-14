<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static"
     data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new role</h5>
                <button type="button" id="btn-hidden" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name" class="col-form-label">Role Name</label>
                        <input name="name" id="name" type="text" class="form-control" placeholder="role name" value="">
                        <div class="invalid-feedback name"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary btn-pill"
                        data-dismiss="modal">Close
                </button>
                <button type="submit" id="role-submit" class="btn btn-success btn-pill">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</div>
