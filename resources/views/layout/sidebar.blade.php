<!-- =========================
             RIGHT SIDEBAR
        ============================== -->
<div class="col-md-6 hidden-sm hidden-xs">
    <aside class="right-sidebar">
        <!-- Widget Start -->
        <div class="widget-popular-article">
            <h5>{{ trans('view.great').trans('view.article') }}</h5>
            @foreach ($popular_article as $item)
            <div class="popular-article clearfix">
                <div class="article-link">
                    <a href="{{ url('article/'.$item->id.'/show') }}">{{ $item->title }}</a>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Widget End -->

        <hr class="small">

        <!-- Widget Start -->
        {{--<div class="widget-readers-job-board">--}}
            {{--<h5>Reader's Job Board</h5>--}}
            {{--<p><a href="#">Apple needs an experienced UX Designer</a> - Anywhere/NY</p>--}}
            {{--<p><a href="#">Focus Lab is searching for a Frontend Developer</a> - Anywhere/NY</p>--}}
            {{--<p><a href="#">UX Designer needed in Google</a> - Anywhere/NY</p>--}}
            {{--<div><a href="#" class="btn btn-fullwd btn-prime">View All Jobs</a></div>--}}
        {{--</div> <!-- end of .readers-job-board -->--}}
        <!-- Widget End -->

        {{--<hr class="small">--}}

        {{--<!-- Widget Start -->--}}
        {{--<div class="widget-photo-gallery">--}}
            {{--<h5>Photo Gallery</h5>--}}
            {{--<div class="photo-gallery clearfix">--}}
                {{--<div class="item"><img src="{{ asset('assets/images/gallery/1.jpg') }}" alt=""></div>--}}
                {{--<div class="item"><img src="{{ asset('assets/images/gallery/2.jpg') }}" alt=""></div>--}}
                {{--<div class="item"><img src="{{ asset('assets/images/gallery/3.jpg') }}" alt=""></div>--}}
                {{--<div class="item"><img src="{{ asset('assets/images/gallery/4.jpg') }}" alt=""></div>--}}
                {{--<div class="item"><img src="{{ asset('assets/images/gallery/5.jpg') }}" alt=""></div>--}}
                {{--<div class="item"><img src="{{ asset('assets/images/gallery/6.jpg') }}" alt=""></div>--}}
                {{--<div class="item"><img src="{{ asset('assets/images/gallery/7.jpg') }}" alt=""></div>--}}
                {{--<div class="item"><img src="{{ asset('assets/images/gallery/8.jpg') }}" alt=""></div>--}}
                {{--<div class="item"><img src="{{ asset('assets/images/gallery/9.jpg') }}" alt=""></div>--}}
            {{--</div>--}}
        {{--</div> <!-- end of .widget-photo-gallery -->--}}
        {{--<!-- Widget End -->--}}

        {{--<hr class="small">--}}

        {{--<!-- Widget Start -->--}}
        {{--<div class="widget-subscribe">--}}
            {{--<h5>Subscribe to us</h5>--}}
            {{--<p>Subscribe to our email newsletter for useful tips and resources.</p>--}}
            {{--<!-- Form -->--}}
            {{--<form class="subscriber-box navbar-form navbar-left" role="search">--}}
                {{--<div class="input-group">--}}
                    {{--<input type="text" class="form-control" placeholder="you@domain.com">--}}
                    {{--<span class="input-group-btn">--}}
                                {{--<button class="btn btn-default btn-prime" type="button">Go</button>--}}
                            {{--</span>--}}
                {{--</div><!-- /input-group -->--}}
            {{--</form>--}}

            {{--<div class="social-icons clearfix">--}}
                {{--<p>Social: </p>--}}
                {{--<ul>--}}
                    {{--<li><a href=""><i class="fa flaticon-circle6"></i></a></li>--}}
                    {{--<li><a href=""><i class="fa flaticon-twitter4"></i></a></li>--}}
                    {{--<li><a href=""><i class="fa flaticon-google7"></i></a></li>--}}
                    {{--<li><a href=""><i class="fa flaticon-pinterest1"></i></a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div> <!-- end of .widget-subscribe -->--}}
        {{--<!-- Widget End -->--}}

        {{--<hr class="small">--}}

        {{--<div class="widget-ads">--}}
            {{--<h5>Advertisements</h5>--}}
            {{--<figure>--}}
                {{--<img src="{{ asset('assets/images/featured/ad-1.jpg') }}" alt="" class="img-responsive">--}}
                {{--<figcaption><a href="#">Advertising Tagline</a></figcaption>--}}
            {{--</figure>--}}

            {{--<figure>--}}
                {{--<img src="{{ asset('assets/images/featured/ad-2.jpg') }}" alt="" class="img-responsive">--}}
                {{--<figcaption><a href="#">Advertising Tagline 2</a></figcaption>--}}
            {{--</figure>--}}
        {{--</div> <!-- end of .widget-ads -->--}}


    </aside>
</div>
<!-- /END RIGHT SIDEBAR -->