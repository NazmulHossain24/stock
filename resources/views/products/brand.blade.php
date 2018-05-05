@extends('layouts.master')
@extends('box.product.brand')

@section('title')
    Product Brand
@endsection

@section('page')
    Product Brand
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 btn_mod">
            <button class="btn btn-social btn-primary btn-flat" data-toggle="modal" data-target="#brandModal">
                <i class="fa fa-plus"></i>
                Add New Product Brand
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Product Brand name</th>
                        <th class="text-center">Edit</th>
                        <th class="text-right">Del</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{$row->productBrandID}}</td>
                            <td>{{$row->name}}</td>
                            <td class="text-center"><button data-id="{{$row->productBrandID}}" data-name="{{$row->name}}" class="btn btn-xs btn-flat btn-success ediModal"  data-toggle="modal" data-target="#brandEdiModal">Edit</button></td>
                            <td class="text-right"><a href="{{url('tiles/brand/del', [$row->productBrandID])}}" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a></td>
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
                    { "orderable": false, "targets": [2,3] }//For Column Order
                ]
            });
        });

        $(function () {
            $('.ediModal').click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#ediBrandForm [name=id]').val(id);
                $('#ediBrandForm [name=name]').val(name);

            });
        });



    </script>

@endsection
