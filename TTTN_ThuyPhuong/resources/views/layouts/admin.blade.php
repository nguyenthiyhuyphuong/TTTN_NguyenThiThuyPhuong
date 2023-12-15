<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>@yield('title')</title>
   <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
      <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
      <link rel="stylesheet" href="{{asset('datatables/css/dataTables.min.css')}}">
      <link rel="stylesheet" href="{{asset('css/backend.css')}}">
      @yield('header')
</head>

<body class="hold-transition sidebar-mini">
   <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a href="{{route('admin.dashboard')}}" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a href="#" class="nav-link">Contact</a>
            </li>
         </ul>
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                  <i class="fas fa-search"></i>
               </a>
               <div class="navbar-search-block">
                  <form class="form-inline">
                     <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                           aria-label="Search">
                        <div class="input-group-append">
                           <button class="btn btn-navbar" type="submit">
                              <i class="fas fa-search"></i>
                           </button>
                           <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                              <i class="fas fa-times"></i>
                           </button>
                        </div>
                     </div>
                  </form>
               </div>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#" role="button">
                  <i class="fas fa-power-off"></i> Đăng xuất
               </a>
            </li>
         </ul>
      </nav>
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
         <a href="../backend/index.html" class="brand-link">
            <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
               class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">QUẢN TRỊ</span>
         </a>
         <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                  <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
               </div>
               <div class="info">
                  <a href="#" class="d-block">Nguyễn Thị Thúy Phượng</a>
               </div>
            </div>
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Sản phẩm
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="{{route('product.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Tất cả sản phẩm</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="{{route('category.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Danh mục</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="{{route('brand.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Thương hiệu</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Bài viết
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="{{route('post.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Tất cả bài viết</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="{{route('topic.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Chủ đề</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="{{route('page.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Trang đơn</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Quản lý bán hàng
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="{{route('order.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Tất cả đơn hàng</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           {{-- {{route('import.index')}} --}}
                           <a href="" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Nhập hàng</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           {{-- {{route('export.index')}} --}}
                           <a href="" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Xuất hàng</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('customer.index')}}" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Khách hàng</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="{{route('contact.index')}}" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Liên hệ</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Giao diện
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="{{route('menu.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Menu</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="{{route('banner.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Banner</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                           Hệ thống
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                           <a href="{{route('user.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Thành viên</p>
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="{{route('config.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Cấu hình</p>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="nav-header">LABELS</li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Important</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p>Warning</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Informational</p>
                     </a>
                  </li>
               </ul>
            </nav>
         </div>
      </aside>
      @yield('content')
      <!-- END CONTENT-->
      <footer class="main-footer">
         <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
         </div>
         <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
         reserved.
      </footer>
   </div>
   <script src="{{asset('jquery/jquery-3.7.0.min.js')}}"></script>
   <script src="{{asset('datatables/js/dataTables.min.js')}}"></script>
   <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
   <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
   <script>
      $(document).ready(function () {
         $('#mytable').DataTable();
      });
   </script>
   @yield('footer')
</body>

</html>