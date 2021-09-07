
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login Page</title>
    <link rel="apple-touch-icon" href="assets/>
        <link rel=" shortcut icon" type="image/x-icon" href="{{url('assets/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="shortcut icon" href="{{url('assets/app-assets/images/fav.png')}}" type="image/x-icon">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/vendors/css/vendors.min.css')}}">
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
    <link rel="stylesheet" type="text/css" href="{{url('assets/app-assets/css/pages/authentication.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('assets/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column navbar-floating
        footer-static bg-full-screen-image blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">


                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex
                            justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-12 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Login</h4>
                                            </div>
                                        </div>

                                        <br>
                                        <p class="px-2">Welcome back, please
                                            login to your account.</p>

                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                @if (session()->get('Message'))
                                                <div class="alert alert-danger" style="text-align: center; font-size=20px">  {{ session()->get('Message') }}</div>
                                                @endif
                                                @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                                <form method="POST" action="{{url('/doLogin')}}">
                                                    @csrf
                                                    <fieldset class="form-label-group
                                                            form-group
                                                            position-relative
                                                            has-icon-left">
                                                        <input type="email" class="form-control" id="user-name" placeholder="Email" name="email" required>
                                                        <div class="form-control-position">
                                                            <i class="feather
                                                                    icon-user"></i>
                                                        </div>
                                                        <label for="user-name">Email</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group
                                                            position-relative
                                                            has-icon-left">
                                                        <input type="password" class="form-control" id="user-password" placeholder="Password" name="password" required>
                                                        <div class="form-control-position">
                                                            <i class="feather
                                                                    icon-lock"></i>
                                                        </div>
                                                        <label for="user-password">Password</label>
                                                    </fieldset>
                                                    <fieldset class="form-group">
                                                        <select class="form-control" id="basicSelect" name="usertype_id">
                                                            @foreach ($data as $item)
                                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </fieldset>
                                                    <fieldset>
                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                            <input type="checkbox"  value="false" name="rememberMe">
                                                            <span class="vs-checkbox">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                            <span class="">Remember Me</span>
                                                        </div>
                                                    </fieldset>
                                                    <br>
                                                    <button type="submit" class="btn
                                                            btn-primary btn-block
                                                            float-right
                                                            btn-inline">Login</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="login-footer">
                                            <div class="divider">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{url('assets/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{url('assets/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{url('assets/app-assets/js/core/app.js')}}"></script>
    <script src="{{url('assets/app-assets/js/scripts/components.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
