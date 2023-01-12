<footer class="footer">
    <div class="container-fluid">
        <div class="row" style=" padding: 10px 0; ">
            <div class="col p-0 text-center">
                <nav class="navbar navbar-expand-lg p-0">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item"><a href="#">{{ __('front.council') }}</a></li>
                        <li class="nav-item"><a href="#">{{ __('front.responsibilities') }}</a>
                        </li>
                        <li class="nav-item"><a href="#">{{ __('front.contact') }}</a></li>
                        </li>
                        @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                            <li class="nav-item"><a href="/en">الإنجليزية</a>
                            </li>
                            </li>
                        @else
                            <li class="nav-item"><a href="/ar">Arabic</a></li>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
        <div class="row foo">
            <div class="col-md-6">
                <div class="copyright">
                    <p>جميع الحقوق محفوظة © 2022</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="social_icon text-end">
                    <a href="#" class="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="whatsapp" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#" class="youtube" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
