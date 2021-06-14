<div class="modal fade" id="add_publisher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm tác giả</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-add-publisher" >
                    @csrf
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tên nhà xuất bản</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="add-name-publisher" name="add-name-publisher" >
                            <div class="invalid-feedback add-name-publisher"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if(auth()->user()->hasDirectPermission('Create')||auth()->user()->hasRole('Administrator'))
                        <button type="submit" id="btn-add-publisher" class="btn btn-success btn-pill">@include('admin.category.iconsvg.save')Thêm
                        </button>
                        @endif
                        <button type="button" class="btn btn-secondary btn-pill" data-dismiss="modal">Bỏ qua</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


