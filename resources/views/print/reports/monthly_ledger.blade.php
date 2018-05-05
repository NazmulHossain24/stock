@extends('layouts.print')

@section('title')
    Monthly Full Ledger
@endsection
@section('heading')
    Monthly Full Ledger
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-6 text-sm"></div>
        <div class="col-xs-6 title text-sm text-right"><strong>Month Name: </strong>{{$months}}, {{$year}}</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Purchase</th>
                    <th>Purchase Payment</th>
                    <th>Purchase Due</th>
                    <th>Sell</th>
                    <th>Sell Payment</th>
                    <th>Sell Due</th>
                    <th>Expense</th>
                    <th>Profit</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $sell = 0;
                $purchase = 0;
                $expense = 0;
                $payed_purchase = 0;
                $purchase_due = 0;
                $payed_sell = 0;
                $sell_due = 0;
                ?>
                @foreach($table as $row)
                    <tr>
                        <td>{{$row['date']}}</td>
                        <td>{{money($row['purchase'])}}</td>
                        <td>{{money($row['payed_purchase'])}}</td>
                        <td>{{money($row['purchase_due'])}}</td>
                        <td>{{money($row['sell'])}}</td>
                        <td>{{money($row['payed_sell'])}}</td>
                        <td>{{money($row['sell_due'])}}</td>
                        <td>{{money($row['expense'])}}</td>
                        <td>{{money($row['sell'] - ($row['purchase'] + $row['expense']))}}</td>
                    </tr>
                    <?php
                    $sell += $row['sell'];
                    $purchase +=  $row['purchase'];
                    $expense += $row['expense'];
                    $payed_purchase += $row['payed_purchase'];
                    $purchase_due += $row['purchase_due'];
                    $payed_sell += $row['payed_sell'];
                    $sell_due += $row['sell_due'];
                    ?>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="text-right" colspan="1">Total:</th>
                    <th>{{money($purchase)}}</th>
                    <th>{{money($payed_purchase)}}</th>
                    <th>{{money($purchase_due)}}</th>
                    <th>{{money($sell)}}</th>
                    <th>{{money($payed_sell)}}</th>
                    <th>{{money($sell_due)}}</th>
                    <th>{{money($expense)}}</th>
                    <th>{{money($sell - ($purchase + $expense))}}</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection