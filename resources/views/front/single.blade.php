@extends('front.layouts.master')

@section('content')
    <div class="sigle_post">
        <div class="post_details">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="title text-center">
                            <div class="sub_date">
                                <span
                                    style="display: block;font-size: 26px;">{{ $post->created_at->format('d') }}</span><span>{{ $post->created_at->format('m-Y') }}</span>
                            </div>
                            <div class="sub_title">
                                <h1>{{ Str::limit($post->name, 100, '...') }}</h1>
                                <h6>{{ Str::limit($post->description, 100, '...') }}</h6>
                            </div>
                            <div class="sub_views"><i class="fas fa-eye"></i><span>{{ $post->view_count }} </span></div>
                        </div>

                        <div class="content">
                            <!-- AddToAny BEGIN -->
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style share">
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_facebook_messenger"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_telegram"></a>
                                <a class="a2a_button_whatsapp"></a>
                                <a class="a2a_button_snapchat"></a>
                                <a class="a2a_button_google_gmail"></a>
                                <a class="a2a_button_skype"></a>
                                <a class="a2a_button_copy_link"></a>
                            </div>
                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                            <!-- AddToAny END -->
                            <p>
                                {!! $post->content !!}
                            </p>
                        </div>

                        {{-- <div class="related_work">
                            <div class="title_top">
                                <h3><i class="fa fa-hashtag"></i> Related to the article</h3>
                            </div>
                            <div class="owl-carousel owl-theme">
                                <div class="item">
                                    <a href=""><img class="slideImg" src="images/6.jpg" alt=""></a>
                                    <div class="title">
                                        <a href="">Carousels don’t automatically normalize slide dimensions.</a>
                                    </div>
                                </div>
                                <div class="item">
                                    <a href=""><img class="slideImg" src="images/6.jpg" alt=""></a>
                                    <div class="title">
                                        <a href="">Carousels don’t automatically normalize slide dimensions.</a>
                                    </div>
                                </div>
                                <div class="item">
                                    <a href=""><img class="slideImg" src="images/6.jpg" alt=""></a>
                                    <div class="title">
                                        <a href="">Carousels don’t automatically normalize slide dimensions.</a>
                                    </div>
                                </div>
                                <div class="item">
                                    <a href=""><img class="slideImg" src="images/6.jpg" alt=""></a>
                                    <div class="title">
                                        <a href="">Carousels don’t automatically normalize slide dimensions.</a>
                                    </div>
                                </div>

                            </div>
                        </div> --}}

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
