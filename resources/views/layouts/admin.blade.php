
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Title -->
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico" />

    <link rel="stylesheet" href="{{asset('admin/css/default-assets/themify-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/default-assets/boxicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/nice-select.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/font-awesome.min.css')}}" />

    <link rel="stylesheet" href="{{asset('admin/css/pe-icon-7-stroke.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/material-design-iconic-font.min.css')}}" />
    <!-- Plugins File -->
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/animate.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/introjs.min.css')}}" />

    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}" />
  </head>

  <body>
    <!-- Preloader -->
    <div id="preloader">
      <div class="preloader-book">
        <div class="inner">
          <div class="left"></div>
          <div class="middle"></div>
          <div class="right"></div>
        </div>
        <ul>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
          <li></li>
        </ul>
      </div>
    </div>
    <!-- /Preloader -->


    <div class="flapt-page-wrapper">
      <!-- Sidemenu Area -->
    @include('layouts.partials.sidebar')

      <!-- Page Content -->
      <div class="flapt-page-content">
        <!-- Top Header Area -->
        @include('layouts.partials.navbar')
        <!-- Main Content Area -->
        <div class="main-content introduction-farm">
            @yield('content')

@include('layouts.partials.footer')

        </div>
      </div>
    </div>


    <script src="{{asset('admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/js/default-assets/setting.js')}}"></script>
    <script src="{{asset('admin/js/default-assets/scrool-bar.js')}}"></script>
    <script src="{{asset('admin/js/todo-list.js')}}"></script>

    <!-- Active JS -->
    <script src="{{asset('admin/js/default-assets/active.js')}}"></script>

    <!-- These plugins only need for the run this page -->
    <script src="{{asset('admin/js/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/js/dashboard-custom.js')}}"></script>
  </body>


</html>
