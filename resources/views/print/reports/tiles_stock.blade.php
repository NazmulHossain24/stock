@extends('layouts.print')

@section('title')
    Tiles Stock
@endsection
@section('heading')
    Tiles Stock List
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Model</th>
                    <th>Category</th>
                    <th>Size</th>
                    <th>Brand</th>
                    <th>Grade</th>
                    <th>Stock(pcs)</th>
                    <th>Stock(sqf)</th>
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
                        <td>[{{t_size($row->p_size['height'],$row->p_size['width'])}}]</td>
                        <td>{{$row->ProductBrand['name']}}</td>
                        <td>{{$row->grade}}</td>
                        <td>{{$row->stock}}</td>
                        <td>{{number_format(($row->stock * $row->p_size['height'] * $row->p_size['width']) /144, '2') }}</td>
                        <td>{{$row->inOrder}}</td>
                        @if((($row->stock * $row->p_size['height'] * $row->p_size['width']) /144) < 200)
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