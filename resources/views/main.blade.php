@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('page')
    Dashboard
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box  box-primary">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-flash"></i> Quick Access Bar</h3>
                </div>
                <div class="box-body">
                    <a href="{{url('sell')}}" class="btn btn-app {{(Auth::user()->roles == 'Accountant' ? 'nv':'')}}">
                        <i class="fa fa-shopping-bag"></i> New Sell
                    </a>
                    <a href="{{url('purchase')}}" class="btn btn-app {{(Auth::user()->roles == 'Accountant' ? 'nv':'')}}">
                        <i class="fa fa-shopping-cart"></i> New Purchase
                    </a>
                    <a href="{{url('stock/product')}}" class="btn btn-app">
                        <i class="fa fa-database"></i> Product Stock
                    </a>
                    <a href="{{url('customer')}}" class="btn btn-app">
                        <i class="fa fa-users"></i> Customer
                    </a>
                    <a href="{{url('supplier')}}" class="btn btn-app">
                        <i class="fa fa-user-secret"></i> Supplier
                    </a>
                    <a href="{{url('product')}}" class="btn btn-app">
                        <i class="fa fa-cubes"></i> Product
                    </a>
                    <a href="{{url('expense')}}" class="btn btn-app {{(Auth::user()->roles == 'Sells' ? 'nv':'')}}">
                        <i class="fa fa-upload"></i> Expense
                    </a>
                    <a href="{{url('cashbook')}}" class="btn btn-app {{(Auth::user()->roles == 'Sells' ? 'nv':'')}}">
                        <i class="fa fa-book"></i> Cash Book
                    </a>

                    <a href="{{url('bankbook')}}" class="btn btn-app {{(Auth::user()->roles == 'Sells' ? 'nv':'')}}">
                        <i class="fa fa-bank"></i> Bank Book
                    </a>
                    <a href="{{url('reports')}}" class="btn btn-app {{(Auth::user()->roles == 'Sells' ? 'nv':'')}}">
                        <i class="fa fa-line-chart"></i> Reports
                    </a>

                    <a href="{{url('user')}}" class="btn btn-app {{(Auth::user()->roles != 'Admin' ? 'nv':'')}}">
                        <i class="fa fa-user"></i> User List
                    </a>

                </div><!-- /.box-body -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{money($sell)}}</h3>
                    <p>Today Sell</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-bag"></i>
                </div>
                <a href="{{url('sell/invoice')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{money($sell_due)}}</h3>
                    <p>Today Sell Due</p>
                </div>
                <div class="icon">
                    <i class="fa fa-bullhorn"></i>
                </div>
                <a href="{{url('sell/due')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{money($orders)}}</h3>
                    <p>Today Sell Order</p>
                </div>
                <div class="icon">
                    <i class="fa fa-inbox"></i>
                </div>
                <a href="{{url('sell/order')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3>{{money($expense)}}</h3>
                    <p>Today Expense</p>
                </div>
                <div class="icon">
                    <i class="fa fa-upload"></i>
                </div>
                <a href="{{url('expense')}}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-light-blue">
                <div class="inner">
                    <h3>{{money($purchase)}}</h3>
                    <p>Today Purchase</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="{{url('purchase/receipt')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{money($purchase_due)}}</h3>
                    <p>Today Purchase Due</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cloud"></i>
                </div>
                <a href="{{url('purchase/due')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{$products_warn}}</h3>
                    <p>Restock Products</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cubes"></i>
                </div>
                <a href="{{url('stock/product')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div><!-- ./col -->


<!-- ./col -->
    </div>

    <!--<div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-th-large"></i> Tiles Stock Cert</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
@endsection


@section('script')
    <!--<script src="{{asset('public/plugins/chartjs/Chart.min.js')}}"></script>-->


    <script type="text/javascript">
/*
        $(function () {
            var areaChartData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "Electronics",
                        fillColor: "rgba(210, 214, 222, 1)",
                        strokeColor: "rgba(210, 214, 222, 1)",
                        pointColor: "rgba(210, 214, 222, 1)",
                        pointStrokeColor: "#c1c7d1",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "Digital Goods",
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "rgba(60,141,188,1)",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(60,141,188,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            };


            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData = areaChartData;
            barChartData.datasets[1].fillColor = "#00a65a";
            barChartData.datasets[1].strokeColor = "#00a65a";
            barChartData.datasets[1].pointColor = "#00a65a";
            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);

        });
*/
    </script>
@endsection