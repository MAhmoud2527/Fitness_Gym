@include('layout.header')
@include('layout.sidemenue')



<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left
                                    mb-0">Dashboard</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Dashboard</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            @if (session()->get('Message'))
            <div class="alert alert-success" style="text-align: center; font-size=20px">  {{ session()->get('Message') }}</div>

            @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card" style="height: 278.875px;">
                                                <div class="card-header">
                                                    <h4 class="card-title">Exercise Days</h4>
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <ul class="nav flex-column">

                                                                <li class="nav-item">
                                                                    <a class="nav-link active" href="more.php?id="></a>
                                                                </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>
<!-- END: Content-->
@include('layout.footer')

