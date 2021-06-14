<div class="modal fade" id="edit_publisher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cập nhật tác giả</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form_update_publisher">
                    @csrf
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tên nhà xuất bản</label>
                        <div class="col-9">
                            <input type="hidden" id="idPublisher" name="idPublisher">
                            <input type="text" class="form-control" id="edit_name_publisher" name="edit_name_publisher" >
                            <div class="invalid-feedback edit_name_publisher"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        @if(auth()->user()->hasDirectPermission('Edit') ||auth()->user()->hasDirectPermission('Update')||auth()->user()->hasRole('Administrator'))
                        <button type="submit" id="btn_edit_publisher" name="btn_edit_publisher" class="btn btn-success btn-pill">@include('admin.category.iconsvg.save')
                            Cập nhật
                        </button>
                        @endif
                            @if(auth()->user()->can('Delete')||auth()->user()->hasRole('Administrator'))
                        <button type="button" class="btn btn-danger btn-pill"  id="btn_delete_publisher">Xoá</button>
                             @endif
                        <button type="button" class="btn btn-secondary btn-pill" data-dismiss="modal">Bỏ qua</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


