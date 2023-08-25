<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrator</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{url('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{url('plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{url('dist/css/theme.css')}}">
    <link rel="stylesheet" href="{{url('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/toastr/toastr.min.css')}}">

    <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
    <script>
        var baseurl = '{{url("/")}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <style>
    small.error {
        color: #d30000;
        font-weight: 600;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{url('dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light ">


            <!-- Right navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

    

                
                <!-- Notifications Dropdown Menu -->
               <!--  <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li> -->
                
                
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('/')}}" class="brand-link">
                <span class="brand-text font-weight-light text-light">
                    @if(Session::has('username'))
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        {{Session::get('username')}} 
                    @else
                       <i class="nav-icon fas fa-tachometer-alt"></i>  Administrator
                    @endif
                    
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <!-- <li class="nav-item">
                            <a href="{{route('/administrator')}}" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li> -->
                        @foreach($menu as $m)
                            @if($m['link'] != '')
                                @php $active = '';
                                    if(url()->current() == route($m['link'])):
                                        $active = 'active';
                                    endif
                                @endphp
                                <li class="nav-item">
                                    <a href="{{route($m['link'])}}"  class="nav-link {{$active}}">
                                        <?=$m['icon']?>
                                        <p>
                                            {{$m['label']}}
                                            <!-- <span class="badge badge-info right">2</span> -->
                                        </p>
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                    <?=$m['icon']?>
                                        <p>
                                        {{$m['label']}}
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @foreach($m['submenu'] as $s)
                                        <li class="nav-item">
                                            <a href="{{route($s['link'])}}" class="nav-link">
                                                <?=$s['icon']?>
                                                <p>{{$s['label']}}</p>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                            
                            
                        @endforeach
                      
                        
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Order Manager
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('/admin/order')}}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Orders</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Transaction Manager</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Sale Manager
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url('')}}/add-sale" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Sale </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('')}}/sale-upload-excel" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Sale by Excel</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">Report Manager</li>
                        <li class="nav-item">
                            <a href="{{url('')}}/sale-report" class="nav-link">
                                <i class="nav-icon fa fa-chart-pie"></i>
                                <p>
                                    Sales Report
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li> -->
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>