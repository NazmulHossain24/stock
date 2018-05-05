@extends('layouts.master')
@extends('box.user.user')

@section('title')
    All User
@endsection

@section('page')
    All User
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <table id="dataTable" class="table table-striped table-hover table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th class="text-center">Change Roles</th>
                        <th class="text-right">Del</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->roles}}</td>
                            <td class="text-center"><button data-id="{{$row->id}}" data-roles="{{$row->roles}}" data-name="{{$row->name}} [{{$row->email}}]" class="btn btn-xs btn-flat btn-success ediModal"  data-toggle="modal" data-target="#rolesModal">Change roles</button></td>
                            <td class="text-right"><a href="{{url('user/del', [$row->id])}}" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></a></td>
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
                    { "orderable": false, "targets": [4,5] }//For Column Order
                ]
            });
        });

        $(function () {
            $('.ediModal').click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var roles = $(this).data('roles');

                $('#userID').val(id);
                $('#user').html(name);
                $('#roles').val(roles);
            });
        });

    </script>

@endsection
