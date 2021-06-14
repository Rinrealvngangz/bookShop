<div class="modal fade" id="exampleModalSmall" tabindex="-1" role="dialog"  data-backdrop="static"
     data-keyboard="false"
     aria-labelledby="exampleModalSmallTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalSmallTitle">Discount</h5>
                <button   type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['id'=>'form-discount']) !!}
                <div class="container rounded bg-white">
                    <div class="row">

                            <div class="p-3 py-3">
                            <div class="row mt-2">
                                <form id="form-priceChange" way-data="formData" way-persistent="true">
                                    @csrf
                                <div class="col-md-6">
                                    <label for="price" class="labels">Price</label>
                                    <div  way-scope="someScope">
                                        <div way-scope="with">
                                            <input  way-data="something" id="price" name="price" type="text" class="form-control" readonly placeholder="" value="">
                                            <div class="invalid-feedback price"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label for="discount"  class="labels">Percent(%)</label>
                                    <input id="discount" name="discount" type="number"  min="0" max="100" step="10" class="form-control" placeholder="discount percent" onkeyup="binderDiscount(this)" value="">
                                    <div class="invalid-feedback discount"></div>
                                </div>

                                    <input id="idBook" type="hidden" value="">
                                </form>
                            </div>
                            </div>
                    </div>


                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-cancel" data-dismiss="modal" class="btn btn-secondary btn-pill">Cancel</button>
                <button type="button" id="btn-discount" class="btn btn-success btn-pill" onclick="savePriceChange()">Save</button>
            </div>
        </div>
    </div>
</div>
