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
                            <h4 class="card-title">
                                <a href="{{url('/admin/create/')}}" class="btn btn-primary" > Add New Manager</a>
                            </h4>

                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                                    <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                    <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                                    <li><a data-action="close"><i class="feather icon-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">


                                        <div class="table-responsive">
                                            <table class="table zero-configuration" id="info_data">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>image</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data as $key => $item)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td><img width="60px" height="60px" src="{{url('/images/' . $item->photo)}}" alt=""></td>
                                                        <td>{{$item->username}}</td>
                                                        <td>{{$item->email}}</td>
                                                        <td>{{$item->phone}}</td>
                                                        <td>
                                                            <a href="{{ url('admin/'. $item->id . '/edit')}}" class="btn btn-primary">Edit</a>
                                                            <a href="" data-toggle="modal" data-target="#modal_single_del_{{$item->id}}" class="btn bg-gradient-danger waves-effect waves-light">Delete</a>
                                                        </td>
                                                    </tr>
                                                    {{-- Model For Delete --}}
                                                    <div class="modal" id="modal_single_del_{{$item->id}}" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Confirmation</h5>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <p> {{ 'Confirm to delete user  : '. $item->username }}</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{url('admin/'.$item->id)}}" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <div class="not-empty-record">
                                                                            <button type="button" class="btn btn-info" data-dismiss="modal">close</button>
                                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                            </table>
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
