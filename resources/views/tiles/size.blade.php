@extends('layouts.master')
@extends('box.tiles.size')

@section('title')
    Tiles Size
@endsection

@section('page')
    Tiles Size
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 btn_mod">
            <button class="btn btn-social btn-primary btn-flat" data-toggle="modal" data-target="#sizeModal">
                <i class="fa fa-plus"></i>
                Add New Tiles Size
            </button>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <div class="box box-success">
                <table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>Size</th>
                        <th>Width</th>
                        <th>Height</th>
                        <th class="text-center">Edit</th>
                        <th class="text-right">Del</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{t_size($row->height, $row->width)}}</td>
                            <td>{{$row->width}}</td>
                            <td>{{$row->height}}</td>
                            <td class="text-center"><button data-id="{{$row->productSizeID}}" data-height="{{$row->height}}" data-width="{{$row->width}}" class="btn btn-xs btn-flat btn-success ediModal"  data-toggle="modal" data-target="#sizeEdiModal">Edit</button></td>
                            <td class="text-right"><a href="{{url('tiles/size/del', [$row->productSizeID])}}" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        $(function () {
            $('#dataTable').DataTable({
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    { "orderable": false, "targets": [3,4] }//For Column Order
                ]
            });
        });

        $(function () {
            $('.ediModal').click(function () {
                var id = $(this).data('id');
                var height = $(this).data('height');
                var width = $(this).data('width');

                $('#ediSizeForm [name=id]').val(id);
                $('#ediSizeForm [name=height]').val(height);
                $('#ediSizeForm [name=width]').val(width);

            });
        });



    </script>



@endsection
