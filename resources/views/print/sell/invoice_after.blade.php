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
                <a href="{{URL::previous()}}" class="btn btn-lg btn-danger" style="margin-right: 10px;"><i class="fa  fa-chevron-left"></i> Cancel and Back</a>
            </div>
        </div>
        <div class="row hidden-print">
            <div class="col-xs-12"><hr></div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> {{config('naz.company')}}
                    <small class="pull-right">Date: <span>{{pub_date($invoice->checkOutDate)}}</span></small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-5 invoice-col">
                From
                <address>
                    <strong>{{config('naz.company')}}</strong><br>
                    {{config('naz.address')}}<br>
                    Phone: {{config('naz.phone')}}<br>
                    Email: {{config('naz.email')}}
                </address>
            </div><!-- /.col -->
            <div class="col-sm-5 invoice-col">
                To
                <address>
                    <strong>{{$customer->name}}</strong><br>
                    Address: <span>{{$customer->address}}</span><br>
                    Phone: <span>{{$customer->contact}}</span><br>
                    Email: <span>{{$customer->email}}</span>
                </address>
            </div><!-- /.col -->
            <div class="col-sm-2 invoice-col">
                <strong>Invoice Number <br> #{{invoice_n($invoice->invoiceID)}}</strong>
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
                        <th>Discount</th>
                        <th>D.Rate</th>
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
                            <td>{{money($row->mainPrice)}}</td>
                            <td>{{$row->discount}}%</td>
                            <td>{{money($row->unitPrice)}}</td>
                            <td class="text-right">{{money($row->quantity * $row->unitPrice)}}</td>
                        </tr>
                        <?php
                        $totalAmount += ($row->quantity * $row->unitPrice);
                        $i++;
                        ?>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="7" class="text-right">Total</th>
                        <th class="text-right" id="total_amount">{{money($totalAmount)}}</th>
                    </tr>
                    </tfoot>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <?php
        $returnTotal = 0;
        ?>
        @if(count($return_product) > 0)

            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <p class="lead">Return Products</p>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Rate</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($return_product as $row)
                            <tr>
                                <td>{{pub_date($row->created_at)}}</td>
                                <td>{{$row->product['name']}}</td>

                                @if($row->product['type'] == 'Tiles')
                                    <td>{{$row->product->ProductBrand['name']}}, [{{t_size($row->product->p_size['height'],$row->product->p_size['width'])}}]</td>
                                    <td>{{$row->quantity}} pcs/{{number_format((($row->quantity * $row->product->p_size['height'] * $row->product->p_size['width'])/144),2)}} {{$row->product['unit']}}</td>
                                @else
                                    <td>{{$row->product->ProductBrand['name']}}</td>
                                    <td>{{$row->quantity}} {{$row->product['unit']}}</td>
                                @endif
                                <td>{{money($row->unitPrice)}}</td>
                                <td class="text-right">{{money($row->quantity * $row->unitPrice)}}</td>
                            </tr>
                            <?php
                            $returnTotal += ($row->quantity * $row->unitPrice);
                            ?>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="5" class="text-right">Total</th>
                            <th class="text-right" id="total_amount">{{money($returnTotal)}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.col -->
            </div><!-- /.row -->

        @endif

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Payment History</p>
                <?php $paidAmount = 0; ?>
                @if(count($transactions) > 0)
                    <table class="table table-condensed">
                        @foreach($transactions as $row)
                        <tr>
                            <td>{{pub_date($row->created_at)}}</td>
                            @if($row->amount > 0)
                            <td>Payment</td>
                                @else
                             <td>Payment Return</td>
                            @endif
                            <td>{{money_abs($row->amount)}}</td>
                        </tr>
                        <?php $paidAmount += $row->amount; ?>
                        @endforeach
                    </table>
                @endif
            </div><!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Check out date {{pub_date($invoice->checkOutDate)}}</p>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Total Amount:</th>
                            <td>{{money($totalAmount - $returnTotal)}}</td>
                        </tr>
                        <tr>
                            <th>Discount:</th>
                            <td>{{money($invoice->discount)}}</td>
                        </tr>
                        <tr>
                            <th>Grand Total:</th>
                            <td>{{money($totalAmount - ($returnTotal + $invoice->discount))}}</td>
                        </tr>
                        <tr>
                            <th>Paid amount</th>
                            <td>{{money($paidAmount)}}</td>
                        </tr>
                        <tr>
                            <th>Due Amount:</th>
                            <td>{{money($totalAmount - ($returnTotal + $paidAmount + $invoice->discount))}}</td>
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
