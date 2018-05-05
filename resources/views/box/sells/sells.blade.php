@section('box')


    <div id="sellProducts" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add Product For Sells</h4>
                </div>
                <form action="{{action('sell\SellController@temp')}}" id="add_cart_formP" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="input-group">
                            <span class="input-group-addon">Select Tiles</span>
                            <select name="productID" class="form-control select_product" style="width: 100%;">
                                <option value="">Name &#9830; Brand &#9830; Category &#9830; (Stock)</option>
                                @foreach($products as $row)
                                    <option value="{{$row->productID}}" data-name="{{$row->name}}" data-brand="{{$row->ProductBrand['name']}}" data-category="{{$row->category['name']}}" data-stock="{{$row->stock}}" data-unit="{{$row->unit}}" data-sell="{{$row->defaultSellPrice}}" data-buy="{{$row->defaultBuyPrice}}">{{$row->name}} &#9830; {{$row->ProductBrand['name']}} &#9830;  {{$row->category['name']}} &#9830;  ({{$row->stock}})</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="stock_products">
                        </div><br>

                        <div class="row">
                            <div class="col-xs-6">
                                <table>
                                    <tr>
                                        <th>Name:&nbsp;</th>
                                        <td id="name"></td>
                                    </tr>
                                    <tr>
                                        <th>Brand:&nbsp;</th>
                                        <td id="brandP"></td>
                                    </tr>
                                    <tr>
                                        <th>Category:&nbsp;</th>
                                        <td id="categoryP"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-xs-6">
                                <table>
                                    <tr>
                                        <th>Stock:&nbsp;</th>
                                        <td id="stockP"></td>
                                    </tr>
                                    <tr>
                                        <th>Buy Price:&nbsp;</th>
                                        <td id="buy_priceP"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-red">Sell Price:&nbsp;</th>
                                        <td id="sell_priceP" class="text-red"></td>
                                    </tr>
                                </table>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Quantity</span>
                                    <input id="quantityP" name="quantity" data-main="0" class="form-control" placeholder="Quantity Pics" min="1" value="0" type="number" required>
                                </div>
                            </div>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Sell Price</span>
                            <input name="sellPrice" id="priceP" class="form-control" step="0.01" placeholder="Sell Price" value="0" min="0" type="number" required>
                            <input type="hidden" id="buyPriceP" name="buyPrice" value="0">
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Discount</span>
                            <input name="discount" id="discountPP" class="form-control" step="0.01" placeholder="Discount (%)" value="0" min="0" max="100" type="number" required>
                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add To Cart</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div id="ediCart" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit <span id="ediname"></span></h4>
                </div>
                <form id="ediCartForm" action="{{action('sell\SellController@edit')}}"  method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <input type="hidden" id="tempID" name="tempID">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon">Quantity</span>
                                    <input id="qtyEdi" name="quantity" data-main="0" class="form-control" placeholder="Quantity Pics" min="1" value="0" type="number" required>
                                </div>
                            </div>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Sell Price</span>
                            <input id="sellRate" name="sellPrice" class="form-control" step="0.01" placeholder="Sell Price" min="0" type="number" required>

                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Discount</span>
                            <input name="discount" id="discountPs" class="form-control" step="0.01" placeholder="Discount (%)" value="0" min="0" max="100" type="number" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>



    <div id="customerModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Customer</h4>
                </div>
                <form action="{{action('customer\CustomerController@save')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Customer Category</span>
                            <select name="customerCategoryID" class="form-control">
                                @foreach($category as $row)
                                    <option value="{{$row->customerCategoryID}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#categoryModal" title="Add new Category"><i class="fa fa-plus"></i></button>
                            </span>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Name</span>
                            <input name="name" class="form-control" placeholder="Customer Name" type="text" required>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Contact</span>
                            <input name="contact" class="form-control" placeholder="Customer Contact" type="text" required>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Company</span>
                            <input name="company" class="form-control" placeholder="Company Name" type="text">
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Email</span>
                            <input name="email" class="form-control" placeholder="Customer Email" type="email">
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Address</span>
                            <input name="address" class="form-control" placeholder="Customer Address" type="text">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    <div id="categoryModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Customer Category</h4>
                </div>
                <form action="{{action('customer\CategoryController@save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Category</span>
                            <input name="name" class="form-control" placeholder="Customer Category Name" type="text" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


@endsection