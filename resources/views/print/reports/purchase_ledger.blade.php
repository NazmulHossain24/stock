@extends('layouts.print')

@section('title')
    Purchase Ledger
@endsection
@section('heading')
    Purchase Product Ledger
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-6 text-sm"></div>
        <div class="col-xs-6 title text-sm text-right"><strong>Date Range: </strong>{{$date_range}}</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>#Receipt</th>
                    <th>Type</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
                </thead>

                <tbody>
                @foreach($table as $row)
                    <tr>
                        <td>{{pub_date($row->receipt['checkOutDate'])}}</td>
                        <td>{{$row->receiptID}}</td>
                        @if($row->isReturn == 0)
                            <td class="text-green" title="Product General Status.">Buy</td>
                        @else
                            <td class="text-warning" title="Product Return Status.">Return</td>
                        @endif
                        <td>{{$row->product['name']}}</td>
                        <td>{{$row->product->category['name']}}</td>
                        @if($row->product['type'] == 'Tiles')
                            <td>{{$row->product->ProductBrand['name']}} [{{t_size($row->product->p_size['height'],$row->product->p_size['width'])}}]</td>
                            <td>{{$row->quantity}} pcs/{{number_format((($row->quantity * $row->product->p_size['height'] * $row->product->p_size['width'])/144),2)}} {{$row->product['unit']}}</td>
                        @else
                            <td>{{$row->product->ProductBrand['name']}}</td>
                            <td>{{$row->quantity}} {{$row->product['unit']}}</td>
                        @endif
                        <td>{{money($row->unitPrice)}}</td>
                        <td>{{money($row->unitPrice*$row->quantity)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection