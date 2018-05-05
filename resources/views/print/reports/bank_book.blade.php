@extends('layouts.print')

@section('title')
    Bank Book Ledger
@endsection
@section('heading')
    Bank Book Ledger
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-8 text-sm"><strong>Bank Account: </strong>{{$bank}}</div>
        <div class="col-xs-4 title text-sm text-right"><strong>Date Range: </strong>{{$date_range}}</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Deposit</th>
                    <th>Withdraw</th>
                    <th>Balance</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $deposit = 0;
                $withdraw = 0;
                $i = 1;
                ?>
                @foreach($table as $row)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{pub_date($row->date)}}</td>
                        <td>{{money($row->deposit)}}</td>
                        <td>{{money($row->withdraw)}}</td>
                        <td>{{money($row->deposit - $row->withdraw)}}</td>
                    </tr>
                    <?php
                    $deposit += $row->deposit;
                    $withdraw += $row->withdraw;
                    $i++;
                    ?>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="text-right" colspan="2">Total:</th>
                    <th>{{money($deposit)}}</th>
                    <th>{{money($withdraw)}}</th>
                    <th>{{money($deposit - $withdraw)}}</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection