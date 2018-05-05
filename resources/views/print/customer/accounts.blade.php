@extends('layouts.print')

@section('title')
    Customer Accounts Transactions
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="lead">{{$customer->name}} [{{$customer->contact}}]</p>
            <table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Add Amount</th>
                    <th>Withdraw Amount</th>
                    <th>Balance</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $amount = 0;
                ?>
                @foreach($table as $row)
                    <tr>
                        <td>{{$row->customerAccountsID}}</td>
                        <td>{{pub_date($row->created_at)}}</td>
                        <td>{{$row->type}}</td>
                        <td>{{money($row->amount_add)}}</td>
                        <td>{{money($row->amount_remove)}}</td>
                        <td>{{money($row->amount_add - $row->amount_remove)}}</td>
                    </tr>
                    <?php
                    $amount += ($row->amount_add - $row->amount_remove);
                    ?>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-right">Total:</th>
                        <th>{{money($amount)}}</th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection