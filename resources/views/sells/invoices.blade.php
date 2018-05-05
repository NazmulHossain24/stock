@extends('layouts.master')
@extends('box.sells.invoice')

@section('title')
    Sell Invoice
@endsection

@section('page')
    Sell Invoice
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
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
                        <th>Info</th>
                        <th>Sell Return</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{$row->invoiceID}}</td>
                            <td>{{pub_date($row->checkOutDate)}}</td>
                            <td>{{$row->customer['name']}}</td>
                            <td>{{$row->customer['contact']}}</td>
                            <td>{{money($row->bill($row->invoiceID) - $row->re_bill($row->invoiceID))}}</td>
                            <td>{{money($row->discount)}}</td>
                            <td>{{money($row->bill($row->invoiceID) - ($row->re_bill($row->invoiceID) + $row->discount))}}</td>
                            <td>{{money($row->paid($row->invoiceID))}}</td>
                            <td><a href="{{url('sell/invoice_info', [$row->invoiceID])}}" class="btn btn-flat btn-info btn-xs">View</a></td>
                            <td><button data-invoice="{{$row->invoiceID}}" data-customer="{{$row->customer['name']}} [{{$row->customer['contact']}}]" type="button" class="btn btn-flat btn-success btn-xs show_return" data-toggle="modal" data-target="#returnModal">Sell Return</button></td>
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
                "columnDefs": [
                    { "orderable": false, "targets": [7,8] }//For Column Order
                ]
            });
        });


        $(function () {

            $('.show_return').click(function () {
                var customer = $(this).data('customer');
                var invoice = $(this).data('invoice');

                $('#invoiceID').val(invoice);
                $('#customer').html(customer);
                $('#invoices').html(invoice);
                show_item_list(invoice);
            });
        });


        function show_item_list(id) {
            var table_value = '';
            var i = 1;
            $.ajax({
                url: "{{url('sell/sell_return')}}/"+id,
                type: 'get',
                dataType: 'json',
                success:function(result){
                    $.each( result, function( index, value ){
                        table_value += '<tr>'
                                +'<td>'+i+'</td>'
                                +'<td>'+result[index].name+'</td>'
                                +'<td>'+result[index].description+'</td>'
                                +'<td>'+result[index].qty+'</td>'
                                +'<td><input type="number" name="quantity[]" min="0" max="'+result[index].quantity+'" placeholder="Return Item Qty" value="0" required><input type="hidden" name="my_data[]" value="'+result[index].productID+'x'+result[index].buyPrice+'x'+result[index].unitPrice+'"></td>'
                                +'</tr>';
                        i++;
                    });
                    $('#show_item').html(table_value);
                },
                error: function (jXHR, textStatus, errorThrown) {html("")}
            });
        }

    </script>

@endsection
