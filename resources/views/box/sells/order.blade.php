@section('box')

    <div id="checkOutModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Payment And Confirm Checkout</h4>
                </div>
                <form id="ediOrderForm" action="{{action('sell\OrderController@check_out')}}"  method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <input type="hidden" id="id" name="invoiceID">
                        <input type="hidden" id="totalAmount" name="totalAmount">
                        <input type="hidden" id="old_paid" name="oldPaid">
                        <input type="hidden" id="customerID" name="customerID">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="lead text-primary">Invoice Number: <span id="invoices"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="lead text-warning text-right">Due Amount: <span id="due"></span></p>
                            </div>
                        </div>
                        <hr>
                        <div class="input-group">
                            <span class="input-group-addon">Checkout Date</span>
                            <input id="invoice_date" name="checkOutDate" class="form-control" placeholder="Checkout Date" type="text" required>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Discount</span>
                            <input id="discount" name="discount" data-main="0" class="form-control" placeholder="Discount" step="0.1" min="0" value="0" type="number" required>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Paid Amount</span>
                            <input id="paidAmount" name="paidAmount" class="form-control" step="0.1" placeholder="Paid Amount" min="0" value="0" type="number" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Confirm Checkout</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

@endsection