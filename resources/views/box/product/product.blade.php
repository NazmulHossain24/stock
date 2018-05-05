@section('box')

    <div id="productModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Product</h4>
                </div>
                <form action="{{action('product\ProductController@save')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Product Type</span>
                            <select name="type" class="form-control">
                                <option value="General">General</option>
                                <option value="Wire">Wire</option>
                            </select>
                        </div><br>

                            <div class="input-group">
                                <span class="input-group-addon">Name</span>
                                <input name="name" class="form-control" placeholder="Product Name" type="text" required>
                            </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Unit</span>
                            <select name="unit" class="form-control">
                                <option value="pcs">Pcs (each)</option>
                                <option value="ft">Feet (ft)</option>
				<option value="coil">Coil</option>
				<option value="in">Inches</option>
				<option value="m">Meter</option>
				<option value="mm">Millimeter</option>
				<option value="cm">Centimeter</option>
				<option value="yd">Yards</option>
				<option value="kg">Kilograms</option>
				<option value="g">Grams</option>
                            </select>
                        </div><br>

                            <div class="input-group">
                                <span class="input-group-addon">Category</span>
                                <select name="productCategoryID" class="form-control">
                                    @foreach($category as $row)
                                        <option value="{{$row->productCategoryID}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#categoryModal" title="Add new Category"><i class="fa fa-plus"></i></button>
                                </span>
                            </div><br>

                            <div class="input-group">
                                <span class="input-group-addon">Brand</span>
                                <select name="productBrandID" class="form-control">
                                    @foreach($brand as $row)
                                        <option value="{{$row->productBrandID}}">{{$row->name}}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#brandModal" title="Add new Brand"><i class="fa fa-plus"></i></button>
                                </span>
                            </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Description</span>
                            <input name="description" class="form-control" placeholder="Product Description [Optional]" type="text">
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Default Sell Price</span>
                            <input name="defaultSellPrice" class="form-control" step="0.01" placeholder="Default Sell Price [Optional]" value="0" type="number" min="0">
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Default Buy Price</span>
                            <input name="defaultBuyPrice" class="form-control" step="0.01" placeholder="Default Buy Price [Optional]" value="0" type="number" min="0">
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


    <div id="productEdiModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Product</h4>
                </div>
                <form id="ediProductForm" action="{{action('product\ProductController@edit')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id">
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Product Type</span>
                            <select name="type" class="form-control">
                                <option value="General">General</option>
                                <option value="Wire">Wire</option>
                            </select>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Name</span>
                            <input name="name" class="form-control" placeholder="Product Name" type="text" required>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Unit</span>
                            <select name="unit" class="form-control">
                                <option value="pcs">Pcs (each)</option>
                                <option value="ft">Feet (ft)</option>
				<option value="coil">Coil</option>
				<option value="in">Inches</option>
				<option value="m">Meter</option>
				<option value="mm">Millimeter</option>
				<option value="cm">Centimeter</option>
				<option value="yd">Yards</option>
				<option value="kg">Kilograms</option>
				<option value="g">Grams</option>
                            </select>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Category</span>
                            <select name="productCategoryID" class="form-control">
                                @foreach($category as $row)
                                    <option value="{{$row->productCategoryID}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#categoryModal" title="Add new Category"><i class="fa fa-plus"></i></button>
                            </span>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Brand</span>
                            <select name="productBrandID" class="form-control">
                                @foreach($brand as $row)
                                    <option value="{{$row->productBrandID}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#brandModal" title="Add new Brand"><i class="fa fa-plus"></i></button>
                            </span>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Description</span>
                            <input name="description" class="form-control" placeholder="Product Description [Optional]" type="text">
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Default Sell Price</span>
                            <input name="defaultSellPrice" class="form-control" step="0.01" placeholder="Default Sell Price [Optional]" value="0" type="number" min="0">
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Default Buy Price</span>
                            <input name="defaultBuyPrice" class="form-control" step="0.01" placeholder="Default Buy Price [Optional]" value="0" type="number" min="0">
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
                    <h4 class="modal-title">Add New Product Category</h4>
                </div>
                <form action="{{action('product\CategoryController@save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Category</span>
                            <input name="name" class="form-control" placeholder="Product Category Name" type="text" required>
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

    <div id="brandModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Product Brand</h4>
                </div>
                <form action="{{action('product\BrandController@save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Brand</span>
                            <input name="name" class="form-control" placeholder="Product Brand Name" type="text" required>
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