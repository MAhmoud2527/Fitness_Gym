<!DOCTYPE html>
<html>
<!-- BEGIN: Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Fitness-Gym
  </title>
  <link rel="shortcut icon" href="{{url('assets/app-assets/images/fav.png')}}" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

  <!-- BEGIN: Vendor CSS-->
  <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/vendors/css/vendors.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
  <!-- END: Vendor CSS-->

  <!-- BEGIN: Theme CSS-->
  <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/css/bootstrap.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/css/bootstrap-extended.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/css/colors.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/css/components.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/css/themes/dark-layout.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/css/themes/semi-dark-layout.css')}}">

  <!-- BEGIN: Page CSS-->
  <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/css/core/colors/palette-gradient.css')}}">
  <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/vendors/css/forms/select/select2.min.css')}}">
  <!-- END: Page CSS-->

  <!-- BEGIN: Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{url('assets/assets/css/style.css')}}">
  <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <!-- Right nav header -->
                    </div>

                    <ul class="nav navbar-nav float-right">

                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>



                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{ auth('gym')->user()->username }}</span><span class="user-status">Available</span></div><span><img class="round" src="{{url('/images/' . auth('gym')->user()->photo)}}" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href=""><i class="feather icon-user"></i> Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('/logOut')}}"><i class="feather icon-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
