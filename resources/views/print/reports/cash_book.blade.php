@extends('layouts.print')

@section('title')
    Cash Book Ledger
@endsection
@section('heading')
    Cash Book Ledger
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-6 text-sm"></div>
        <div class="col-xs-6 title text-sm text-right"><strong>Date Range: </strong>{{$date_range}}</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-hover table-condensed table-bordered">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Date</th>
                    <th>Cash In</th>
                    <th>Cash Out</th>
                    <th>Balance</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $cash_in = 0;
                $cash_out = 0;
                $i = 1;
                ?>
                @foreach($table as $row)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{pub_date($row->date)}}</td>
                        <td>{{money($row->cash_in)}}</td>
                        <td>{{money($row->cash_out)}}</td>
                        <td>{{money($row->cash_in - $row->cash_out)}}</td>
                    </tr>
                    <?php
                    $cash_in += $row->cash_in;
                    $cash_out += $row->cash_out;
                    $i++;
                    ?>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="text-right" colspan="2">Total:</th>
                    <th>{{money($cash_in)}}</th>
                    <th>{{money($cash_out)}}</th>
                    <th>{{money($cash_in - $cash_out)}}</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
@endsection