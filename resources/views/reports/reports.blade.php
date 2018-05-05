@extends('layouts.master')

@section('title')
    All Reports
@endsection

@section('page')
    All Reports
@endsection

@section('content')
    <div class="row">
<!-- ######################### Sell Invoice ###################### -->
        <div class="col-md-6">
            <div class="box box-success collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-shopping-bag"></i> Sell Invoice</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <form action="{{action('reports\ReportController@invoices')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="box-body">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    Select Customer
                                </div>
                                <select name="customerID" class="form-control select_two" style="width: 100%">
                                    <option value="">Selected Customer Invoice</option>
                                    @foreach($customers as $row)
                                        <option value="{{$row->customerID}}">{{$row->name}} [{{$row->contact}}]</option>
                                    @endforeach
                                </select>
                            </div><br>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="dateRange" type="text" class="form-control pull-right dateRange" placeholder="Pick Data Range">
                            </div><br>
                            <div class="form-group">
                                <label>
                                    <input  name="status" type="checkbox" value="1"  class="flat-red" checked>
                                    With Due Invoice
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="reset" class="pull-left btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="pull-right btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
<!-- ######################### Sell Invoice ###################### -->
<!-- ######################### Sell Order Invoice ###################### -->
        <div class="col-md-6">
            <div class="box box-danger collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-shopping-bag"></i> Sell Order Invoice</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <form action="{{action('reports\ReportController@invoice_order')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="box-body">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    Select Customer
                                </div>
                                <select name="customerID" class="form-control select_two" style="width: 100%">
                                    <option value="">Selected Customer Invoice</option>
                                    @foreach($customers as $row)
                                        <option value="{{$row->customerID}}">{{$row->name}} [{{$row->contact}}]</option>
                                    @endforeach
                                </select>
                            </div><br>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="dateRange" type="text" class="form-control pull-right dateRange" placeholder="Pick Data Range">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="reset" class="pull-left btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="pull-right btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
<!-- ######################### Sell Order Invoice ###################### -->
    </div>

    <div class="row">
<!-- ######################### Sells Product Ledger ###################### -->
        <div class="col-md-6">
            <div class="box box-warning collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-shopping-bag"></i> Sells Product Ledger</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <form action="{{action('reports\ReportController@sell_ledger')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input name="dateRange" type="text" class="form-control pull-right dateRange" placeholder="Pick Data Range">
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <input  name="isReturn" type="radio" value="0"  class="flat-red">
                                        Without Return Item
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <input  name="isReturn" type="radio" value="1"  class="flat-red">
                                        Return Item Only
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="reset" class="pull-left btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="pull-right btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
<!-- ######################### Sells Product Ledger ###################### -->
<!-- ######################### Purchase Receipt ###################### -->
        <div class="col-md-6">
            <div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-shopping-cart"></i> Purchase Receipt</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <form action="{{action('reports\ReportController@receipt')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="box-body">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    Select Supplier
                                </div>
                                <select name="supplierID" class="form-control select_two" style="width: 100%">
                                    <option value="">Selected Suppliers Receipt</option>
                                    @foreach($suppliers as $row)
                                        <option value="{{$row->supplierID}}">{{$row->name}} [{{$row->contact}}]</option>
                                    @endforeach
                                </select>
                            </div><br>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="dateRange" type="text" class="form-control pull-right dateRange" placeholder="Pick Data Range">
                            </div><br>
                            <div class="form-group">
                                <label>
                                    <input  name="status" type="checkbox" value="1"  class="flat-red" checked>
                                    With Due Receipt
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="reset" class="pull-left btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="pull-right btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
<!-- ######################### Purchase Receipt ###################### -->
    </div>

<!------------------------------------------->
    <div class="row">
<!-- ######################### Purchase Product Ledger ###################### -->
        <div class="col-md-6">
            <div class="box box-success collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-shopping-cart"></i> Purchase Product Ledger</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <form action="{{action('reports\ReportController@purchase_ledger')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input name="dateRange" type="text" class="form-control pull-right dateRange" placeholder="Pick Data Range">
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <input  name="isReturn" type="radio" value="0"  class="flat-red">
                                        Without Return Item
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <input  name="isReturn" type="radio" value="1"  class="flat-red">
                                        Return Item Only
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="reset" class="pull-left btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="pull-right btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
<!-- ######################### Purchase Product Ledger ###################### -->
<!-- ######################### Products Stock ###################### -->
        <div class="col-md-6">
            <div class="box box-danger collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-archive"></i> Products Stock</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <form action="{{action('reports\ReportController@products_stock')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="input-group">
                            <div class="input-group-addon">
                                Select Product Category
                            </div>
                            <select name="productCategoryID" class="form-control">
                                <option value="">Selected Product Category</option>
                                @foreach($products_category as $row)
                                    <option value="{{$row->productCategoryID}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div><br>

                        <div class="input-group">
                            <div class="input-group-addon">
                                Select Product Brand
                            </div>
                            <select name="productBrandID" class="form-control">
                                <option value="">Selected Product Brand</option>
                                @foreach($products_brand as $row)
                                    <option value="{{$row->productBrandID}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="reset" class="pull-left btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="pull-right btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
<!-- ######################### Products Stock ###################### -->

    </div>



    <!------------------------------------------->
    <div class="row">
<!-- ######################### Products Stock Ledger ###################### -->
        <div class="col-md-6">
            <div class="box box-warning collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-cubes"></i> Products Stock Ledger</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <form action="{{action('reports\ReportController@product_stock_ledger')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="input-group">
                            <div class="input-group-addon">
                                Select Product
                            </div>
                            <select name="productID" class="form-control select_two" style="width: 100%" required>
                                <option value="">Name &#9830; Brand &#9830; Category</option>
                                @foreach($products as $row)
                                    <option value="{{$row->productID}}">{{$row->name}} &#9830; {{$row->ProductBrand['name']}}  &#9830; {{$row->category['name']}}</option>
                                @endforeach
                            </select>
                        </div><br>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input name="dateRange" type="text" class="form-control pull-right dateRange" placeholder="Pick Data Range">
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="reset" class="pull-left btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="pull-right btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
<!-- ######################### Products Stock Ledger ###################### -->
<!-- ######################### Other Expense ###################### -->
        <div class="col-md-6">
            <div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-upload"></i> Other Expense</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <form action="{{action('reports\ReportController@expenses')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="input-group">
                            <div class="input-group-addon">
                                Expense Category
                            </div>
                            <select name="expenseName" class="form-control select_two" style="width: 100%">
                                <option value="">Select Expense Category</option>
                                @foreach($expense as $row)
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div><br>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input name="dateRange" type="text" class="form-control pull-right dateRange" placeholder="Pick Data Range">
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="reset" class="pull-left btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="pull-right btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
<!-- ######################### Other Expense ###################### -->
    </div>

    <div class="row">
<!-- ######################### Cash Book Ledger ###################### -->
        <div class="col-md-6">
            <div class="box box-success collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-book"></i> Cash Book Ledger</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <form action="{{action('reports\ReportController@cash_book')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input name="dateRange" type="text" class="form-control pull-right dateRange" placeholder="Pick Data Range">
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="reset" class="pull-left btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="pull-right btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
<!-- ######################### Cash Book Ledger ###################### -->
<!-- ######################### Bank Book Ledger ###################### -->
        <div class="col-md-6">
            <div class="box box-danger collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-bank"></i> Bank Book Ledger</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <form action="{{action('reports\ReportController@bank_book')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="input-group">
                            <div class="input-group-addon">
                                Bank Accounts
                            </div>
                            <select name="bankID" class="form-control select_two" style="width: 100%">
                                <option value="">Select Bank Accounts</option>
                                @foreach($bank as $row)
                                    <option value="{{$row->bankID}}">{{$row->name}} [{{$row->AccountNumber}}]</option>
                                @endforeach
                            </select>
                        </div><br>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input name="dateRange" type="text" class="form-control pull-right dateRange" placeholder="Pick Data Range">
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="reset" class="pull-left btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="pull-right btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
<!-- ######################### Bank Book Ledger ###################### -->
    </div>



    <div class="row">
        <!-- ######################### Monthly Full Ledger ###################### -->
        <div class="col-md-6">
            <div class="box box-warning collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calculator"></i> Monthly Full Ledger</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <form action="{{action('reports\ReportController@full_ledger')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="input-group">
                            <div class="input-group-addon">
                                Select Month
                            </div>
                            <select name="month" class="form-control">
                                @foreach($month as $row)
                                    <option value="{{$row->month}}">{{date('F', mktime(0, 0, 0, $row->month, 10))}}</option>
                                @endforeach
                            </select>
                        </div><br>
                        <div class="input-group">
                            <div class="input-group-addon">
                                Select Year
                            </div>
                            <select name="year" class="form-control">
                                @foreach($year as $row)
                                    <option value="{{$row->year}}">{{$row->year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="reset" class="pull-left btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="pull-right btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ######################### Monthly Full Ledger ###################### -->
        <!-- ######################### Monthly Profit And Lose ###################### -->
        <div class="col-md-6">
            <div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-line-chart"></i> Monthly Profit And Lose</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                    </div>
                </div>
                <form action="{{action('reports\ReportController@profit_lose')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="box-body">
                        <div class="input-group">
                            <div class="input-group-addon">
                                Select Month
                            </div>
                            <select name="month" class="form-control">
                                @foreach($month as $row)
                                    <option value="{{$row->month}}">{{date('F', mktime(0, 0, 0, $row->month, 10))}}</option>
                                @endforeach
                            </select>
                        </div><br>
                        <div class="input-group">
                            <div class="input-group-addon">
                                Select Year
                            </div>
                            <select name="year" class="form-control">
                                @foreach($year as $row)
                                    <option value="{{$row->year}}">{{$row->year}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <button type="reset" class="pull-left btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                        <button type="submit" class="pull-right btn btn-success"><i class="fa fa-print"></i> Print</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- ######################### Monthly Profit And Lose ###################### -->
    </div>

@endsection




@section('style')
    <link rel="stylesheet" href="{{asset('public/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('public/plugins/timepicker/bootstrap-timepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/plugins/iCheck/all.css')}}">
@endsection

@section('script')
    <script src="{{asset('public/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('public/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('public/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
    <script src="{{asset('public/plugins/iCheck/icheck.min.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });

            $('[type="reset"]').click(function () {
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck('uncheck');
            });


        });

        $(function () {
            $('.dateRange').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'DD/MM/YYYY'
                }
            });


            $('.dateRange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            $('.dateRange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });

        $(function () {
            $(".select_two").select2();
        });
    </script>

@endsection