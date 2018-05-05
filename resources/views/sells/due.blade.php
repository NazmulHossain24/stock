@extends('layouts.master')
@extends('box.sells.due')

@section('title')
    Sell Due Invoice
@endsection

@section('page')
    Sell Due Invoice
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
                        <th>Paid</th>
                        <th>Due</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td><a href="{{url('sell/invoice_info', [$row->invoiceID])}}">{{$row->invoiceID}}</a></td>
                            <td>{{pub_date($row->checkOutDate)}}</td>
                            <td>{{$row->customer['name']}}</td>
                            <td>{{$row->customer['contact']}}</td>
                            <td>{{money($row->bill($row->invoiceID) - $row->re_bill($row->invoiceID))}}</td>
                            <td>{{money($row->discount)}}</td>
                            <td>{{money($row->paid($row->invoiceID))}}</td>
                            <td>{{money($row->bill($row->invoiceID) - ($row->discount + $row->re_bill($row->invoiceID) + $row->paid($row->invoiceID)))}}</td>

                            @if($row->status == 'Unpaid')
                                <td><button class="btn btn-flat btn-danger btn-xs ediModal" data-customer="{{$row->customer['customerID']}}" data-id="{{$row->invoiceID}}" data-due="{{$row->bill($row->invoiceID) - ($row->discount +  $row->re_bill($row->invoiceID) + $row->paid($row->invoiceID))}}"  data-toggle="modal" data-target="#invoiceModal">{{$row->status}}</button></td>
                            @elseif($row->status == 'Partial')
                                <td><button class="btn btn-flat btn-warning btn-xs ediModal" data-customer="{{$row->customer['customerID']}}" data-id="{{$row->invoiceID}}" data-due="{{$row->bill($row->invoiceID) - ($row->discount + $row->re_bill($row->invoiceID) + $row->paid($row->invoiceID))}}" data-toggle="modal" data-target="#invoiceModal">{{$row->status}}</button></td>
                            @elseif($row->status == 'Payable')
                                <td><button class="btn btn-flat btn-success btn-xs ediModal2" data-customer="{{$row->customer['customerID']}}" data-id="{{$row->invoiceID}}" data-paied="{{$row->bill($row->invoiceID) - ($row->discount + $row->re_bill($row->invoiceID) + $row->paid($row->invoiceID))}}" data-toggle="modal" data-target="#invoicePayModal">{{$row->status}}</button></td>
                            @endif
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
                "order": [[ 0, "desc" ]]
            });
        });

        $(function () {
            $('.ediModal').click(function () {
                var id = $(this).data('id');
                var due = $(this).data('due');
                var customer = $(this).data('customer');

                $('#id').val(id);
                $('#customerID').val(customer);
                $('#due').html(due);
                $('#invoices').html(id);
                $('#discount').attr('max', due);
                $('#paidAmount').attr('max', due);
                $('#paidAmount').val(due);
            });


            $('.ediModal2').click(function () {
                var id = $(this).data('id');
                var paied1 = $(this).data('paied');
                var paied = Math.abs(paied1);
                var customer = $(this).data('customer');

                $('#id2').val(id);
                $('#customerID2').val(customer);
                $('#payble').html(paied);
                $('#invoices2').html(id);
                $('#returnAmount').attr('max', paied);
                $('#returnAmount').val(paied);
            });

        });



    </script>

@endsection
