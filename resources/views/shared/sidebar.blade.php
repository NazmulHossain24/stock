<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="{{ (Request::is('/') ? 'active' : '') }}"><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview {{ (Request::is('sell/*', 'sell') ? 'active' : '') }}">
                <a href="">
                    <i class="fa fa-shopping-bag"></i>
                    <span>Sells</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('sell') ? 'active' : '') }}  {{(Auth::user()->roles == 'Accountant' ? 'nv':'')}}"><a href="{{url('sell')}}"><i class="fa fa-circle-o"></i> New Sell</a></li>
                    <li class="{{ (Request::is('sell/ledger') ? 'active' : '') }}"><a href="{{url('sell/ledger')}}"><i class="fa fa-circle-o"></i> Sell Ledger</a></li>
                    <li class="{{ (Request::is('sell/invoice') ? 'active' : '') }}"><a href="{{url('sell/invoice')}}"><i class="fa fa-circle-o"></i> Sell Invoice</a></li>
                    <li class="{{ (Request::is('sell/order') ? 'active' : '') }}"><a href="{{url('sell/order')}}"><i class="fa fa-circle-o"></i> Order Invoice</a></li>
                    <li class="{{ (Request::is('sell/due') ? 'active' : '') }}"><a href="{{url('sell/due')}}"><i class="fa fa-circle-o"></i> Due Invoice</a></li>
                </ul>
            </li>
			<li class="treeview {{ (Request::is('purchase/*', 'purchase') ? 'active' : '') }}">
                <a href="">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Purchase</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('purchase') ? 'active' : '') }} {{(Auth::user()->roles == 'Accountant' ? 'nv':'')}}"><a href="{{url('purchase')}}"><i class="fa fa-circle-o"></i> New Purchase</a></li>
                    <li class="{{ (Request::is('purchase/ledger') ? 'active' : '') }}"><a href="{{url('purchase/ledger')}}"><i class="fa fa-circle-o"></i> Purchase Ledger</a></li>
                    <li class="{{ (Request::is('purchase/receipt') ? 'active' : '') }}"><a href="{{url('purchase/receipt')}}"><i class="fa fa-circle-o"></i> Purchase Receipt</a></li>
                    <li class="{{ (Request::is('purchase/due') ? 'active' : '') }}"><a href="{{url('purchase/due')}}"><i class="fa fa-circle-o"></i> Due Receipt</a></li>
                </ul>
            </li>

            <li class="{{ (Request::is('stock/product') ? 'active' : '') }}"><a href="{{url('stock/product')}}"><i class="fa fa-archive"></i> <span>Stock</span></a></li>

            <li class="treeview {{ (Request::is('product/*', 'product') ? 'active' : '') }}">
                <a href="">
                    <i class="fa fa-cubes"></i>
                    <span>Product</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('product') ? 'active' : '') }}"><a href="{{url('product')}}"><i class="fa fa-circle-o"></i> Product List</a></li>
                    <li class="{{ (Request::is('product/category') ? 'active' : '') }} {{(Auth::user()->roles == 'Accountant' ? 'nv':'')}}"><a href="{{url('product/category')}}"><i class="fa fa-circle-o"></i> Product Category</a></li>
                    <li class="{{ (Request::is('product/brand') ? 'active' : '') }} {{(Auth::user()->roles == 'Accountant' ? 'nv':'')}}"><a href="{{url('product/brand')}}"><i class="fa fa-circle-o"></i> Product Brand</a></li>
                </ul>
            </li>
            <li class="treeview {{ (Request::is('customer/*', 'customer') ? 'active' : '') }}">
                <a href=""><i class="fa fa-users"></i>
                    <span>Customer</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('customer') ? 'active' : '') }}"><a href="{{url('customer')}}"><i class="fa fa-circle-o"></i> Customer List</a></li>
                    <li class="{{ (Request::is('customer/category') ? 'active' : '') }} {{(Auth::user()->roles == 'Accountant' ? 'nv':'')}}"><a href="{{url('customer/category')}}"><i class="fa fa-circle-o"></i> Customer Category</a></li>
                    <li class="{{ (Request::is('customer/account') ? 'active' : '') }} {{(Auth::user()->roles == 'Sells' ? 'nv':'')}}"><a href="{{url('customer/account')}}"><i class="fa fa-circle-o"></i> Customer Accounts</a></li>
                </ul>
            </li>
            <li class="treeview {{ (Request::is('supplier/*', 'supplier') ? 'active' : '') }}">
                <a href="">
                    <i class="fa fa-user-secret"></i>
                    <span>Supplier</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('supplier') ? 'active' : '') }}"><a href="{{url('supplier')}}"><i class="fa fa-circle-o"></i> Supplier List</a></li>
                    <li class="{{ (Request::is('supplier/category') ? 'active' : '') }} {{(Auth::user()->roles == 'Accountant' ? 'nv':'')}}"><a href="{{url('supplier/category')}}"><i class="fa fa-circle-o"></i> Supplier Category</a></li>
                </ul>
            </li>

            <li class="treeview {{ (Request::is('expense/*', 'expense') ? 'active' : '') }} {{(Auth::user()->roles == 'Sells' ? 'nv':'')}}">
                <a href="">
                    <i class="fa fa-upload"></i>
                    <span>Other Expense</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('expense') ? 'active' : '') }}"><a href="{{url('expense')}}"><i class="fa fa-circle-o"></i> All Expense</a></li>
                    <li class="{{ (Request::is('expense/category') ? 'active' : '') }}"><a href="{{url('expense/category')}}"><i class="fa fa-circle-o"></i> Expense Category</a></li>
                </ul>
            </li>



            <li class="{{ (Request::is('cashbook') ? 'active' : '') }} {{(Auth::user()->roles == 'Sells' ? 'nv':'')}}"><a href="{{url('cashbook')}}"><i class="fa fa-book"></i> <span>Cash Book</span></a></li>

            <li class="treeview {{ (Request::is('bankbook/*', 'bankbook') ? 'active' : '') }} {{(Auth::user()->roles == 'Sells' ? 'nv':'')}}">
                <a href="">
                    <i class="fa fa-university"></i>
                    <span>Bank Book</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('bankbook') ? 'active' : '') }}"><a href="{{url('bankbook')}}"><i class="fa fa-circle-o"></i> Bank Book</a></li>
                    <li class="{{ (Request::is('bankbook/bank') ? 'active' : '') }}"><a href="{{url('bankbook/bank')}}"><i class="fa fa-circle-o"></i> Bank Accounts</a></li>
                </ul>
            </li>
            <li class="{{ (Request::is('reports') ? 'active' : '') }} {{(Auth::user()->roles == 'Sells' ? 'nv':'')}}"><a href="{{url('reports')}}"><i class="fa fa-line-chart"></i> <span>Reports</span></a></li>
            <li class="{{ (Request::is('user') ? 'active' : '') }} {{(Auth::user()->roles != 'Admin' ? 'nv':'')}}"><a href="{{url('user')}}"><i class="fa fa-user"></i> <span>User List</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>