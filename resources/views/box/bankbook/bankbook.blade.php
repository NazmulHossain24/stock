@section('box')

    <div id="depositModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Deposit Amount to Bank</h4>
                </div>
                <form action="{{action('bankbook\BankbookController@deposit')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Bank A/C</span>
                            <select name="bankID" class="form-control">
                                @foreach($bank as $row)
                                    <option value="{{$row->bankID}}">{{$row->name}} [{{$row->AccountNumber}}]</option>
                                @endforeach
                            </select>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Deposit Amount</span>
                            <input name="amountDeposit" class="form-control" step="0.01" placeholder="Deposit Amount" type="number" min="0" required>
                        </div><br>

                        <div class="form-group">
                            <label>Payment Description <span class="text-sm text-muted">Deposit Slip Number or any thing</span></label>
                            <textarea class="form-control" name="paymentDescription" rows="3" placeholder="Deposit Slip Number or writing any thing ..."></textarea>
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
                    <h4 class="modal-title">Withdraw Amount From Bank</h4>
                </div>
                <form id="ediCategoryForm" action="{{action('bankbook\BankbookController@withdraw')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id">
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Bank A/C</span>
                            <select name="bankID" class="form-control">
                                @foreach($bank as $row)
                                    <option value="{{$row->bankID}}">{{$row->name}} [{{$row->AccountNumber}}]</option>
                                @endforeach
                            </select>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Withdraw Amount</span>
                            <input name="amountWithdraw" class="form-control" step="0.01" placeholder="Withdraw Amount" type="number" min="0" required>
                        </div><br>

                        <div class="form-group">
                            <label>Payment Description  <span class="text-sm text-muted">Cheque Number or any thing</span></label>
                            <textarea class="form-control" name="paymentDescription" rows="3" placeholder="Cheque Number or writing any thing ..."></textarea>
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