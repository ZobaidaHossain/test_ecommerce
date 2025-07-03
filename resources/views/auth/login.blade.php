
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

    <!-- ======================================
    ******* Page Wrapper Area Start **********
    ======================================= -->
    <div class="main-content- h-100vh">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-sm-10 col-md-7 col-lg-5">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card-body">
                            <div class="log-header-area card p-4 mb-4 text-center">
                                <h5>Welcome Back !</h5>
                                <p class="mb-0">Sign in to continue.</p>
                            </div>

                            <div class="card">
                                <div class="card-body p-4">

                                    @include('auth._message')
                                    <form action="" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-group mb-3">
                                            <label class="text-muted" for="yourEmail">Email address</label>
                                            <input class="form-control" type="email" name="email" id="yourEmail"
                                                placeholder="Enter your email">
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="text-muted" for="yourPassword">Password</label>
                                            <input class="form-control" type="password" id="yourPassword" name="password"
                                                placeholder="Enter your password">
                                        </div>
                                        <div class="form-group mb-3">
                                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember Me</label>

                                        </div>

                                        <div class="form-group mb-3">
                                            <button class="btn btn-primary btn-lg w-100" type="submit">Sign Up</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
