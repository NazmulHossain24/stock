@extends('layouts.print')

@section('title')
    Product Stock
@endsection
@section('heading')
    Product Stock List
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Stock</th>
                    <th>Order</th>
                    <th>Warning</th>
                </tr>
                </thead>

                <tbody>
                @foreach($table as $row)
                    <tr>
                        <td>{{$row->productID}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->category['name']}}</td>
                        <td>{{$row->ProductBrand['name']}}</td>
                        <td>{{$row->stock}} {{$row->unit}}</td>
                        <td>{{$row->inOrder}}</td>
                        @if($row->stock  < 200)
                            <td title="Please Restock This Product. Insufficient product" class="text-warning">Restock</td>
                        @else
                            <td title="More product available" class="text-green">OK</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection