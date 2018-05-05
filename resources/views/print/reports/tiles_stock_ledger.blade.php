@extends('layouts.print')

@section('title')
    Tiles Stock Ledger
@endsection
@section('heading')
    Tiles Stock Ledger
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p><strong>Product: </strong>{{$product->productID}} &#9830; {{$product->name}} &#9830; {{$product->ProductBrand['name']}} &#9830;  {{$product->grade}} &#9830; {{$product->category['name']}} &#9830; [{{t_size($product->p_size['height'], $product->p_size['width'])}}]</p>
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
                        <td>{{$row->quantity_in}} pcs/{{number_format((($row->quantity_in * $product->p_size['height'] * $product->p_size['width'])/144),2)}} {{$product->unit}}</td>
                        <td>{{$row->quantity_out}} pcs/{{number_format((($row->quantity_out * $product->p_size['height'] * $product->p_size['width'])/144),2)}} {{$product->unit}}</td>
                        <td>{{($row->quantity_in - $row->quantity_out)}} pcs/{{number_format(((($row->quantity_in - $row->quantity_out) * $product->p_size['height'] * $product->p_size['width'])/144),2)}} {{$product->unit}}</td>
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
                    <th>{{$product_in}} pcs/{{number_format((($product_in * $product->p_size['height'] * $product->p_size['width'])/144),2)}} {{$product->unit}}</th>
                    <th>{{$product_out}} pcs/{{number_format((($product_out * $product->p_size['height'] * $product->p_size['width'])/144),2)}} {{$product->unit}}</th>
                    <th> {{($product_in - $product_out)}} pcs/{{number_format(((($product_in - $product_out) * $product->p_size['height'] * $product->p_size['width'])/144),2)}} {{$product->unit}}</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection