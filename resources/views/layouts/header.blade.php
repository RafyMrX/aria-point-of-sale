<!DOCTYPE html>
<html lang="en">
    @stack('styles')
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    {{-- <link rel="shortcut icon" href="" type="image/x-icon"> --}}
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
    <link 
  href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
  rel="stylesheet"  type='text/css'>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ url('dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    {{-- datatables --}}
    <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>


    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- select 2 --}}
 
</head>

<body class="hold-transition sidebar-mini">



    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-dark" style="background-color: #5f815e;    border-bottom: 4px solid #b2b2b2;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i> </a>
                </li>
            
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold">
                        {{ date('l, d/F/Y') }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        
                      <p> Halo, {{ auth()->user()->name }}  <i class="fa fa-caret-down" aria-hidden="true"></i></p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                      <div class="dropdown-divider"></div>
                      <form action="{{ url('/logout') }}" method="get">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="fa fa-sign-out" aria-hidden="true"></i> Log out</button>
                      </form>
                    </div>
                  </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <!-- Notifications Dropdown Menu -->
                {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
                <i class="fas fa-envelope mr-2"></i> Log Out
              </a>
            </div>
          </li> --}}
          

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #2c2d2e;">
            <!-- Brand Logo -->
            <a href="/" class="brand-link" style="background-color: #2c2d2e;color:#fff;">
                <img src="" class="brand-image img-circle elevation-3" style="opacity: .8">
                <h4 class=" text-center">ARIA System</h4>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex ">
                    <div class="info">
                        <a href="#" class=" text-center d-block font-weight-bold"> {{ date('d F Y') }}</a>
                    </div>
                </div> --}}


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        {{-- DASHBOARD --}}
                        <li class="nav-header">DATA CHART</li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link">
                                <i class="fa fa-line-chart" aria-hidden="true"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        
                        {{-- DATA MASTER  --}}
                        <li class="nav-header">DATA MASTER</li>
                     
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-university" aria-hidden="true"></i>
                                <p>
                                    Manajemen Supplier <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/suppliers') }}" class="nav-link">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <p>Data Supplier</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                <p>
                                    Manajemen Retail
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/retails') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-info text-info"></i>
                                        <p>Data Retail</p>
                                    </a>
                                </li>
                              
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-list-ol" aria-hidden="true"></i>
                                <p>
                                     Manajemen Kategori
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/categories') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-warning"></i>
                                        <p>Data Kategori </p>
                                    </a>
                                </li>
                              
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-barcode" aria-hidden="true"></i> 
                                <p>
                                    Manajemen Produk
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/products') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-info"></i>
                                        <p>Data Produk</p>
                                    </a>
                                </li>  
                                {{-- <li class="nav-item">
                                    <a href="{{ url('/data-ujian') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-info"></i>
                                        <p>Data Bahan/Material</p>
                                    </a>
                                </li>                               --}}
                            </ul>
                        </li>
                     
                        <li class="nav-header">DATA TRANSAKSI</li>
                    
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                <p>
                                    Transaksi Penjualan
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/sales') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-info"></i>
                                        <p>Penjualan Produk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/sales-retur') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-info"></i>
                                        <p>Retur Penjualan</p>
                                    </a>
                                </li>   
          
                              
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                <p>
                                    Transaksi Pembelian
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/data-kriteria') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-info"></i>
                                        <p>Pembelian Produk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/data-kriteria') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-info"></i>
                                        <p>Retur Pembelian</p>
                                    </a>
                                </li>   
          
                              
                            </ul>
                        </li>

                        <li class="nav-header">DATA LAPORAN</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                <p>
                                    Laporan
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/sales/reports') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-info"></i>
                                        <p>Lap Penjualan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/data-kriteria') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-info"></i>
                                        <p>Lap Pembelian</p>
                                    </a>
                                </li>         
                              
                            </ul>
                        </li>

                        <li class="nav-header">PENGATURAN PENGGUNA</li>
                        <li class="nav-item">
                            <a href="{{ url('/data-kriteria') }}" class="nav-link">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Pengaturan Admin</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ url('/data-kriteria') }}" class="nav-link">
                                <i class="far fa-circle nav-icon text-info"></i>
                                <p>Pengaturan Role</p>
                            </a>
                        </li> --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>