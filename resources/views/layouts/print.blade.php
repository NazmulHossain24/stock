<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')| {{config('naz.company')}}</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{asset('public/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/css/font-awesome.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/dist/css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/dist/css/skins/all-skins.min.css')}}">


</head>

<body onload="window.print();" class="hold-transition skin-green sidebar-mini">

<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <div class="row hidden-print">
            <div class="col-xs-12">
                <button class="btn btn-lg btn-success pull-right"  onclick="window.print();" type="button"><i class="fa fa-print"></i> Print</button>
                <a href="{{URL::previous()}}" class="btn btn-lg btn-danger" style="margin-right: 10px;"><i class="fa  fa-chevron-left"></i> Cancel and Back</a>
            </div>
        </div>
        <div class="row hidden-print">
            <div class="col-xs-12"><hr></div>
        </div>

        <div class="row">
            <div class="col-xs-3 text-sm">{{config('naz.company')}}</div>
            <div class="col-xs-6"><h4 class="text-center"><u>@yield('heading')</u></h4></div>
            <div class="col-xs-3 title text-sm text-right"><strong>Date: </strong>{{date('d/m/Y')}}</div>
        </div>
        <div class="row">
            <div class="col-xs-12"><hr style="margin: 10px auto"></div>
        </div>
        @yield('content')


    </section><!-- /.content -->
</div><!-- ./wrapper -->


<script src="{{asset('public/plugins/jQuery/jquery-3.2.1.min.js')}}"></script>

</body>
</html>
