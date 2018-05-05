@extends('layouts.master')
@extends('box.sells.order')

@section('title')
    Sell Order Invoice
@endsection

@section('page')
    Sell Order invoice
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
                        <th class="text-center">Action</th>
                        <th class="text-right">Cancel</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{$row->invoiceID}}</td>
                            <td>{{pub_date($row->created_at)}}</td>
                            <td>{{$row->customer['name']}}</td>
                            <td>{{$row->customer['contact']}}</td>
                            <td>{{money($row->bill($row->invoiceID) - $row->re_bill($row->invoiceID))}}</td>
                            <td>{{money($row->discount)}}</td>
                            <td>{{money($row->paid($row->invoiceID))}}</td>
                            <td>{{money($row->bill($row->invoiceID) - ($row->discount + $row->re_bill($row->invoiceID) + $row->paid($row->invoiceID)))}}</td>
                            <td>{{$row->status}}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success btn-flat btn-xs ediModal" title="Check out this invoice" data-customer="{{$row->customer['customerID']}}" data-id="{{$row->invoiceID}}" data-paid="{{$row->paid($row->invoiceID)}}" data-total="{{$row->bill($row->invoiceID)}}" data-due="{{$row->bill($row->invoiceID) - ($row->discount + $row->paid($row->invoiceID))}}" data-toggle="modal" data-target="#checkOutModal"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                                <a href="{{url('sell/invoice_info', [$row->invoiceID])}}" class="btn btn-info btn-flat btn-xs" title="View invoice"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>
                            <td class="text-right {{(Auth::user()->roles == 'employee' ? 'nv':'')}}"><a href="{{url('sell/order/del', [$row->invoiceID, $row->checkOut])}}" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/plugins/datepicker/datepicker3.css')}}">
@endsection

@section('script')
    <script src="{{asset('public/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <script type="text/javascript">


        $(function () {
            $('#dataTable').DataTable({
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    { "orderable": false, "targets": [9,10] }//For Column Order
                ]
            });
        });

        $(function () {

            $('#invoice_date').datepicker({
                defaultDate: 'now',
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                endDate: '0',
            }).datepicker("setDate", "0");
        });

        $(function () {
            $('.ediModal').click(function () {
                var id = $(this).data('id');
                var due = $(this).data('due');
                var total = $(this).data('total');
                var old_paid = $(this).data('paid');
                var customer = $(this).data('customer');

                $('#id').val(id);
                $('#totalAmount').val(total);
                $('#old_paid').val(old_paid);
                $('#paidAmount').val(due);
                $('#customerID').val(customer);
                $('#due').html(due);
                $('#invoices').html(id);
                $('#paidAmount').attr('max', due);
                $('#discount').attr('max', due);
            });
        });

    </script>

@endsection
