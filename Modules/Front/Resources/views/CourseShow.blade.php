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
                    <div class="product-info-box" dir="ltr">
                        <div class="product-meta-info-list">
                            <div class="total_sales">
                                Students: <span>{{ count($course->student) }}</span>
                            </div>
                            <div class="meta-info-unit one">
                                <span class="title ml-5">Number of Published Sessions:  </span>
                                <span class="value">{{$course->lessonsCount()}}</span>
                            </div>
                            <div class="meta-info-unit three">
                                <span class="title ml-5">Total Course Duration: </span>
                                <span class="value">{{$course->timeDuration()}} m</span>
                            </div>
                            <div class="meta-info-unit four">
                                <span class="title ml-5">Instructor: </span>
                                <span class="value">{{$course->teacher->name}}</span>
                            </div>
                            <div class="meta-info-unit five">
                                <span class="title ml-5">Course Status: </span>
                                <span class="value">@lang($course->status)</span>
                            </div>
                            <div class="meta-info-unit six">
                                <span class="title ml-5">Support: </span>
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

                <div class="preview">
                    <video width="100%" controls poster="{{$course->thumb}}">
                        <source  type="video/mp4">
                    </video>
                </div>
                <a href="#" class="episode-download">Download this episode (Episode 1)</a>

                <div class="course-description">
                    <div class="course-description-title">Course Description</div>

                    <p>
                        In this article, we will learn what ReactJS is and why we should use it instead of other JavaScript frameworks
                        such as Angular.
                    </p>

                    <p>
                        ReactJS is an open-source JavaScript library for building user interfaces, especially for
                        <a href="" target="_blank" rel="noopener nofollow">single-page applications</a>.
                        This library is mainly used for handling the View layer of web applications.
                        React also allows us to build reusable UI components.
                        React was originally created by Jordan Walke, a software engineer at Facebook.
                        It was first used in Facebook in 2011 and later adopted by Instagram in 2012.
                    </p>

                    <p>
                        React enables developers to build large-scale web applications that can update data without reloading
                        the page.
                        The main goals of React are simplicity, speed, and scalability.
                        React focuses only on the user interface and fits into the View layer of the MVC architecture.
                        This library can be used together with other JavaScript frameworks and libraries such as Angular.
                    </p>

                    <h2>What are the features of ReactJS?</h2>

                    <p>Let’s take a look at the most important features of React:</p>

                    <p><strong>JSX</strong></p>
                    <p>
                        In React, JSX is used for templating instead of plain JavaScript.
                        JSX is a JavaScript syntax extension that allows you to write HTML-like code inside JavaScript to create DOM components.
                    </p>

                    <p>
                        <img alt="JavaScript Tutorial" src="img/banner/lara.png">
                    </p>

                    <p><strong>React Native</strong></p>
                    <p>
                        React Native is a JavaScript framework for developing native mobile applications for both Android and iOS,
                        introduced in 2015.
                        It is based on JavaScript and the React library.
                        This means if you have mastered React, you will have a head start in learning React Native.
                        Note that there are important differences between React and React Native.
                        To understand these differences, we recommend reading
                        <a href="" target="_blank" rel="noopener nofollow">the main differences between React and React Native</a>.
                    </p>

                    <p><strong>Single-way data flow</strong></p>
                    <p>
                        In React, immutable values are passed between components as properties (props).
                        Components cannot directly modify these properties.
                        Instead, they can pass data to callback functions, which handle the changes.
                        This concept is known as:
                        “properties flow down; actions flow up”.
                    </p>

                    <p><strong>Virtual Document Object Model (DOM)</strong></p>
                    <p>
                        React creates an in-memory cache structure called Virtual DOM.
                        When a change occurs, React updates only the components that have changed instead of re-rendering the entire page.
                        The Virtual DOM is a tree structure similar to the real DOM, containing elements, attributes, and content as objects.
                        The render() method builds a tree of React components,
                        and when a component changes, the related node in the tree is updated.
                    </p>

                    <div class="tags">
                        <ul>
                            <li><a href="">React</a></li>
                            <li><a href="">reactjs</a></li>
                            <li><a href="">JavaScript</a></li>
                            <li><a href="">javascript</a></li>
                            <li><a href="">What is ReactJS</a></li>
                        </ul>
                    </div>
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
