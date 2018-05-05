@extends('layouts.master')
@extends('box.bankbook.bankbook')
@section('title')
    Bank Book
@endsection

@section('page')
    Bank Book
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 btn_mod">
            <button class="btn btn-social btn-primary btn-flat" data-toggle="modal" data-target="#depositModal">
                <i class="fa fa-plus"></i>
                Deposit Amount
            </button>
            <button class="btn btn-social btn-warning btn-flat" data-toggle="modal" data-target="#withdrawModal">
                <i class="fa fa-minus"></i>
                Withdraw Amount
            </button>
        </div>
        <div class="col-md-6">
            <?php $totalAmount = 0; ?>
            @foreach($table as $row)
                <?php $totalAmount += ($row->amountDeposit - $row->amountWithdraw) ?>
            @endforeach
            <p class="lead text-right text-primary text-bold">Total Deposit: {{money($totalAmount)}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Date</th>
                        <th>Bank</th>
                        <th>Bank A/C</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{$row->bankBookID}}</td>
                            <td>{{pub_date($row->created_at)}}</td>
                            <td>{{$row->bank['name']}}</td>
                            <td>{{ac_type($row->bank['AccountNumber'])}}</td>
                            <td>{{$row->paymentDescription}}</td>
                            <td>{{$row->paymentType}}</td>
                            <td>{{money_abs($row->amountDeposit - $row->amountWithdraw)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        $(function () {
            $('#dataTable').DataTable({
                "order": [[ 0, "desc" ]],
            });
        });

    </script>

@endsection
