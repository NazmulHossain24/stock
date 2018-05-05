@extends('layouts.master')
@extends('box.sells.sells')

@section('title')
    New Sell
@endsection

@section('page')
    New Sell
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">

                <section class="invoice">
                    <form action="{{action('sell\SellController@confirm_sell')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    <i class="fa fa-globe"></i> {{config('naz.company')}}
                                    <small class="pull-right">Date: <span id="date_invoice"></span></small>
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
                                    <strong id="customer_name"></strong><br>
                                    Address: <span id="customer_address"></span><br>
                                    Phone: <span id="customer_phone"></span><br>
                                    Email: <span id="customer_email"></span>
                                </address>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <!-- Table row -->
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
                                        <th class="text-center">Edit</th>
                                        <th class="text-right">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody id="show_temp_list"></tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="7" class="text-right">Total</th>
                                            <th class="text-right" id="total_amount">{{money(0)}}</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <input type="hidden" id="total_amount_hide">
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <div class="row">

                            <div class="col-xs-4 col-xs-offset-4">
                                <button type="button" class="btn btn-social btn-lg btn-info btn-flat btn-block" data-toggle="modal" data-target="#sellProducts">
                                    <i class="fa fa-cubes"></i>
                                    Add Product For Sell
                                </button>
                            </div>
                            <div class="col-xs-2"></div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6"></div>
                            <div class="col-xs-3"><br><p class="lead text-blue">Discount: <span id="discount_show">00</span></p></div>
                            <div class="col-xs-3"><br><p class="lead text-danger">Remaining Amount: <span id="remain">00</span></p></div>
                        </div>


                        <div class="row">
                            <div class="col-xs-12"><hr></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">

                                <div class="input-group">
                                    <span class="input-group-addon">Select Customer</span>

                                    <select name="customerID" class="form-control select_two" style="width: 100%" required>
                                        <option value="">Invoice to..</option>
                                        @foreach($customers as $row)
                                            <option value="{{$row->customerID}}" data-name="{{$row->name}}"  data-address="{{$row->address}}" data-contact="{{$row->contact}}" data-email="{{$row->email}}">{{$row->name}} [{{$row->contact}}]</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#customerModal" title="Add new customer"><i class="fa fa-plus"></i></button>
                                    </span>
                                </div>

                            </div><!-- /.col -->

                            <div class="col-xs-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Invoice Date</span>
                                    <input name="invoiceDate" id="invoice_date" class="form-control" placeholder="Invoice Date" type="text" required>
                                </div>
                            </div><!-- /.col -->

                            <div class="col-xs-3">
                                <div class="input-group">
                                    <span class="input-group-addon">Discount</span>
                                    <input name="discount" id="discount" class="form-control" placeholder="Discount Amount" step="0.1" type="number" min="0" value="0" required>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Paid Amount</span>
                                    <input name="amount" id="paid_amount" class="form-control" placeholder="Paid Amount" step="0.1" type="number" min="0" value="0" required>
                                </div>
                            </div><!-- /.col -->

                        </div>

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <hr>
                                <!--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
                                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                                <!--<button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
                            </div>
                        </div>
                    </form>
                </section><!-- /.content -->

            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('public/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/plugins/datepicker/datepicker3.css')}}">
@endsection

@section('script')
    <script src="{{asset('public/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('public/plugins/datepicker/bootstrap-datepicker.js')}}"></script>

    <script type="text/javascript">

        $(function () {
            show_temp_list();

            $('#invoice_date').datepicker({
                defaultDate: 'now',
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                endDate: '0',
            }).datepicker("setDate", "0");

            var date_invoice = $('#invoice_date').val();
            $('#date_invoice').html(date_invoice);

            $('#invoice_date').change(function () {
                var date_invoice = $(this).val();
                $('#date_invoice').html(date_invoice);
            });

        });

        $(function () {

            $(".select_two").select2();

            $('.select_two').change(function () {
                var values = $(this).val();
                var name = $(this).select2().find(":selected").data("name");
                var address = $(this).select2().find(":selected").data("address");
                var email = $(this).select2().find(":selected").data("email");
                var contact = $(this).select2().find(":selected").data("contact");

                if(values != ''){
                    $('#customer_name').html(name);
                    $('#customer_address').html(address);
                    $('#customer_phone').html(contact);
                    $('#customer_email').html(email);
                }else{
                    $('#customer_name').html('');
                    $('#customer_address').html('');
                    $('#customer_phone').html('');
                    $('#customer_email').html('');
                }
            });

        });

        $(function () {
            $(".select_tiles").select2();

            $('.select_tiles').change(function () {
                var values = $(this).val();
                var model = $(this).select2().find(":selected").data("model");
                var brand = $(this).select2().find(":selected").data("brand");
                var grade = $(this).select2().find(":selected").data("grade");
                var category = $(this).select2().find(":selected").data("category");
                var size = $(this).select2().find(":selected").data("size");
                var stock = $(this).select2().find(":selected").data("stock");
                var unit = $(this).select2().find(":selected").data("unit");
                var sell = $(this).select2().find(":selected").data("sell");
                var buy = $(this).select2().find(":selected").data("buy");
                var heights = $(this).select2().find(":selected").data("height");
                var widths = $(this).select2().find(":selected").data("width");

                if(values != ''){
                    $('#model').html(model);
                    $('#brand').html(brand);
                    $('#category').html(category);
                    $('#grade').html(grade);
                    $('#size').html(size);
                    $('#stock').html(stock +' pcs');
                    $('#buy_price').html(buy+" {{config('naz.money')}}");
                    $('#sell_price').html(sell+" {{config('naz.money')}}");

                    $('#size_height').val(heights);
                    $('#size_width').val(widths);
                    $('#price').val(sell);
                    $('#stock_tiles').val(stock);
                    $('#buyPrice').val(buy);
                }else{
                    $('#model').html('');
                    $('#brand').html('');
                    $('#category').html('');
                    $('#grade').html('');
                    $('#size').html('');
                    $('#stock').html('');
                    $('#buy_price').html('');
                    $('#sell_price').html('');
                    $('#size_height').val(0);
                    $('#size_width').val(0);
                    $('#price').val(0);
                    $('#stock_tiles').val(0);
                    $('#buyPrice').val(0);
                }

                converstion();
            });

        });

        function converstion() {

            /*$('#feets').change(function () {
                var heights = $('#size_height').val();
                var widths = $('#size_width').val();
                var feets = $(this).val();
                var results = ((Number(heights) * Number(widths)) / 144) * Number(feets) ;
                $('#quantity').val(Math.ceil(results));
            });*/


            $('#quantity').change(function () {
                var heights = $('#size_height').val();
                var widths = $('#size_width').val();
                var quantity = $(this).val();
                var results = Number(heights) * Number(widths) * Number(quantity) / 144;

                $('#feets').val(results.toFixed(2));

            });

            var heights = $('#size_height').val();
            var widths = $('#size_width').val();
            var quantity = $('#quantity').val();
            var results = Number(heights) * Number(widths) * Number(quantity) / 144;
            $('#feets').val(results.toFixed(2));
        }


        $(function () {
            $('#add_cart_form').on('submit', function (e) {
                e.preventDefault();
                var submiturl = $(this).attr('action');
                var methods = $(this).attr('method');
                var quantity = $('#quantity').val();
                var stock_tiles = $('#stock_tiles').val();

                if(stock_tiles >= quantity){
                    if(quantity > 0){
                        $.ajax({
                            url: submiturl,
                            type: methods,
                            data: $(this).serialize(),
                            success:function(result){
                                $('#add_cart_form')[0].reset();
                                show_temp_list();
                                $('#sellTiles').modal('hide');

                            },
                            error: function (jXHR, textStatus, errorThrown) {html("")}
                        });
                    }else{
                        alert('Quantity 0 has not acceptable.');
                    }

                }else{
                    var r = confirm("Insufficient product in stock.!!");
                    if (r == true) {
                        if(quantity > 0){
                            $.ajax({
                                url: submiturl,
                                type: methods,
                                data: $(this).serialize(),
                                success:function(result){
                                    $('#add_cart_form')[0].reset();
                                    show_temp_list();
                                    $('#sellTiles').modal('hide');

                                },
                                error: function (jXHR, textStatus, errorThrown) {html("")}
                            });
                        }else{
                            alert('Quantity 0 has not acceptable.');
                        }

                    } else {

                    }
                }



            });
        });




        /*------------------------ Product Part -------------------------*/

        $(function () {
            $(".select_product").select2();

            $('.select_product').change(function () {
                var values = $(this).val();
                var name = $(this).select2().find(":selected").data("name");
                var brand = $(this).select2().find(":selected").data("brand");
                var category = $(this).select2().find(":selected").data("category");
                var stock = $(this).select2().find(":selected").data("stock");
                var unit = $(this).select2().find(":selected").data("unit");
                var sell = $(this).select2().find(":selected").data("sell");
                var buy = $(this).select2().find(":selected").data("buy");

                if(values != ''){
                    $('#name').html(name);
                    $('#brandP').html(brand);
                    $('#categoryP').html(category);
                    $('#stockP').html(stock +' '+unit);
                    $('#buy_priceP').html(buy+" {{config('naz.money')}}");
                    $('#sell_priceP').html(sell+" {{config('naz.money')}}");

                    $('#priceP').val(sell);
                    $('#stock_products').val(stock);
                    $('#buyPriceP').val(buy);
                }else{
                    $('#name').html('');
                    $('#brandP').html('');
                    $('#categoryP').html('');
                    $('#stockP').html('');
                    $('#buy_priceP').html('');
                    $('#sell_priceP').html('');
                    $('#stock_products').val(0);
                    $('#buyPriceP').val(0);
                }
            });
        });

        $(function () {
            $('#add_cart_formP').on('submit', function (e) {
                e.preventDefault();
                var submiturl = $(this).attr('action');
                var methods = $(this).attr('method');
                var quantity = $('#quantityP').val();
                var stock_product = $('#stock_products').val();

                if(stock_product >= quantity){
                    if(quantity > 0){
                        $.ajax({
                            url: submiturl,
                            type: methods,
                            data: $(this).serialize(),
                            success:function(result){
                                $('#add_cart_formP')[0].reset();
                                show_temp_list();
                                $('#sellProducts').modal('hide');

                            },
                            error: function (jXHR, textStatus, errorThrown) {html("")}
                        });
                    }else{
                        alert('Quantity 0 has not acceptable.');
                    }

                }else{
                    var r = confirm("Insufficient product in stock.!!");
                    if (r == true) {
                        if(quantity > 0){
                            $.ajax({
                                url: submiturl,
                                type: methods,
                                data: $(this).serialize(),
                                success:function(result){
                                    $('#add_cart_formP')[0].reset();
                                    show_temp_list();
                                    $('#sellProducts').modal('hide');

                                },
                                error: function (jXHR, textStatus, errorThrown) {html("")}
                            });
                        }else{
                            alert('Quantity 0 has not acceptable.');
                        }

                    } else {

                    }
                }



            });
        });

        $(function () {
            $('#ediCartForm').on('submit',function (e) {
                e.preventDefault();
                var submiturl = $(this).attr('action');
                var methods = $(this).attr('method');
                $.ajax({
                    url: submiturl,
                    type: methods,
                    data: $(this).serialize(),
                    success:function(result){
                        if(result == 0){
                            show_temp_list();
                            $('#ediCartForm')[0].reset();
                            $('#ediCart').modal('hide');
                        }else{
                            alert('Product Not Update. Try Again');
                        }
                    },
                    error: function (jXHR, textStatus, errorThrown) {html("")}
                });
            });
        });

        function show_temp_list() {
            var table_value = '';
            var i = 1;
            $.ajax({
                url: "{{action('sell\SellController@temp_list')}}",
                type: 'get',
                dataType: 'json',
                success:function(result){
                    $.each( result.lists, function( index, value ){
                        table_value += '<tr>'
                                +'<td>'+i+'</td>'
                                +'<td>'+result.lists[index].name+'</td>'
                                +'<td>'+result.lists[index].description+'</td>'
                                +'<td>'+result.lists[index].qty+'</td>'
                                +'<td>'+result.lists[index].mainPrice2+'</td>'
                                +'<td>'+result.lists[index].discount+'%</td>'
                                +'<td>'+result.lists[index].sell_price+'.00</td>'
                                +'<td class="text-right">'+result.lists[index].price+'</td>'
                                +'<td class="text-center"><button type="button" class="btn btn-xs btn-flat btn-success ediCarts" data-discount="'+result.lists[index].discount+'" data-name="'+result.lists[index].name+'" data-id="'+result.lists[index].id+'" data-quantity="'+result.lists[index].quantity+'" data-rate="'+result.lists[index].mainPrice+'" >Edit</button></td>'
                                +'<td class="text-right"><a class="close delete_temp" href="{{url('sell/del/')}}/'+result.lists[index].id+'" aria-label="Close"><span aria-hidden="true">×</span></a></td>'
                              +'</tr>';
                        i++;
                    });

                    $('#show_temp_list').html(table_value);
                    $('#total_amount').html(result.totalAmount2);
                    $('#total_amount_hide').val(result.totalAmount);
                    $('#remain').html(result.totalAmount);
                    $('#paid_amount').attr('max', result.totalAmount);
                    $('#discount').attr('max', result.totalAmount);

                    edi_cart_box();
                    paid_amount();
                },
                error: function (jXHR, textStatus, errorThrown) {html("")}
            });
        }

        function edi_cart_box(){
            $('.ediCarts').click(function () {

                var id = $(this).data('id');
                var name = $(this).data('name');
                var quantity = $(this).data('quantity');
                var rate = $(this).data('rate');
                var discount = $(this).data('discount');

                $('#ediname').html(name);
                $('#qtyEdi').val(quantity);
                $('#sellRate').val(rate);
                $('#tempID').val(id);
                $('#discountPs').val(discount);

                $('#ediCart').modal('show');
            });
        }

        function paid_amount() {
            $('#discount').bind('change keydown keyup keypress', function () {
                var discount = $(this).val();
                var amount = $('#total_amount_hide').val();
                var paidAmount = $('#paid_amount').val();
                var remain = Number(amount) - (Number(discount) + Number(paidAmount));
                $('#remain').html(remain);
                $('#discount_show').html(discount);
            });


            $('#paid_amount').bind('change keydown keyup keypress', function () {
                var paidAmount = $(this).val();
                var amount = $('#total_amount_hide').val();
                var discount = $('#discount').val();
                var remain = Number(amount) - (Number(discount) + Number(paidAmount));
                $('#remain').html(remain);
            });
        }

    </script>


@endsection
