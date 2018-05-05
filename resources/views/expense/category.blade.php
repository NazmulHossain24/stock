@extends('layouts.master')
@extends('box.expense.category')

@section('title')
    Expense Category
@endsection

@section('page')
    Expense Category
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 btn_mod">
            <button class="btn btn-social btn-primary btn-flat" data-toggle="modal" data-target="#categoryModal">
                <i class="fa fa-plus"></i>
                Add New Expense Category
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
                        <th>Expense Category Name</th>
                        <th class="text-center {{(Auth::user()->roles == 'employee' ? 'nv':'')}}">Edit</th>
                        <th class="text-right {{(Auth::user()->roles == 'employee' ? 'nv':'')}}">Del</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{$row->expenseID}}</td>
                            <td>{{$row->name}}</td>
                            <td class="text-center {{(Auth::user()->roles == 'employee' ? 'nv':'')}}"><button data-id="{{$row->expenseID}}" data-name="{{$row->name}}" class="btn btn-xs btn-flat btn-success ediModal"  data-toggle="modal" data-target="#categoryEdiModal">Edit</button></td>
                            <td class="text-right {{(Auth::user()->roles == 'employee' ? 'nv':'')}}"><a href="{{url('expense/category/del', [$row->expenseID])}}" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a></td>
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
                $('#ediCategoryForm [name=id]').val(id);
                $('#ediCategoryForm [name=name]').val(name);
            });
        });

    </script>

@endsection
