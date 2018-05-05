@section('box')

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


    <div id="customerEdiModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Customer</h4>
                </div>
                <form id="ediCustomerForm" action="{{action('customer\CustomerController@edit')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id">
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