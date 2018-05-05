@section('box')

    <div id="expenseModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Expense Category</h4>
                </div>
                <form action="{{action('expense\ExpenseController@new_expense')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="input-group">
                            <span class="input-group-addon">Category</span>
                            <select name="expenseName" class="form-control">
                                @foreach($category as $row)
                                    <option value="{{$row->name}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <span class="input-group-btn">
                                    <button class="btn btn-info btn-flat" type="button" data-toggle="modal" data-target="#categoryModal" title="Add New Expense Category"><i class="fa fa-plus"></i></button>
                                </span>
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon">Amount of Expense</span>
                            <input name="amount" class="form-control" step="0.01" placeholder="Amount of Expense" type="number" min="0" required>
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
                    <h4 class="modal-title">Add New Expense Category</h4>
                </div>
                <form action="{{action('expense\CategoryController@save')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <div class="modal-body">

                        <div class="input-group">
                            <span class="input-group-addon">Category</span>
                            <input name="name" class="form-control" placeholder="Expense Category Name" type="text" required>
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