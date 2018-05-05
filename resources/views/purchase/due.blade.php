@extends('layouts.master')
@extends('box.purchase.due')

@section('title')
    Purchase Due Receipt
@endsection

@section('page')
    Purchase Due Receipt
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
                        <th>Due</th>
                        <th>Status</th>
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
                            <td>{{money($row->bill($row->receiptID) - ($row->re_bill($row->receiptID) + $row->paid($row->receiptID)))}}</td>
                            @if($row->status == 'Unpaid')
                                <td><button class="btn btn-flat btn-danger btn-xs ediModal" data-id="{{$row->receiptID}}" data-due="{{$row->bill($row->receiptID) - ($row->re_bill($row->receiptID) + $row->paid($row->receiptID))}}"  data-toggle="modal" data-target="#receiptModal">{{$row->status}}</button></td>
                            @elseif($row->status == 'Partial')
                                <td><button class="btn btn-flat btn-warning btn-xs ediModal" data-id="{{$row->receiptID}}" data-due="{{$row->bill($row->receiptID) - ($row->re_bill($row->receiptID) + $row->paid($row->receiptID))}}" data-toggle="modal" data-target="#receiptModal">{{$row->status}}</button></td>
                            @elseif($row->status == 'Receivable')
                                <td><button class="btn btn-flat btn-success btn-xs ediModal2" data-id="{{$row->receiptID}}" data-paied="{{$row->bill($row->receiptID) - ($row->re_bill($row->receiptID) + $row->paid($row->receiptID))}}" data-toggle="modal" data-target="#receiptPayModal">{{$row->status}}</button></td>
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
                "order": [[ 0, "desc" ]],
            });
        });

        $(function () {
            $('.ediModal').click(function () {
                var id = $(this).data('id');
                var due = $(this).data('due');

                $('#id').val(id);
                $('#due').html(due);
                $('#receipt').html(id);
                $('#paidAmount').attr('max', due);
                $('#paidAmount').val(due);
            });


            $('.ediModal2').click(function () {
                var id = $(this).data('id');
                var paied1 = $(this).data('paied');
                var paied = Math.abs(paied1);

                $('#id2').val(id);
                $('#payble').html(paied);
                $('#receipt2').html(id);
                $('#returnAmount').attr('max', paied);
                $('#returnAmount').val(paied);
            });

        });

    </script>

@endsection
