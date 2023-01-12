@extends('backend.layouts.master')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                </div>
            </div>
        </div>

        <!-- start page title -->
        <div class="row">
            <div class="col-sm-12">
                <!-- Profile -->
                <div class="card bg-primary">
                    <div class="card-body profile-user-box">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="avatar-lg">
                                            <img src="{{asset('backend/assets/images/users/avatar-2.jpg')}}" alt=""
                                                class="rounded-circle img-thumbnail">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <h4 class="mt-1 mb-1 text-white">{{auth()->user()->name}}</h4>
                                            <p class="font-13 text-white-50"> Authorised Brand Seller</p>

                                            <ul class="mb-0 list-inline text-light">
                                                <li class="list-inline-item me-3">
                                                    <h5 class="mb-1">$ 25,184</h5>
                                                    <p class="mb-0 font-13 text-white-50">Total Revenue</p>
                                                </li>
                                                <li class="list-inline-item">
                                                    <h5 class="mb-1">5482</h5>
                                                    <p class="mb-0 font-13 text-white-50">Number of Orders</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col-->

                            <div class="col-sm-4">
                                <div class="text-center mt-sm-0 mt-3 text-sm-end" style=" float: left; ">
                                    <button type="button" class="btn btn-light">
                                        <i class="mdi mdi-account-edit me-1"></i> تعديل البيانات
                                    </button>
                                </div>
                            </div> <!-- end col-->
                        </div> <!-- end row -->

                    </div> <!-- end card-body/ profile-user-box-->
                </div>
                <!--end profile/ card -->
            </div> <!-- end col-->
        </div>


        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card widget-inline">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0">
                                    <div class="card-body text-center">
                                        <i class="dripicons-briefcase text-muted" style="font-size: 24px;"></i>
                                        <h3><span>29</span></h3>
                                        <p class="text-muted font-15 mb-0">Total Projects</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="dripicons-checklist text-muted" style="font-size: 24px;"></i>
                                        <h3><span>715</span></h3>
                                        <p class="text-muted font-15 mb-0">Total Tasks</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="dripicons-user-group text-muted" style="font-size: 24px;"></i>
                                        <h3><span>31</span></h3>
                                        <p class="text-muted font-15 mb-0">Members</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-xl-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <i class="dripicons-graph-line text-muted" style="font-size: 24px;"></i>
                                        <h3><span>93%</span> <i class="mdi mdi-arrow-up text-success"></i></h3>
                                        <p class="text-muted font-15 mb-0">Productivity</p>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end row -->
                    </div>
                </div> <!-- end card-box-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div>
@endsection
