<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice Confirm</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{asset('public/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/css/font-awesome.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/dist/css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/dist/css/skins/all-skins.min.css')}}">

<!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->

</head>

<body class="hold-transition skin-green sidebar-mini">

<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
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
                <div class="col-sm-6 invoice-col">
                    From
                    <address>
                        <strong>{{config('naz.company')}}</strong><br>
                        {{config('naz.address')}}<br>
                        Phone: {{config('naz.phone')}}<br>
                        Email: {{config('naz.email')}}
                    </address>
                </div><!-- /.col -->
                <div class="col-sm-6 invoice-col">
                    To
                    <address>
                        <strong>{{$customer['name']}}</strong><br>
                        Address: <span>{{$customer['address']}}</span><br>
                        Phone: <span>{{$customer['contact']}}</span><br>
                        Email: <span>{{$customer['email']}}</span>
                    </address>
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
                                <td>{{money($row->sellPrice)}}</td>
                                <td class="text-right">{{money($row->quantity * $row->sellPrice)}}</td>
                            </tr>
                            <?php
                            $totalAmount += ($row->quantity * $row->sellPrice);
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
                            <th>Discount:</th>
                            <td>{{money($discount)}}</td>
                        </tr>
                        <tr>
                            <th>Grand Total:</th>
                            <td>{{money($totalAmount - $discount)}}</td>
                        </tr>
                        <tr>
                            <th>Paid amount</th>
                            <td>{{money($paidAmount)}}</td>
                        </tr>
                        <tr>
                            <th>Due Amount:</th>
                            <td>{{money($totalAmount - ($paidAmount + $discount))}}</td>
                        </tr>

                    </table>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <div class="col-xs-12"><hr></div>
        </div>
        <form action="{{action('sell\SellController@new_sell')}}" method="post" enctype="multipart/form-data" autocomplete="off">
            {!! csrf_field() !!}
            <input name="customerID" type="hidden" value="{{$customer['customerID']}}">
            <input name="checkOutDate" type="hidden" value="{{$checkoutdate}}">
            <input name="paidAmount" type="hidden" value="{{$paidAmount}}">
            <input name="totalAmount" type="hidden" value="{{$totalAmount}}">
            <input name="discount" type="hidden" value="{{$discount}}">
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-success pull-right" name="submitbutton" value="confirm" type="submit"><i class="fa fa-paper-plane"></i> Confirm Checkout</button>
                    <button class="btn btn-primary pull-right" name="submitbutton" value="order" type="submit" style="margin-right: 10px;"><i class="fa fa-database"></i> Make as Order</button>
                    <a href="{{url('sell')}}" class="btn btn-danger" style="margin-right: 10px;"><i class="fa  fa-chevron-left"></i> Back to Selling</a>
                </div>
            </div>
        </form>
    </section><!-- /.content -->
</div><!-- ./wrapper -->


<script src="{{asset('public/plugins/jQuery/jquery-3.2.1.min.js')}}"></script>

</body>
</html>
