<div class="modal fade" id="edit-author" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa tác giả</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="edit_author" >
                    @csrf
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Họ tên lót</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="lastname_edit_author" name="lastname_edit_author">
                            <input  type="hidden" class="form-control" id="idAuthor" name="idAuthor">
                            <div class="invalid-feedback name"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormControlSelect2" class="col-sm-3 col-form-label">Tên</label>
                        <div class="col-9">
                            <input  type="text" class="form-control" id="firstname_edit_author" name="firstname_edit_author" >
                            <div class="invalid-feedback name"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(auth()->user()->hasDirectPermission('Edit') ||auth()->user()->hasDirectPermission('Update')||auth()->user()->hasRole('Administrator'))
                        <button type="submit" id="btn-edit-author" class="btn btn-success btn-pill">@include('admin.category.iconsvg.save')Cập nhật
                        </button>
                        @endif
                            @if(auth()->user()->can('Delete')||auth()->user()->hasRole('Administrator'))
                        <button type="button" class="btn btn-danger btn-pill"  id="btn-delete-author">Xoá</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


