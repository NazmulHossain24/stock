@section('box')

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


    <div id="sizeEdiModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Tiles Size</h4>
                </div>
                <form id="ediSizeForm" action="{{action('tiles\SizeController@edit')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id">
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