@section('box')

    <div id="receiptModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Due Payment</h4>
                </div>
                <form action="{{action('purchase\DueController@payments')}}"  method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <input type="hidden" id="id" name="receiptID">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="lead text-primary">Receipt Number: <span id="receipt"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="lead text-warning text-right">Due Amount: <span id="due"></span></p>
                            </div>
                        </div>
                        <hr>

                        <div class="input-group">
                            <span class="input-group-addon">Paid Amount</span>
                            <input id="paidAmount" name="paidAmount" class="form-control" step="0.1" placeholder="Paid Amount" min="0" value="0" type="number" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Confirm Payment</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="receiptPayModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Money return from supplier</h4>
                </div>
                <form action="{{action('purchase\DueController@payments_return')}}"  method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <input type="hidden" id="id2" name="receiptID">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="lead text-primary">Receipt Number: <span id="receipt2"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="lead text-success text-right">Receivable Amount: <span id="payble"></span></p>
                            </div>
                        </div>
                        <hr>

                        <div class="input-group">
                            <span class="input-group-addon">Return Amount</span>
                            <input id="returnAmount" name="returnAmount" class="form-control" step="0.1" placeholder="Return Amount" min="0" value="0" type="number" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Confirm Money Back</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

@endsection