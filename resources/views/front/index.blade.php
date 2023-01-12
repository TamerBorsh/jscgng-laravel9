@extends('front.layouts.master')
@section('title')
    الصفحة الرئيسية
@endsection
@section('slider')
    <div class="slider" data-aos="fade-up" data-aos-duration="2000">
        <div class="container-fluid p-0">
            <div class="owl-carousel owl-theme">
                @forelse ($sliders as $slider)
                    <div class="item">
                        <a href="{{ route('post.show', $slider->slug) }}">
                            @if ($slider->photo)
                                <img class="slideImg"
                                    src="{{  $slider->photo }}"alt="">
                            @else
                                <img class="slideImg" src="{{ asset('images/uploads/posts/post.png') }}"alt="">
                            @endif
                        </a>
                        <div class="title">
                            <a
                                href="{{ route('post.show', $slider->slug) }}">{{ Str::limit($slider->name, 100, '...') }}</a>
                        </div>
                    </div>
                @empty
                    <h3>لا يوجد بيانات</h3>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('activities')
    <div class="activities" data-aos="fade-up" data-aos-duration="2000">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="start">
                        <div class="topic">
                            <header class="title_ text-start">
                                <h3># {{ __('front.activities') }}</h3>
                                <div class="link d-inline-block text-end"> <a href="#">{{ __('front.more') }}</a>
                                </div>
                            </header>
                            <div class="row">
                                @forelse ($activities as $activity)
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="item">
                                            <div class="topic_img"> <a href="{{ route('post.show', $activity->slug) }}">
                                                    @if ($activity->photo)
                                                        <img class="slideImg"
                                                            src="{{ $activity->photo }}"alt="">
                                                    @else
                                                        <img class="slideImg"
                                                            src="{{ asset('images/uploads/posts/post.png') }}"alt="">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="topic_title"> <a
                                                    href="{{ route('post.show', $activity->slug) }}">{{ $activity->name }}</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <h2>لا يوجد بيانات</h2>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="face col-md-4">
                    <div class="end text-center">
                        <h1 class="title">{{ __('front.title_page_face') }}</h1>
                        <div class="fb-page" data-href="https://www.facebook.com/JSCGNG" data-tabs="timeline"data-width=""
                            data-height="" data-small-header="false"data-adapt-container-width="true"
                            data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/JSCGNG" class="fb-xfbml-parse-ignore"><a
                                    href="https://www.facebook.com/JSCGNG">‏مجلس الخدمات المشترك لإدارة النفايات
                                    الصلبة في محافظتي غزة والشمال‏</a></blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('latest_projects')
    <div class="latest_projects" data-aos="fade-up" data-aos-duration="2000">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <header class="title_ text-start">
                        <h3># {{ __('front.latest_projects') }}</h3>
                        <div class="link d-inline-block text-end"> <a href="#">{{ __('front.more') }}</a>
                        </div>
                    </header>
                </div> <!-- end col -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row row-cols-1 row-cols-md-4 g-3">
                        @forelse ($projects as $project)
                            <div class="col">
                                <div class="card"> <a href="{{ route('post.show', $project->slug) }}">
                                        <div class="projects_image">
                                            @if ($project->photo)
                                                <img class="slideImg"
                                                    src="{{ $project->photo }}"
                                                    class="card-img-top" alt="">
                                            @else
                                                <img class="slideImg"
                                                    src="{{ asset('images/uploads/posts/post.png') }}"alt="">
                                            @endif

                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <h1 class="card-title"><a href="{{ route('post.show', $project->slug) }}">
                                                {{ $project->name }}</a></h1>
                                        <p class="card-text"> {{ $project->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h2>لا يوجد بيانات</h2>
                        @endforelse
                    </div>
                </div> <!-- end col-->
            </div>
        </div>
    </div>
@endsection
@section('galleries')
    <section class="galleries" data-aos="fade-up" data-aos-duration="2000">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <header class="title_ text-start">
                        <h3># {{ __('front.gallery') }}</h3>
                        <div class="link d-inline-block text-end"> <a href="#">{{ __('front.more') }}</a>
                        </div>
                    </header>
                </div> <!-- end col -->
            </div>
            <div class="row" style=" background: #fff; margin: 10px 0 0 0; ">
                @forelse ($galleries as $gallery)
                    <div class="col-lg-3 col-md-4 col-sm-12 col-12">
                        <div class="item">
                            <div class="ImageExhibitionImg">
                                <a href="{{ route('post.show', $gallery->slug) }}">
                                    @if ($gallery->photo)
                                        <img class="slideImg" src="{{ $gallery->photo }}"
                                            alt="">
                                    @else
                                        <img class="slideImg"
                                            src="{{ asset('images/uploads/posts/post.png') }}"alt="">
                                    @endif

                                </a>
                            </div>
                            <div class="ImageExhibitionTitle">
                                <a href="{{ route('post.show', $gallery->slug) }}">{{ $gallery->name }}</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <h2>لا يوجد بيانات</h2>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@section('donors')
    <div class="donors" data-aos="fade-up" data-aos-duration="2000">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class=" text-center" style=" padding: 40px 0; color: #293a50;font-size: 32px;">
                        {{ __('front.donors') }}
                    </h1>
                </div> <!-- end col -->
            </div>
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <a href="https://www.worldbank.org/en/home" target="_blank"><img
                            class="slideImg"src="{{ asset('frontend/images/donors/3.png') }}" alt=""></a>
                    <div class="title">
                        <h4>البنك الدولي</h4>
                    </div>
                </div>
                <div class="item">
                    <a href="https://european-union.europa.eu/index_en" target="_blank"><img
                            class="slideImg"src="{{ asset('frontend/images/donors/logo-eu--en.svg') }}"
                            alt=""></a>
                    <div class="title">
                        <h4>الاتحاد الأوروبي</h4>
                    </div>
                </div>
                <div class="item">
                    <a href="https://www.afd.fr/en" target="_blank"><img
                            class="slideImg"src="{{ asset('frontend/images/donors/2.png') }}" alt=""></a>
                    <div class="title">
                        <h4>وكالة المساعدات الفرنسية</h4>
                    </div>
                </div>
                <div class="item">
                    <a href="https://www.jica.go.jp/english/index.html" target="_blank"><img
                            class="slideImg"src="{{ asset('frontend/images/donors/5.gif') }}" alt=""></a>
                    <div class="title">
                        <h4>وكالة التعاون الدولي الياباني </h4>
                    </div>
                </div>
                <div class="item">
                    <a href="https://www.usaid.gov/" target="_blank"><img
                            class="slideImg"src="{{ asset('frontend/images/donors/8.png') }}" alt=""></a>
                    <div class="title">
                        <h4>وكالة المساعدات الأمريكية</h4>
                    </div>
                </div>
                <div class="item">
                    <a href="https://www.oxfam.org/en" target="_blank"><img
                            class="slideImg"src="{{ asset('frontend/images/donors/9.png') }}" alt=""></a>
                    <div class="title">
                        <h4>مؤسسة اوكسفام</h4>
                    </div>
                </div>
                <div class="item">
                    <a href="https://www.mdlf.org.ps/ar/Home/Index" target="_blank"><img
                            class="slideImg"src="{{ asset('frontend/images/donors/1.png') }}" alt=""></a>
                    <div class="title">
                        <h4>صندوق تطوير واقراض البلديات</h4>
                    </div>
                </div>
                <div class="item">
                    <a href="https://www.undp.org/" target="_blank"><img
                            class="slideImg"src="{{ asset('frontend/images/donors/7.svg') }}" alt=""></a>
                    <div class="title">
                        <h4>UNDP</h4>
                    </div>
                </div>
                <div class="item">
                    <a href="http://molg.ps/ar/" target="_blank"><img
                            class="slideImg"src="{{ asset('frontend/images/donors/6.png') }}" alt=""></a>
                    <div class="title">
                        <h4>وزارة الحكم المحلي</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('location')
    <div class="location" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class=" text-center" style=" padding: 40px 0; color: #293a50;font-size: 32px;">
                        {{ __('front.contact') }}
                    </h1>
                </div> <!-- end col -->
            </div>
            <div class="row">
                <div class="col-md-6" data-aos-duration="2000">
                    <form id="addDataForm" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="fullname" class="form-label">{{ __('front.name') }}</label>
                                    <input class="form-control form-control-light" type="text" id="name"
                                        name="name" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="email" class="form-label">{{ __('front.email') }}</label>
                                    <input class="form-control form-control-light" type="email" required=""
                                        id="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="phone" class="form-label">{{ __('front.number') }}</label>
                            <input class="form-control form-control-light" type="number" id="phone" name="phone">
                        </div>
                        <div class="mb-2">
                            <label for="title" class="form-label">{{ __('front.subject') }}</label>
                            <input class="form-control form-control-light" type="text" id="title" name="title"
                                required="">
                        </div>
                        <div class="mb-2">
                            <label for="comment" class="form-label">{{ __('front.message') }}</label>
                            <textarea id="comment" name="comment" rows="4" class="form-control form-control-light" spellcheck="false"
                                required=""></textarea>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 text-center">
                                <button class="btn btn-primary" id="btnSubmit" type="submit"
                                    style=" background: #293a50; border: none; padding: 6px 20px; ">{{ __('front.send') }}<i
                                        class="mdi mdi-telegram ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <div class="mapHome">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2731.72394924014!2d34.51743718245418!3d31.544319502246353!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xad9303f16004aca8!2zMzHCsDMyJzM5LjUiTiAzNMKwMzAnNDcuNiJF!5e1!3m2!1sar!2sus!4v1664960059755!5m2!1sar!2sus"
                            width="100%" height="460" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>
        </div>
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
                    url: "{{ route('contacts.store') }}",
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
