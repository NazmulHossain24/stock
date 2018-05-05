@extends('layouts.print')

@section('title')
    Receipt List
@endsection
@section('heading')
    Purchase Receipt List
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-6 text-sm"><strong>Supplier: </strong>{{$supplier}}</div>
        <div class="col-xs-6 title text-sm text-right"><strong>Date Range: </strong>{{$date_range}}</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Supplier</th>
                    <th>Contact</th>
                    <th>Total</th>
                    <th>Paid</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total = 0;
                $paid = 0;
                ?>
                @foreach($table as $row)
                    <tr>
                        <td>{{$row->receiptID}}</td>
                        <td>{{pub_date($row->checkOutDate)}}</td>
                        <td>{{$row->supplier['name']}}</td>
                        <td>{{$row->supplier['contact']}}</td>
                        <td>{{money($row->bill($row->receiptID) - $row->re_bill($row->receiptID))}}</td>
                        <td>{{money($row->paid($row->receiptID))}}</td>
                    </tr>

                    <?php
                    $total += ($row->bill($row->receiptID) - ($row->re_bill($row->receiptID)));
                    $paid += $row->paid($row->receiptID);
                    ?>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="text-right" colspan="4">Total:</th>
                    <th>{{money($total)}}</th>
                    <th>{{money($paid)}}</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection