@extends('backend.layouts.master')
@section('stylesheet')
@endsection
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">الرئيسية<i
                                        class="dripicons-chevron-left"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">الأقسام<i
                                        class="dripicons-chevron-left"></i></a></li>
                            <li class="breadcrumb-item">أضف جديد</li>
                        </ol>
                    </div>
                    <h4 class="page-title">أضف قسم جديد</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form id="addDataForm" action="" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div class="col-md-12">
                                    
                                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3" style=" padding: 0; ">
                                        <li class="nav-item">
                                            <a href="#ar_tab" data-bs-toggle="tab" aria-expanded="false"
                                                class="nav-link rounded-0 active">
                                                <i class="mdi mdi-home-variant d-md-none d-block"></i>
                                                <span class="d-none d-md-block">عربي</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#en_tab" data-bs-toggle="tab" aria-expanded="true"
                                                class="nav-link rounded-0">
                                                <i class="mdi mdi-account-circle d-md-none d-block"></i>
                                                <span class="d-none d-md-block">English</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="ar_tab">
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="name_ar" class="form-label">الاسم</label>
                                                    <input type="text" class="form-control" id="name_ar"
                                                        name="name_ar">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="keywords_ar" class="form-label">الكلمات
                                                        المفتاحية</label>
                                                    <input type="text" class="form-control" id="keywords_ar"
                                                        name="keywords_ar">
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label for="description_en" class="form-label">الوصف</label>
                                                    <input type="text" class="form-control" id="description_ar"
                                                        name="description_ar">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="en_tab">
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="name_en" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name_en"
                                                        name="name_en">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="keywords_en" class="form-label">keywords</label>
                                                    <input type="text" class="form-control" id="keywords_en"
                                                        name="keywords_en">
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <label for="description_en" class="form-label">description</label>
                                                    <input type="text" class="form-control" id="description_en"
                                                        name="description_en">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary" id="btnSubmit"
                                    style=" margin-top: 20px; padding: 6px 25px; ">حفظ</button>
                            </form>
                        </div>
                        <!-- end row -->

                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

    </div>
@endsection

@section('script')
    <script>
        //create
        $("#addDataForm").on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($('#addDataForm')[0]);
            axios({
                    method: 'post',
                    url: "{{ route('categories.store') }}",
                    data: formData
                })
                .then(function(response) {
                    $('#addDataForm').trigger("reset");
                    Toast.fire({
                        icon: 'success',
                        title: response.data.message
                    })
                })
                .catch(function(error) {
                    // console.log(error);
                    if (error.response.status == 422) {
                        var object = error.response.data.errors;
                        for (const key in object) {
                            var message = object[key][0]
                            break;
                        }
                        toastr.error(message);
                    } else {
                        toastr.error(error.response.data.message);
                    }
                });
        });
    </script>
@endsection
