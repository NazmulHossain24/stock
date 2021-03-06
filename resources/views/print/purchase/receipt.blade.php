<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('naz.company')}} | Sell invoice</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{asset('public/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/css/font-awesome.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/dist/css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/dist/css/skins/all-skins.min.css')}}">

    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->

</head>

<body onload="window.print();" class="hold-transition skin-green sidebar-mini">

<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <div class="row hidden-print">
            <div class="col-xs-12">
                <button class="btn btn-lg btn-success pull-right"  onclick="window.print();" type="button"><i class="fa fa-print"></i> Print</button>
                <a href="{{url('purchase')}}" class="btn btn-lg btn-danger" style="margin-right: 10px;"><i class="fa  fa-chevron-left"></i> Back to Purchase</a>
            </div>
        </div>
        <div class="row hidden-print">
            <div class="col-xs-12"><hr></div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> {{config('naz.company')}}
                    <small class="pull-right">Date: <span>{{$checkoutdate}}</span></small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-5 invoice-col">
                From
                <address>
                    <strong>{{$supplier['name']}}</strong><br>
                    Address: <span>{{$supplier['address']}}</span><br>
                    Phone: <span>{{$supplier['contact']}}</span><br>
                    Email: <span>{{$supplier['email']}}</span>
                </address>
            </div><!-- /.col -->
            <div class="col-sm-5 invoice-col">
                To
                <address>
                    <strong>{{config('naz.company')}}</strong><br>
                    {{config('naz.address')}}<br>
                    Phone: {{config('naz.phone')}}<br>
                    Email: {{config('naz.email')}}
                </address>
            </div><!-- /.col -->
            <div class="col-sm-2 invoice-col">
                <strong>Receipt Number <br> #{{invoice_n($receiptID)}}</strong>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    $totalAmount = 0;

                    ?>
                    @foreach($table as $row)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$row->product['name']}}</td>

                            @if($row->product['type'] == 'Tiles')
                            <td>{{$row->product['description']}}</td>
                            <td>{{$row->quantity}} pcs/{{number_format((($row->quantity * $row->product->p_size['height'] * $row->product->p_size['width'])/144),2)}} {{$row->product['unit']}}</td>
                            @else
                                <td>{{$row->product['description']}}</td>
                                <td>{{$row->quantity}} {{$row->product['unit']}}</td>
                            @endif
                            <td>{{money($row->buyPrice)}}</td>
                            <td class="text-right">{{money($row->quantity * $row->buyPrice)}}</td>
                        </tr>
                        <?php
                        $totalAmount += ($row->quantity * $row->buyPrice);
                        $i++;
                        ?>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="5" class="text-right">Total</th>
                        <th class="text-right" id="total_amount">{{money($totalAmount)}}</th>
                    </tr>
                    </tfoot>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Payment History</p>
                @if($paidAmount > 0)
                    <table class="table table-condensed">
                        <tr>
                            <td>{{date('d/m/Y')}}</td>
                            <td>{{money($paidAmount)}}</td>
                        </tr>
                    </table>
                @endif
            </div><!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Check out date {{$checkoutdate}}</p>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Total Amount:</th>
                            <td>{{money($totalAmount)}}</td>
                        </tr>
                        <tr>
                            <th>Paid amount</th>
                            <td>{{money($paidAmount)}}</td>
                        </tr>
                        <tr>
                            <th>Due Amount:</th>
                            <td>{{money($totalAmount - $paidAmount)}}</td>
                        </tr>

                    </table>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->
</div><!-- ./wrapper -->


<script src="{{asset('public/plugins/jQuery/jquery-3.2.1.min.js')}}"></script>

</body>
</html>
