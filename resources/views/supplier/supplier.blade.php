@extends('layouts.master')
@extends('box.supplier.supplier')

@section('title')
    Supplier List
@endsection

@section('page')
    Supplier List
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 btn_mod">
            <button class="btn btn-social btn-primary btn-flat" data-toggle="modal" data-target="#supplierModal">
                <i class="fa fa-plus"></i>
                Add New Supplier
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
                        <th>Supplier Name</th>
                        <th>Contact</th>
                        <th>Category</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th class="text-center">Edit</th>
                        <th class="text-right">Del</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{$row->supplierID}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->contact}}</td>
                            <td>{{$row->category['name']}}</td>
                            <td>{{$row->company}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->address}}</td>
                            <td class="text-center"><button data-id="{{$row->supplierID}}" data-name="{{$row->name}}" data-category="{{$row->supplierCategoryID}}" data-contact="{{$row->contact}}" data-company="{{$row->company}}" data-email="{{$row->email}}" data-address="{{$row->address}}" class="btn btn-xs btn-flat btn-success ediModal"  data-toggle="modal" data-target="#supplierEdiModal">Edit</button></td>
                            <td class="text-right"><a href="{{url('supplier/del', [$row->supplierID])}}" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a></td>
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
                var company = $(this).data('company');
                var email = $(this).data('email');
                var contact = $(this).data('contact');
                var category = $(this).data('category');
                var address = $(this).data('address');

                $('#ediSupplierForm [name=id]').val(id);
                $('#ediSupplierForm [name=name]').val(name);
                $('#ediSupplierForm [name=company]').val(company);
                $('#ediSupplierForm [name=email]').val(email);
                $('#ediSupplierForm [name=contact]').val(contact);
                $('#ediSupplierForm [name=supplierCategoryID]').val(category);
                $('#ediSupplierForm [name=address]').val(address);

            });
        });



    </script>

@endsection
