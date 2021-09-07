@include('layout.header')
@include('layout.sidemenue')
{{-- {{dd($data)}} --}}
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left
                                    mb-0">Dashboard</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Add Member</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> <i class="feather  icon-plus-circle"></i> Add New Member</h4>

                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <form class="form" method="POST" action="{{url('/admin/'. $data[0]->id )}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-body">
                                        <div class="row">
                                            <input type="hidden" name="id" value="{{$data[0]->id }}">
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="text" id="first-name-floating-icon" class="form-control" name="username" placeholder="User Name" value="{{ $data[0]->username }}">

                                                    <div class="form-control-position">
                                                        <i class="feather icon-user"></i>
                                                    </div>
                                                    <label for="first-name-floating-icon">User Name</label>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="email" id="email-id-floating-icon" class="form-control" name="email" placeholder="Email" value="{{$data[0]->email }}">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-mail"></i>
                                                    </div>
                                                    <label for="email-id-floating-icon">Email</label>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-label-group position-relative has-icon-left">
                                                    <input type="number" id="contact-floating-icon" class="form-control" name="phone" placeholder="Phone" value="{{ $data[0]->phone }}">
                                                    <div class="form-control-position">
                                                        <i class="feather icon-smartphone"></i>
                                                    </div>
                                                    <label for="contact-floating-icon">Phone</label>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="contact-floating-icon">Choose Country</label>
                                                    <select class="select2-theme form-control" id="select2-theme" name="country_id">
                                                        <option value="0">Chosee Country</option>
                                                        @foreach ($country as $item)
                                                        <option {{ $item->id == $data[0]->country_id ? 'selected' : '' }} value="{{$item->id}}">{{$item->country_name}}</option>

                                                        @endforeach

                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="contact-floating-icon">Upload Photo</label>
                                                <div class="form-label-group">
                                                    <input type="file" class="form-control" name="photo">
                                                    <div class="form-control-position">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <img class="img-responsive" style="margin-bottom: 15px" width="180px" height="100px"  src="{{url('/images/' . $data[0]->photo)}}" alt="">
                                            </div>
                                            <br> --}}
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Update</button>
                                            </div>
                                        </div>
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
<!-- END: Content-->

@include('layout.footer')
