@section('box')

    <div id="addModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Deposit Money to accounts</h4>
                </div>
                <form action="{{action('customer\AccountsController@add')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <input type="hidden" id="customerID" name="customerID">
                    <div class="modal-body">

                        <p class="lead text-success" id="customer"></p>
                        <hr>

                        <div class="input-group">
                            <span class="input-group-addon">Amount</span>
                            <input name="amount_add" class="form-control" placeholder="Deposit Money to accounts" step="0.01"  min="0" type="number" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <div id="withdrawModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Withdraw Money from accounts</h4>
                </div>
                <form action="{{action('customer\AccountsController@withdraw')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <input type="hidden" id="customerID2" name="customerID">
                    <div class="modal-body">

                        <p class="lead text-warning" id="customer2"></p>
                        <hr>

                        <div class="input-group">
                            <span class="input-group-addon">Amount</span>
                            <input name="amount_remove" class="form-control" placeholder="Withdraw Money from accounts" step="0.01"  min="0" type="number" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection