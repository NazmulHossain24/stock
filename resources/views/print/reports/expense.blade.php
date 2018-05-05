@extends('layouts.print')

@section('title')
    Other Expense
@endsection
@section('heading')
    Other Expense
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-8 text-sm"><strong>Expense Category: </strong>{{$expense}}</div>
        <div class="col-xs-4 title text-sm text-right"><strong>Date Range: </strong>{{$date_range}}</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Expense Category</th>
                    <th>Amount</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $total = 0;
                ?>
                @foreach($table as $row)
                    <tr>
                        <td>{{$row->expenseTransactionsID}}</td>
                        <td>{{pub_date($row->created_at)}}</td>
                        <td>{{$row->expenseName}}</td>
                        <td>{{money($row->amount)}}</td>
                    </tr>
                    <?php
                    $total += $row->amount;
                    ?>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="text-right" colspan="3">Total:</th>
                    <th>{{money($total)}}</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection