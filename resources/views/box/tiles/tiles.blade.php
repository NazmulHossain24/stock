@section('box')

    <div id="productModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Tiles</h4>
                </div>
                <form action="{{action('tiles\TilesController@save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">Model</span>
                                <input name="name" class="form-control" placeholder="Tiles Model" type="text" required>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon">Grade</span>
                                <select name="grade" class="form-control">
                                    <option value="N">N</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                </select>
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon">Default Sell Price</span>
                                <input name="defaultSellPrice" class="form-control" step="0.1" placeholder="Default Sell Price [Optional]" value="0" type="number" min="0">
                            </div><br>
                            <div class="input-group">
                                <span class="input-group-addon">Default Buy Price</span>
                                <input name="defaultBuyPrice" class="form-control" step="0.1" placeholder="Default Buy Price [Optional]" value="0" type="number" min="0">
                            </div><br>


                        </div>
                        <div class="col-md-6">

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
                                <span class="input-group-addon">Size</span>
                                <select name="productSizeID" class="form-control">
                                    @foreach($size as $row)
                                    <option value="{{$row->productSizeID}}">{{t_size($row->height, $row->width)}}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#sizeModal" title="Add new Size"><i class="fa fa-plus"></i></button>
                                </span>
                            </div>

                        </div>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Tiles</h4>
                </div>
                <form id="ediProductForm" action="{{action('tiles\TilesController@edit')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">Model</span>
                                    <input name="name" class="form-control" placeholder="Tiles Model" type="text" required>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Grade</span>
                                    <select name="grade" class="form-control">
                                        <option value="N">N</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                    </select>
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Default Sell Price</span>
                                    <input name="defaultSellPrice" class="form-control" step="0.1" placeholder="Default Sell Price [Optional]" value="0" type="number" min="0">
                                </div><br>
                                <div class="input-group">
                                    <span class="input-group-addon">Default Buy Price</span>
                                    <input name="defaultBuyPrice" class="form-control" step="0.1" placeholder="Default Buy Price [Optional]" value="0" type="number" min="0">
                                </div><br>


                            </div>
                            <div class="col-md-6">

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
                                    <span class="input-group-addon">Size</span>
                                    <select name="productSizeID" class="form-control">
                                        @foreach($size as $row)
                                            <option value="{{$row->productSizeID}}">{{t_size($row->height, $row->width)}}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#sizeModal" title="Add new Size"><i class="fa fa-plus"></i></button>
                                    </span>
                                </div>

                            </div>
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
                    <h4 class="modal-title">Add New Tiles Category</h4>
                </div>
                <form action="{{action('tiles\CategoryController@save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Category</span>
                            <input name="name" class="form-control" placeholder="Tiles Category Name" type="text" required>
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
                    <h4 class="modal-title">Add New Tiles Brand</h4>
                </div>
                <form action="{{action('tiles\BrandController@save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Brand</span>
                            <input name="name" class="form-control" placeholder="Tiles Brand Name" type="text" required>
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


    <div id="sizeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Tiles Size</h4>
                </div>
                <form action="{{action('tiles\SizeController@save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon">Width</span>
                                    <input name="width" class="form-control" placeholder="Width (ft)" min="0" type="number" required>
                                </div>
                            </div>
                            <div class="col-md-2 text-center text-bold">X</div>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <span class="input-group-addon">Height</span>
                                    <input name="height" class="form-control" placeholder="Height (ft)" min="0" type="number" required>
                                </div>
                            </div>
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