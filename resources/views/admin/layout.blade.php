<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>QUẢN LÝ SINH VIÊN</title>

        <!-- Custom fonts for this template-->
        <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
        <!-- Custom styles for this page -->
        @yield('css_custom')


    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{URL::to('/')}}">
                    <div class="sidebar-brand-text mx-3">QUẢN LÝ SINH VIÊN</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">




                <!-- WEB site quản lý sinh viên -->

                <!-- Nav Item - Quản lý User -->
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/quantri/quanlyuser')}}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Quản lý Người dùng</span></a>
                </li>
                @if (Auth::check())
                @if (Auth::user()->role == 1)
                        
                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/quantri/quanlysinhvien')}}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Quản lý Sinh viên</span></a>
                </li>
                @endif
                @endif

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/quantri/quanlybaitap')}}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Quản lý Bài tập</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('/quantri/quanlychallenge')}}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Quản lý Challenge</span></a>
                </li>



            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                        @if (Auth::check())
                                        {{Auth::user()->fullname }}
                                        @endif
                                    </span>
                                    <img class="img-profile rounded-circle"
                                         src="{{asset('admin/img/undraw_profile.svg')}}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                     aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{URL::to('/quantri/editinfo')}}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Thông tin
                                    </a>
                                    <a class="dropdown-item" href="{{URL::to('/quantri/comment')}}">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Lời nhắn
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Đăng xuất
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->










                    @yield('content')










                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Quản lý sinh viên 2021</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>


        @yield('scripts')

    </body>

</html>