@extends('layouts.master')
@extends('box.product.product')

@section('title')
    Products List
@endsection

@section('page')
    Products List
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 btn_mod">
            <button class="btn btn-social btn-primary btn-flat" data-toggle="modal" data-target="#productModal">
                <i class="fa fa-plus"></i>
                Add New Product
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Type</th>
                        <th>Brand</th>
                        <th>Description</th>
                        <th>Sell</th>
                        <th>Buy</th>
                        <th>Unit</th>
                        <th class="text-center">Edit</th>
                        <th class="text-right">Del</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{$row->productID}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->category['name']}}</td>
                            <td>{{$row->type}}</td>
                            <td>{{$row->ProductBrand['name']}}</td>
                            <td>{{$row->description}}</td>
                            <td>{{money($row->defaultSellPrice)}}</td>
                            <td>{{money($row->defaultBuyPrice)}}</td>
                            <td>{{$row->unit}}</td>
                            <td class="text-center"><button data-id="{{$row->productID}}" data-name="{{$row->name}}" data-description="{{$row->description}}"  data-category="{{$row->productCategoryID}}" data-brand="{{$row->productBrandID}}" data-sell="{{$row->defaultSellPrice}}" data-buy="{{$row->defaultBuyPrice}}"  data-unit="{{$row->unit}}" class="btn btn-xs btn-flat btn-success ediModal"  data-toggle="modal" data-target="#productEdiModal">Edit</button></td>
                            <td class="text-right"><a href="{{url('product/del', [$row->productID])}}" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a></td>
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
                    { "orderable": false, "targets": [7,8] }//For Column Order
                ]
            });
        });

        $(function () {
            $('.ediModal').click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var category = $(this).data('category');
                var brand = $(this).data('brand');
                var sell = $(this).data('sell');
                var buy = $(this).data('buy');
                var unit = $(this).data('unit');
                var description = $(this).data('description');

                $('#ediProductForm [name=id]').val(id);
                $('#ediProductForm [name=name]').val(name);
                $('#ediProductForm [name=defaultSellPrice]').val(sell);
                $('#ediProductForm [name=defaultBuyPrice]').val(buy);
                $('#ediProductForm [name=productCategoryID]').val(category);
                $('#ediProductForm [name=productBrandID]').val(brand);
                $('#ediProductForm [name=unit]').val(unit);
                $('#ediProductForm [name=description]').val(description);

            });
        });



    </script>

@endsection
