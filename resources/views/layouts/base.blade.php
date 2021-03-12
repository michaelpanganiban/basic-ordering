<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home</title>
    <link href="{{url('assets/dist/css/styles.css')}}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body style="background-color: #fff9e6 !important;">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark"  style="background-color: #03888c !important;">
    <a class="navbar-brand" href="{{route('home')}}">ORDER TAKER</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" style="color:white;">
        <div class="input-group">
            <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" /> -->
            <!-- <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div> -->
            <h4>{{ucfirst(ucwords(Auth::user()->name))}}</h4>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">Settings</a> -->
                <!-- <a class="dropdown-item" href="#">Activity Log</a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            <!-- <a class="dropdown-item" href="{{route('logout')}}">Logout</a> -->
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav" >
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #01484a;">
            <div class="sb-sidenav-menu" >
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">MAIN MENU</div>
{{--                    <a class="nav-link" href="{{route('dashboard')}}">--}}
{{--                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>--}}
{{--                        Dashboard--}}
{{--                    </a>--}}
                    <a class="nav-link" href="{{route('deliveryConfiguration')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                        Delivery Configurations
                    </a>
                    <a class="nav-link" href="{{route('discountConfiguration')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-percent"></i></div>
                        Discount Configurations
                    </a>
                    <a class="nav-link" href="{{route('productConfiguration')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                        Products
                    </a>
                    <a class="nav-link" href="{{route('home')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                        Orders
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{ucfirst(ucwords(Auth::user()->name))}}
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        @yield('content')
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{url('assets/dist/js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="{{url('assets/dist/assets/demo/datatables-demo.js') }}"></script>
<script src="{{url('assets/dist/js/delivery.js') }}"></script>
<script src="{{url('assets/dist/js/discount.js') }}"></script>
<script src="{{url('assets/dist/js/product.js') }}"></script>
<script src="{{url('assets/dist/js/orders.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>
