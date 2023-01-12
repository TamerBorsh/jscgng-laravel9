<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>تسجيل الدخول | مجلس الخدمات المشترك لإدارة النفايا الصلبة لمحافظتي غزة والشمال</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('frontend/logo.png') }}">
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
        integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @font-face {
            font-family: 'webFont';
            src: url("{{ asset('font/Al-Jazeera-Arabic-Regular.otf') }}");
        }
        body.authentication-bg {
            font-family: 'webFont';direction: rtl;
        }
        .input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            margin-right: -1px;margin-left: 0;
        }
        .input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3),
        .input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu) {
            border-top-right-radius: 0.25rem;border-bottom-right-radius: 0.25rem;border-bottom-left-radius: 0; border-top-left-radius: 0;
        }
        .input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
            margin-right: -1px;margin-left: 0;border-top-right-radius: 0;border-bottom-right-radius: 0;border-top-left-radius: 0.25rem;border-bottom-left-radius: 0.25rem;
        }
        .card-header img {
            height: 70px;width: 66px;display: flex;float: right;
        }
        .card-header span {
            display: flex;color: #293a50;padding: 10px 6px;text-align: start;font-size: 16px;
        }
    </style>
</head>
<body class="loading authentication-bg"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div class="account-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card" style=" border-radius: 16px; ">
                        <div class="card-header" style=" border-radius: 16px; ">
                            <a href="{{ route('auth.login') }}">
                                <img src="{{ asset('frontend/logo.png') }}" alt=""></a>
                            <span>مجلس الخدمات المشترك <br> لإدارة النفايات الصلبة لمحافظتي غزة والشمال</span>
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">تسجيل الدخول</h4>
                                <p class="text-muted mb-4">أدخل عنوان بريدك الإلكتروني وكلمة المرور</p>
                            </div>
                            <form id="login" action="" method="post">
                                @csrf
                                @method('POST')
                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">الايميل</label>
                                    <input class="form-control" type="email" id="email" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">كلمةالمرور</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit"> تسجيل الدخول </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/js/vendor.min.js') }}"></script>
    <script src="{{ asset('backend/js/app.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0/axios.min.js"
        integrity="sha512-26uCxGyoPL1nESYXHQ+KUmm3Maml7MEQNWU8hIt1hJaZa5KQAQ5ehBqK6eydcCOh6YAuZjV3augxu/5tY4fsgQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
        integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        //login
        $("#login").on('submit', function(e) {
            e.preventDefault();
            axios.post("{{ route('auth.authenticate') }}", {
                    email: $('#email').val(),
                    password: $('#password').val(),
                }).then(function(response) {
                    // console.log(response);
                    seeting_toastr()
                    toastr.success(response.data.message);
                    window.setTimeout(function() {
                        window.location.href = '/dashboard'
                    }, 1000)
                })
                .catch(function(error) {
                    // console.log(error);
                    if (error.response.status == 422) {
                        var object = error.response.data.errors;
                        for (const key in object) {
                            var message = object[key][0]
                            break;
                        }
                        seeting_toastr()
                        toastr.error(message);
                    } else {
                        seeting_toastr()
                        toastr.error(error.response.data.message);
                    }
                });
        });

        function seeting_toastr() {
            toastr.options = {
                "closeButton": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "100",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1500",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "slideDown",
                "hideMethod": "fadeOut",
                "rtl": true
            }
        }
    </script>
</body>
</html>
o