@section('box')

    <div id="rolesModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Change User Roles</h4>
                </div>
                <form action="{{action('user\UserController@changes')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <input type="hidden" id="userID" name="id">
                    <div class="modal-body">
                        <p class="lead text-success" id="user"></p>
                        <hr>

                        <div class="input-group">
                            <span class="input-group-addon">User Roles</span>
                            <select class="form-control" id="roles" name="roles">
                                <option value="Admin">Admin</option>
                                <option value="Accountant">Accountant</option>
                                <option value="Sells">Sells</option>
                            </select>
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