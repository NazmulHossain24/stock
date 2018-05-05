@section('box')

    <div id="supplierModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Supplier</h4>
                </div>
                <form action="{{action('supplier\SupplierController@save')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Supplier Category</span>
                            <select name="supplierCategoryID" class="form-control">
                                @foreach($category as $row)
                                    <option value="{{$row->supplierCategoryID}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#categoryModal" title="Add new Category"><i class="fa fa-plus"></i></button>
                            </span>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Name</span>
                            <input name="name" class="form-control" placeholder="Supplier Name" type="text" required>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Contact</span>
                            <input name="contact" class="form-control" placeholder="Supplier Contact" type="text" required>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Company</span>
                            <input name="company" class="form-control" placeholder="Company Name" type="text">
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Email</span>
                            <input name="email" class="form-control" placeholder="Supplier Email" type="email">
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Address</span>
                            <input name="address" class="form-control" placeholder="Supplier Address" type="text">
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


    <div id="supplierEdiModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Supplier</h4>
                </div>
                <form id="ediSupplierForm" action="{{action('supplier\SupplierController@edit')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id">
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Supplier Category</span>
                            <select name="supplierCategoryID" class="form-control">
                                @foreach($category as $row)
                                    <option value="{{$row->supplierCategoryID}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#categoryModal" title="Add new Category"><i class="fa fa-plus"></i></button>
                            </span>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Name</span>
                            <input name="name" class="form-control" placeholder="Supplier Name" type="text" required>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Contact</span>
                            <input name="contact" class="form-control" placeholder="Supplier Contact" type="text" required>
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Company</span>
                            <input name="company" class="form-control" placeholder="Supplier Name" type="text">
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Email</span>
                            <input name="email" class="form-control" placeholder="Supplier Email" type="email">
                        </div><br>

                        <div class="input-group">
                            <span class="input-group-addon">Address</span>
                            <input name="address" class="form-control" placeholder="Supplier Address" type="text">
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
                    <h4 class="modal-title">Add New Supplier Category</h4>
                </div>
                <form action="{{action('supplier\CategoryController@save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Category</span>
                            <input name="name" class="form-control" placeholder="Supplier Category Name" type="text" required>
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