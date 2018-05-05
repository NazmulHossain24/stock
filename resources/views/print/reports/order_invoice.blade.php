@extends('layouts.print')

@section('title')
    Order Invoice List
@endsection
@section('heading')
    Sell order invoice List
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-6 text-sm"><strong>Customer: </strong>{{$customer}}</div>
        <div class="col-xs-6 title text-sm text-right"><strong>Date Range: </strong>{{$date_range}}</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Contact</th>
                    <th>Bill</th>
                    <th>Discount</th>
                    <th>Total</th>
                    <th>Paid</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $bill = 0;
                    $discount = 0;
                    $total = 0;
                    $paid = 0;
                ?>
                @foreach($table as $row)
                    <tr>
                        <td>{{$row->invoiceID}}</td>
                        <td>{{pub_date($row->created_at)}}</td>
                        <td>{{$row->customer['name']}}</td>
                        <td>{{$row->customer['contact']}}</td>
                        <td>{{money($row->bill($row->invoiceID) - $row->re_bill($row->invoiceID))}}</td>
                        <td>{{money($row->discount)}}</td>
                        <td>{{money($row->bill($row->invoiceID) - ($row->re_bill($row->invoiceID) + $row->discount))}}</td>
                        <td>{{money($row->paid($row->invoiceID))}}</td>
                    </tr>
                <?php
                    $bill += ($row->bill($row->invoiceID) - $row->re_bill($row->invoiceID));
                    $discount += $row->discount;
                    $total += ($row->bill($row->invoiceID) - ($row->re_bill($row->invoiceID) + $row->discount));
                    $paid += $row->paid($row->invoiceID);
                ?>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-right" colspan="4">Total:</th>
                        <th>{{money($bill)}}</th>
                        <th>{{money($discount)}}</th>
                        <th>{{money($total)}}</th>
                        <th>{{money($paid)}}</th>
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection