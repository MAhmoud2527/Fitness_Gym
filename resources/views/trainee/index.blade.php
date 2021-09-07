@include('layout.header')
@include('layout.sidemenue')

{{-- {{dd($data)}} --}}
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
                                <li class="breadcrumb-item"><a href="">Add Trainee</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data Table Start -->
        <section id="basic-datatable">
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
                                <a href="{{url('/trainee/create')}}" class="btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; Add New Trainee</a>
                                <div class="table-responsive">
                                    <table class="table
                                                    zero-configuration" id="info_data">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Img</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Date</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td><img width="60px" height="60px" src="{{url('/images/' . $item->photo)}}" alt=""></td>
                                                    <td>{{ $item->username}}</td>
                                                    <td>{{ $item->email}}</td>
                                                    <td>{{ $item->phone}}</td>
                                                    <td>{{ $item->created_at}}</td>
                                                    <td>
                                                        <a href="{{ url('trainee/'. $item->id . '/edit')}}" type="button" class="btn bg-gradient-info waves-effect waves-light">Edit</a>
                                                        <a href="" data-toggle="modal" data-target="#modal_single_del_{{$item->id}}"  type="button" class="btn bg-gradient-danger waves-effect waves-light">Delete</a>
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
                                                                <form action="{{url('trainee/'.$item->id)}}" method="post">
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
        </section>
        <!--/ Data table End -->
    </div>
</div>
</div>
<!-- END: Content-->
@include('layout.footer')
