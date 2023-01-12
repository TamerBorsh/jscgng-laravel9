@extends('backend.layouts.master')
@section('stylesheet')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css"
        integrity="sha512-ZbehZMIlGA8CTIOtdE+M81uj3mrcgyrh6ZFeG33A4FHECakGrOsTPlPQ8ijjLkxgImrdmSVUHn1j+ApjodYZow=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .note-editor.note-frame {
            direction: ltr;
            text-align: center;
            background: white;
        }

        .note-editor .note-toolbar .note-color-all .note-dropdown-menu,
        .note-popover .popover-content .note-color-all .note-dropdown-menu {
            min-width: 350px;
        }

        .note-editable {
            min-height: 100px;
        }
    </style>
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
                            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">المقالات<i
                                        class="dripicons-chevron-left"></i></a></li>
                            <li class="breadcrumb-item">أضف جديد</li>
                        </ol>
                    </div>
                    <h4 class="page-title">أضف قسم جديد</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <form id="addDataForm" action="" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
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
                                                <div class="mb-3 col-md-12">
                                                    <label for="name_ar" class="form-label">الاسم</label>
                                                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                                                        value="{{ $post->name_ar }}">
                                                </div>
                                                <div class="mb-3 col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">القسم</label>
                                                        <select class="form-control select2bs4" id="category_id"
                                                            name="category_id" style="width: 100%;" aria-hidden="true">
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="keywords_ar" class="form-label">الكلمات
                                                        المفتاحية</label>
                                                    <input type="text" class="form-control" id="keywords_ar"
                                                        name="keywords_ar" value="{{ $post->keywords_ar }}">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="description_en" class="form-label">الوصف</label>
                                                    <input type="text" class="form-control" id="description_ar"
                                                        name="description_ar" value="{{ $post->description_ar }}">
                                                </div>


                                                <div class="mb-3 col-sm-12">
                                                    <label class="form-label">صورة رئيسية</label>
                                                    <input class="form-control" type="file" id="photo_post"
                                                        name="photo_post" value="{{ $post->photo }}">
                                                </div>
                                                @if ($post->photo)
                                                    <a href="{{ $post->photo }}" target="_blank" rel="noopener noreferrer">
                                                        <img src="{{ $post->photo }}" class="img-thumbnail"
                                                            style=" width: 80px; margin: 10px 0; "></a>
                                                @endif

                                                <div class="col-md-12">
                                                    <label for="content_ar" class="form-label">المحتوى</label>
                                                    <textarea class="form-control" id="content_ar" name="content_ar" rows="3">{{ $post->content_ar }}</textarea>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="tab-pane" id="en_tab">
                                            <div class="row">
                                                <div class="mb-3 col-md-12">
                                                    <label for="name_en" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="name_en"
                                                        name="name_en" value="{{ $post->name_en }}">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="keywords_en" class="form-label">keywords</label>
                                                    <input type="text" class="form-control" id="keywords_en"
                                                        name="keywords_en" value="{{ $post->keywords_en }}">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="description_en" class="form-label">description</label>
                                                    <input type="text" class="form-control" id="description_en"
                                                        name="description_en" value="{{ $post->description_en }}">
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="content_en" class="form-label">Content</label>
                                                    <textarea class="form-control" id="content_en" name="content_en" rows="3">{{ $post->content_en }}</textarea>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"
        integrity="sha512-lVkQNgKabKsM1DA/qbhJRFQU8TuwkLF2vSN3iU/c7+iayKs08Y8GXqfFxxTZr1IcpMovXnf2N/ZZoMgmZep1YQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            // Summernote
            $('#content_ar').summernote()
            $('#content_en').summernote()
        })

        //create
        $("#addDataForm").on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($('#addDataForm')[0]);
            axios({
                    method: 'post',
                    url: "{{ route('posts.update', $post->id) }}",
                    data: formData
                })
                .then(function(response) {
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
