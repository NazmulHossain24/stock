@extends('layouts.print')

@section('title')
    Monthly Profit and Lose
@endsection
@section('heading')
    Monthly Profit and Lose
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-6 text-sm"></div>
        <div class="col-xs-6 title text-sm text-right"><strong>Month Name: </strong>{{$months}}, {{$year}}</div>
    </div>
    <div class="row">
        <div class="col-md-12">
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

            <div class="row">
                <div class="col-xs-6">
                    <table class="table table-striped table-hover table-condensed table-bordered">
                        <tr>
                            <th>Total Purchase</th>
                            <td>{{money($purchase)}}</td>
                        </tr>
                        <tr>
                            <th>Total Purchase Payment</th>
                            <td>{{money($payed_purchase)}}</td>
                        </tr>
                        <tr>
                            <th>Total Purchase Due</th>
                            <td>{{money($purchase_due)}}</td>
                        </tr>
                        <tr>
                            <th>Total Expense</th>
                            <td>{{money($expense)}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-xs-6">
                    <table class="table table-striped table-hover table-condensed table-bordered">
                        <tr>
                            <th>Total Sell</th>
                            <td>{{money($sell)}}</td>
                        </tr>
                        <tr>
                            <th>Total Sell Payment</th>
                            <td>{{money($payed_sell)}}</td>
                        </tr>
                        <tr>
                            <th>Total Sell Due</th>
                            <td>{{money($sell_due)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection