@extends('layouts.master')
@extends('box.purchase.receipt')

@section('title')
    Purchase Receipt
@endsection

@section('page')
    Purchase Receipt
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
                        <th>Supplier</th>
                        <th>Contact</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Info</th>
                        <th>Purchase Return</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{$row->receiptID}}</td>
                            <td>{{pub_date($row->checkOutDate)}}</td>
                            <td>{{$row->supplier['name']}}</td>
                            <td>{{$row->supplier['contact']}}</td>
                            <td>{{money($row->bill($row->receiptID) - $row->re_bill($row->receiptID))}}</td>
                            <td>{{money($row->paid($row->receiptID))}}</td>
                            <td><a href="{{url('purchase/receipt_info', [$row->receiptID])}}" class="btn btn-info btn-xs">View</a></td>
                            <td><button data-receipt="{{$row->receiptID}}" data-supplier="{{$row->supplier['name']}} [{{$row->supplier['contact']}}]" type="button" class="btn btn-flat btn-success btn-xs show_return" data-toggle="modal" data-target="#returnModal">Purchase Return</button></td>
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
                    { "orderable": false, "targets": [6,7] }//For Column Order
                ]
            });
        });

        $(function () {

            $('.show_return').click(function () {
                var supplier = $(this).data('supplier');
                var receipt = $(this).data('receipt');

                $('#receiptID').val(receipt);
                $('#supplier').html(supplier);
                $('#receipt').html(receipt);
                show_item_list(receipt);
            });
        });


        function show_item_list(id) {
            var table_value = '';
            var i = 1;
            $.ajax({
                url: "{{url('purchase/purchase_return')}}/"+id,
                type: 'get',
                dataType: 'json',
                success:function(result){
                    $.each( result, function( index, value ){
                        table_value += '<tr>'
                                +'<td>'+i+'</td>'
                                +'<td>'+result[index].name+'</td>'
                                +'<td>'+result[index].description+'</td>'
                                +'<td>'+result[index].qty+'</td>'
                                +'<td><input type="number" name="quantity[]" min="0" max="'+result[index].quantity+'" placeholder="Return Item Qty" value="0" required><input type="hidden" name="my_data[]" value="'+result[index].productID+'x'+result[index].unitPrice+'"></td>'
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
