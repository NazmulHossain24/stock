@extends('layouts.master')
@extends('box.expense.expense')

@section('title')
    All Expense
@endsection

@section('page')
    All Expense
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 btn_mod">
            <button class="btn btn-social btn-primary btn-flat" data-toggle="modal" data-target="#expenseModal">
                <i class="fa fa-plus"></i>
                Add New Expense
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Date</th>
                        <th>Expense Category Name</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{$row->expenseTransactionsID}}</td>
                            <td>{{pub_date($row->created_at)}}</td>
                            <td>{{$row->expenseName}}</td>
                            <td>{{money($row->amount)}}</td>
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
    </script>

@endsection
