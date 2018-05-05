@extends('layouts.master')
@extends('box.customer.accounts')

@section('title')
    Customer Accounts
@endsection

@section('page')
    Customer Accounts
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Category</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Balance</th>
                        <th class="text-center">Info</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{$row->customerID}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->contact}}</td>
                            <td>{{$row->category['name']}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->address}}</td>
                            <td>{{money($row->accounts($row->customerID))}}</td>
                            <td class="text-center">
                                <!--<button class="btn btn-xs btn-flat btn-success addModal" data-customer="{{$row->name}} [{{$row->contact}}]" data-id="{{$row->customerID}}"  data-toggle="modal" data-target="#addModal" title="Add Money to accounts"><i class="fa fa-download"></i></button>
                                <button class="btn btn-xs btn-flat btn-warning withdrawModal" data-customer="{{$row->name}} [{{$row->contact}}]"  data-id="{{$row->customerID}}"  data-toggle="modal" data-target="#withdrawModal" title="Withdraw Money from accounts"><i class="fa fa-upload"></i></button>-->
                                <a href="{{url('customer/account/transactions', [$row->customerID])}}" class="btn btn-xs btn-flat btn-info" title="View account transactions"><i class="fa fa-eye"></i></a>
                            </td>
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

        /*$(function () {
            $('.addModal').click(function () {
                var id = $(this).data('id');
                var customer = $(this).data('customer');

                $('#customerID').val(id);
                $('#customer').html(customer);

            });
        });

        $(function () {
            $('.withdrawModal').click(function () {
                var id = $(this).data('id');
                var customer = $(this).data('customer');

                $('#customerID2').val(id);
                $('#customer2').html(customer);

            });
        });*/

    </script>

@endsection

