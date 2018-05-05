@extends('layouts.master')

@section('title')
    Sells Ledger
@endsection

@section('page')
    Sells Ledger
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>#Invoice</th>
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
                            <td>{{pub_date($row->invoice['checkOutDate'])}}</td>
                            <td><a href="{{url('sell/invoice_info', [$row->invoiceID])}}">{{$row->invoiceID}}</a></td>
                            @if($row->isReturn == 0)
                                <td class="text-green" title="Product General Status.">Sell</td>
                            @else
                                <td class="text-warning" title="Product Return Status.">Return</td>
                            @endif
                            <td>{{$row->product['name'] or ''}}</td>
                            <td>{{$row->product->category['name'] or ''}}</td>
                            @if($row->product['type'] == 'Tiles')
                            <td>{{$row->product->ProductBrand['name'] or ''}} [{{t_size($row->product->p_size['height'],$row->product->p_size['width'])}}]</td>

                            <td>{{$row->quantity}} pcs/{{number_format((($row->quantity * $row->product->p_size['height'] * $row->product->p_size['width'])/144),2)}} {{$row->product['unit']}}</td>
                                @else
                            <td>{{$row->product->ProductBrand['name'] or ''}}</td>
                            <td>{{$row->quantity}} {{$row->product['unit'] or ''}}</td>
                            @endif
                            <td>{{money($row->unitPrice)}}</td>
                            <td>{{money($row->unitPrice*$row->quantity)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        $(function () {
            $('#dataTable').DataTable({
                "order": [[ 0, "desc" ]],
            });
        });
    </script>



@endsection
