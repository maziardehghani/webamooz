@extends('front::layouts.master')
@section('content')
    <div class="content">
        <div class="container">
            <article class="article">
{{--             @include('front::layouts.adds')--}}
                <div class="h-t">
                    <h1 class="title">{{$course->title}}</h1>
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="/" title="خانه">خانه</a></li>
                            @if($course->category?->parentCategory)
                                <li>
                                    <a href="{{$course->category?->parentCategory->path()}}"
                                       title="{{$course->category?->parentCategory->title}}">
                                        {{$course->category?->parentCategory->title}}
                                    </a>
                                </li>
                            @endif
                            <li><a href="{{$course->category?->path()}}" title="{{$course->category?->title}}">{{$course->category?->title}}</a></li>
                        </ul>
                    </div>
                </div>

            </article>
        </div>
        <div class="main-row container">
            <div class="sidebar-right">
                <div class="sidebar-sticky" style="top: 104px;">
                    <div class="product-info-box">
                        <div class="discountBadge d-none">
                            <p>{{$course->discountPercent()}}%</p>
                            تخفیف
                        </div>
                        @auth()
                            @if(auth()->id() == $course->teacher_id)
                                <p class="mycourse ">شما مدرس این دوره هستید</p>
                            @elseif(auth()->user()->hasAccessToCourse($course))
                                <p class="mycourse">شما این دوره رو خریداری کرده اید</p>
                            @else
                                <div class="sell_course">
                                    <strong>قیمت :</strong>
                                    @if($course->global_discount())
                                    <del class="discount-Price">{{number_format($course->getPrice())}}</del>
                                    @endif
                                    <p class="price">
                        <span class="woocommerce-Price-amount amount">{{number_format($course->FinalPrice())}}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                    </p>
                                </div>
                                <a href="{{route('discounterPage.show' , $course->id)}}" class="btn buy " style="color: #f0e68c">خرید دوره</a>
                            @endif
                        @else
                            <div class="sell_course">
                                <strong>قیمت :</strong>
                                @if($course->global_discount())
                                    <del class="discount-Price">{{number_format($course->getPrice())}}</del>
                                @endif
                                <p class="price">
                        <span class="woocommerce-Price-amount amount">{{number_format($course->FinalPrice())}}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                </p>
                            </div>

                            <a href="{{route('login')}}" class="btn buy"  style="color: #f0e68c">ورود به حساب </a>
                        @endauth
{{--                        <div class="average-rating-sidebar">--}}
{{--                            <div class="rating-stars">--}}
{{--                                <div class="slider-rating">--}}
{{--                                    <span class="slider-rating-span slider-rating-span-100" data-value="100%"--}}
{{--                                          data-title="خیلی خوب"></span>--}}
{{--                                    <span class="slider-rating-span slider-rating-span-80" data-value="80%"--}}
{{--                                          data-title="خوب"></span>--}}
{{--                                    <span class="slider-rating-span slider-rating-span-60" data-value="60%"--}}
{{--                                          data-title="معمولی"></span>--}}
{{--                                    <span class="slider-rating-span slider-rating-span-40" data-value="40%"--}}
{{--                                          data-title="بد"></span>--}}
{{--                                    <span class="slider-rating-span slider-rating-span-20" data-value="20%"--}}
{{--                                          data-title="خیلی بد"></span>--}}
{{--                                    <div class="star-fill"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="average-rating-number">--}}
{{--                                <span class="title-rate title-rate1">امتیاز</span>--}}
{{--                                <div class="schema-stars">--}}
{{--                                    <span class="value-rate text-message"> 4 </span>--}}
{{--                                    <span class="title-rate">از</span>--}}
{{--                                    <span class="value-rate"> 555 </span>--}}
{{--                                    <span class="title-rate">رأی</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="product-info-box">
                        <div class="product-meta-info-list">
                            <div class="total_sales">
                                تعداد دانشجو : <span>{{ count($course->student) }}</span>
                            </div>
                            <div class="meta-info-unit one">
                                <span class="title">تعداد جلسات منتشر شده :  </span>
                                <span class="vlaue">{{$course->lessonsCount()}}</span>
                            </div>
                            <div class="meta-info-unit three">
                                <span class="title">مدت زمان کل دوره : </span>
                                <span class="vlaue">{{$course->formattedTime()}}</span>
                            </div>
                            <div class="meta-info-unit four">
                                <span class="title">مدرس دوره : </span>
                                <span class="vlaue">{{$course->teacher->name}}</span>
                            </div>
                            <div class="meta-info-unit five">
                                <span class="title">وضعیت دوره : </span>
                                <span class="vlaue">@lang($course->status)</span>
                            </div>
                            <div class="meta-info-unit six">
                                <span class="title">پشتیبانی : </span>
                                <span class="vlaue">دارد</span>
                            </div>
                        </div>
                    </div>
                    <div class="course-teacher-details">
                        <div class="top-part">
                            <a href="{{route('Tutor.show' , $course->teacher?->username)}}"><img alt="{{$course->teacher?->name}}" class="img-fluid lazyloaded" src="{{$course->teacher->thumb}}" loading="lazy">
                                <noscript>
                                    <img class="img-fluid" src="{{$course->teacher?->thumb}}" alt="{{$course->teacher?->name}}"></noscript>
                            </a>
                            <div class="name">
                                <a href="{{route('Tutor.show' , $course->teacher?->username)}}" class="btn-link"><h6>{{$course->teacher?->name}}</h6>
                                </a>
                                <span class="job-title"> مدرس سایت </span>
                            </div>
                        </div>
                        <div class="job-content">
                            <!--                        <p>عاشق برنامه نویسی</p>-->
                        </div>
                    </div>
                    <div class="short-link">
                        <div class="">
                            <span>لینک کوتاه</span>
                            <input class="short--link" value="{{$course->shortUrl()}}">
                            <a href="{{$course->shortUrl()}}" class="short-link-a" data-link="{{$course->shortUrl()}}"></a>
                        </div>
                    </div>
                    @include('front::layouts.sidebar_banner')

                </div>
            </div>
            <div class="content-left">
                @if($lessonVideo)
                    @if($lessonVideo->media?->type == 'video')
                        <div class="preview">
                        <video width="100%" controls="" poster="{{$course->thumb}}">
                            <source  src="@can('download' , $lessonVideo){{ $lessonVideo->downloadLink()}}@endcan" type="video/mp4">
                        </video>
                    </div>
                    @endif
                <a href=" @can('download' , $lessonVideo){{$lessonVideo->downloadLink()}}@endcan" class="episode-download ">دانلود این قسمت (قسمت {{$lessonVideo->number}})</a>
                @endif

                <div class="course-description">
                    <div class="course-description-title">توضیحات دوره</div>
                    <div>
                        {!! $course->description !!}
                    </div>
{{--                    <div class="tags">--}}
{{--                        <ul>--}}
{{--                            <li><a href="">ری اکت</a></li>--}}
{{--                            <li><a href="">reactjs</a></li>--}}
{{--                            <li><a href="">جاوااسکریپت</a></li>--}}
{{--                            <li><a href="">javascript</a></li>--}}
{{--                            <li><a href="">reactjs چیست</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                </div>
                <div class="episodes-list">
                    <div class="episodes-list--title">فهرست جلسات</div>
                    @include('front::layouts.seasons')
                </div>
            </div>
        </div>
        @include('front::comments.index' , ['commentable' => $course])
    </div>
@endsection

