@section('box')

    <div id="returnModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Return Product Item</h4>
                </div>
                <form id="ediOrderForm" action="{{action('purchase\ReceiptController@return_item')}}"  method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <input type="hidden" id="receiptID" name="receiptID">

                        <div class="row">
                            <div class="col-md-4">
                                <p class="lead text-primary"><strong>Receipt Number:</strong> <span id="receipt"></span></p>
                            </div>
                            <div class="col-md-8">
                                <p class="lead text-warning text-right"><strong>Supplier:</strong> <span id="supplier"></span></p>
                            </div>
                        </div>
                        <hr>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Return Quantity</th>
                            </tr>
                            </thead>
                            <tbody id="show_item"></tbody>
                        </table>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Confirm Return Item</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

@endsection