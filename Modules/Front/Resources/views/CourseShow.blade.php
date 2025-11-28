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
                            <li><a href="/" title="Home">Home</a></li>
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
                            Discount
                        </div>
                        @auth()
                            @if(auth()->id() == $course->teacher_id)
                                <p class="mycourse ">You are the instructor of this course</p>
                            @elseif(auth()->user()->hasAccessToCourse($course))
                                <p class="mycourse">You have purchased this course</p>
                            @else
                                <div class="sell_course">
                                    <strong>Price :</strong>
                                    @if($course->global_discount())
                                        <del class="discount-Price">{{number_format($course->getPrice())}}</del>
                                    @endif
                                    <p class="price">
                        <span class="woocommerce-Price-amount amount">{{number_format($course->FinalPrice())}}
                            <span class="woocommerce-Price-currencySymbol">$</span>
                        </span>
                                    </p>
                                </div>
                                <a href="{{route('discounterPage.show' , $course->id)}}" class="btn buy " style="color: #f0e68c">Buy Course</a>
                            @endif
                        @else
                            <div class="sell_course">
                                <strong>Price :</strong>
                                @if($course->global_discount())
                                    <del class="discount-Price">{{number_format($course->getPrice())}}</del>
                                @endif
                                <p class="price">
                        <span class="woocommerce-Price-amount amount">{{number_format($course->FinalPrice())}}
                            <span class="woocommerce-Price-currencySymbol">$</span>
                        </span>
                                </p>
                            </div>

                            <a href="{{route('login')}}" class="btn buy"  style="color: #f0e68c">Login to Account</a>
                        @endauth
                        {{--                        <div class="average-rating-sidebar">--}}
                        {{--                            <div class="rating-stars">--}}
                        {{--                                <div class="slider-rating">--}}
                        {{--                                    <span class="slider-rating-span slider-rating-span-100" data-value="100%"--}}
                        {{--                                          data-title="Very Good"></span>--}}
                        {{--                                    <span class="slider-rating-span slider-rating-span-80" data-value="80%"--}}
                        {{--                                          data-title="Good"></span>--}}
                        {{--                                    <span class="slider-rating-span slider-rating-span-60" data-value="60%"--}}
                        {{--                                          data-title="Average"></span>--}}
                        {{--                                    <span class="slider-rating-span slider-rating-span-40" data-value="40%"--}}
                        {{--                                          data-title="Bad"></span>--}}
                        {{--                                    <span class="slider-rating-span slider-rating-span-20" data-value="20%"--}}
                        {{--                                          data-title="Very Bad"></span>--}}
                        {{--                                    <div class="star-fill"></div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="average-rating-number">--}}
                        {{--                                <span class="title-rate title-rate1">Rating</span>--}}
                        {{--                                <div class="schema-stars">--}}
                        {{--                                    <span class="value-rate text-message"> 4 </span>--}}
                        {{--                                    <span class="title-rate">out of</span>--}}
                        {{--                                    <span class="value-rate"> 555 </span>--}}
                        {{--                                    <span class="title-rate">votes</span>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="product-info-box">
                        <div class="product-meta-info-list">
                            <div class="total_sales">
                                Students: <span>{{ count($course->student) }}</span>
                            </div>
                            <div class="meta-info-unit one">
                                <span class="title">Number of Published Sessions:  </span>
                                <span class="value">{{$course->lessonsCount()}}</span>
                            </div>
                            <div class="meta-info-unit three">
                                <span class="title">Total Course Duration: </span>
                                <span class="value">{{$course->formattedTime()}}</span>
                            </div>
                            <div class="meta-info-unit four">
                                <span class="title">Instructor: </span>
                                <span class="value">{{$course->teacher->name}}</span>
                            </div>
                            <div class="meta-info-unit five">
                                <span class="title">Course Status: </span>
                                <span class="value">@lang($course->status)</span>
                            </div>
                            <div class="meta-info-unit six">
                                <span class="title">Support: </span>
                                <span class="value">Available</span>
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
                                <span class="job-title"> Site Instructor </span>
                            </div>
                        </div>
                        <div class="job-content">
                            <!--                        <p>Love programming</p>-->
                        </div>
                    </div>
                    <div class="short-link">
                        <div class="">
                            <span>Short Link</span>
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
                    <a href=" @can('download' , $lessonVideo){{$lessonVideo->downloadLink()}}@endcan" class="episode-download ">Download this episode (Episode {{$lessonVideo->number}})</a>
                @endif

                <div class="course-description">
                    <div class="course-description-title">Course Description</div>
                    <div>
                        {!! $course->description !!}
                    </div>
                    {{--                    <div class="tags">--}}
                    {{--                        <ul>--}}
                    {{--                            <li><a href="">React</a></li>--}}
                    {{--                            <li><a href="">reactjs</a></li>--}}
                    {{--                            <li><a href="">JavaScript</a></li>--}}
                    {{--                            <li><a href="">javascript</a></li>--}}
                    {{--                            <li><a href="">What is reactjs</a></li>--}}
                    {{--                        </ul>--}}
                    {{--                    </div>--}}
                </div>
                <div class="episodes-list">
                    <div class="episodes-list--title">Episode List</div>
                    @include('front::layouts.seasons')
                </div>
            </div>
        </div>
        @include('front::comments.index' , ['commentable' => $course])
    </div>
@endsection
