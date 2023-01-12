<header>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="custom_header">
                <div class="col-md-4 align-items-center py-3 h-100">
                    <a href="{{route('front.index')}}" class="logo"> <img src="{{ asset('frontend/logo.png') }}" alt=""></a>
                    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                        <span>مجلس الخدمات المشترك <br> لإدارة النفايات الصلبة لمحافظتي غزة والشمال</span><br>
                    @else
                        <span>JSC for Solid Waste <br>Management Gaza and North Governorates</span><br>
                    @endif

                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col p-0">
                <nav class="navbar navbar-expand-lg menu p-0">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-list-ul"></i> القائمة
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="{{route('front.index')}}"><i class="fas fa-home"></i>
                                    {{ __('front.home') }}</a>
                            </li>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-hospital-alt"></i> {{ __('front.jsc') }}</a>
                                <ul class="dropdown-menu">
                                    <?php
                                    $pages = DB::table('pages')->select('id', 'slug', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name', 'description_' . LaravelLocalization::getCurrentLocale() . ' as description', 'keywords_' . LaravelLocalization::getCurrentLocale() . ' as keywords', 'content_' . LaravelLocalization::getCurrentLocale() . ' as content', 'is_active', 'view_count', 'created_at')->whereIs_active('1')->get();
                                    foreach ($pages as $item) { ?>
                                    <li><a class="dropdown-item"
                                            href="{{ route('showPage.show', $item->slug) }}">{{ $item->name }}</a>
                                    </li>
                                    <?php }
                                    ?>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-hotel"></i>
                                    {{ __('front.mun') }}</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#"><i
                                        class="fas fa-project-diagram"></i> {{ __('front.projects') }}</a>
                            </li>
                            <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-newspaper"></i> {{ __('front.media_center') }}</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">{{ __('front.ads') }}</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#"><i
                                        class="far fa-paper-plane"></i>
                                    {{ __('front.complaints') }}</a>
                            </li>
                            <li class="nav-item"><a class="nav-link"
                                    href="#">{{ __('front.es_reports') }}</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
