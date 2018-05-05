@extends('layouts.print')

@section('title')
    Product Stock Ledger
@endsection
@section('heading')
    Product Stock Ledger
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p><strong>Product: </strong>{{$product->productID}} &#9830; {{$product->name}} &#9830; {{$product->ProductBrand['name']}} &#9830; {{$product->category['name']}}</p>
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Stock In</th>
                    <th>Stock Out</th>
                    <th>Stock Balance</th>
                </tr>
                </thead>

                <tbody>
                <?php
                    $product_in = 0;
                    $product_out = 0;
                    $i = 1;
                ?>
                @foreach($table as $row)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{pub_date($row->date)}}</td>
                        <td>{{$row->quantity_in}} {{$product->unit}}</td>
                        <td>{{$row->quantity_out}} {{$product->unit}}</td>
                        <td>{{$row->quantity_in - $row->quantity_out}} {{$product->unit}}</td>
                    </tr>
                    <?php
                        $product_in += $row->quantity_in;
                        $product_out += $row->quantity_out;
                        $i++;
                    ?>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="text-right" colspan="2">Total:</th>
                    <th>{{$product_in}} {{$product->unit}}</th>
                    <th>{{$product_out}} {{$product->unit}}</th>
                    <th>{{$product_in - $product_out}} {{$product->unit}}</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection