<div class="leftside-menu">
    <a href="{{ route('dashboard.index') }}" class="logo text-center logo-light" style=" background: #ffffff!important; ">
        <span class="logo-lg">
            <img src="{{ asset('frontend/logo-full.png') }}" alt="" style=" width: 100%;">

        </span>
        <span class="logo-sm">
            <img src="{{ asset('frontend/logo.png') }}" alt="" height="50px">
        </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-item" style=" margin-top: 20px; ">
                <a href="{{ route('dashboard.index') }}" class="side-nav-link">
                    <i class="fas fa-tachometer-alt"></i> <span>الرئيسية</span>
                </a>
            </li>
            <li class="side-nav-title side-nav-item">الأدوار والمستخدمين</li>

            @canany(['read-roles', 'create-role'])
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#outgoing" aria-expanded="false" aria-controls="outgoing"
                        class="side-nav-link">
                        <i class="fas fa-user-lock"></i><span>الأدوار</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="outgoing">
                        <ul class="side-nav-second-level">
                            @can('read-roles')
                                <li>
                                    <a href="{{ route('roles.index') }}">عرض الجميع</a>
                                </li>
                            @endcan
                            @can('create-role')
                                <li>
                                    <a href="{{ route('roles.create') }}">أضف جديد</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcanany
            <!--========================================================================================-->
            @canany(['read-users', 'create-user'])
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users"
                        class="side-nav-link">
                        <i class="fas fa-user-lock"></i><span>المستخدمين</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="side-nav-second-level">
                            @can('read-users')
                                <li>
                                    <a href="{{ route('users.index') }}">عرض الجميع</a>
                                </li>
                            @endcan
                            @can('create-user')
                                <li>
                                    <a href="{{ route('users.create') }}">أضف جديد</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcanany
            <!--========================================================================================-->
            <li class="side-nav-title side-nav-item">الصفحات والأقسام</li>
            @canany(['read-pages', 'create-page'])
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#pages" aria-expanded="false" aria-controls="pages"
                        class="side-nav-link">
                        <i class="fas fa-user-lock"></i><span>الصفحات</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="pages">
                        <ul class="side-nav-second-level">
                            @can('read-pages')
                                <li>
                                    <a href="{{ route('pages.index') }}">عرض الجميع</a>
                                </li>
                            @endcan
                            @can('create-page')
                                <li>
                                    <a href="{{ route('pages.create') }}">أضف جديد</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcanany
            <!--========================================================================================-->
            @canany(['read-categories', 'create-category'])
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#categories" aria-expanded="false" aria-controls="categories"
                        class="side-nav-link">
                        <i class="fas fa-user-lock"></i><span>الأقسام</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="categories">
                        <ul class="side-nav-second-level">
                            @can('read-categories')
                                <li>
                                    <a href="{{ route('categories.index') }}">عرض الجميع</a>
                                </li>
                            @endcan
                            @can('create-category')
                                <li>
                                    <a href="{{ route('categories.create') }}">أضف جديد</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcanany
            <!--========================================================================================-->
            @canany(['read-posts', 'create-post'])
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#posts" aria-expanded="false" aria-controls="posts"
                        class="side-nav-link">
                        <i class="fas fa-user-lock"></i><span>المقالات</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="posts">
                        <ul class="side-nav-second-level">
                            @can('read-posts')
                                <li>
                                    <a href="{{ route('posts.index') }}">عرض الجميع</a>
                                </li>
                            @endcan
                            @can('create-post')
                                <li>
                                    <a href="{{ route('posts.create') }}">أضف جديد</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </li>
            @endcanany
            <!--========================================================================================-->
            @can('read-contacts')
                <li class="side-nav-item">
                    <a href="{{ route('contacts.index') }}" class="side-nav-link">
                        <i class="fas fa-sign-out-alt"></i><span>الوارد</span>
                    </a>
                </li>
            @endcanany
            <!--========================================================================================-->
            <li class="side-nav-item">
                <a href="{{ route('auth.logout') }}" class="side-nav-link">
                    <i class="fas fa-sign-out-alt"></i><span>تسجيل الخروج</span>
                </a>
            </li>
        </ul>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->

</div>
