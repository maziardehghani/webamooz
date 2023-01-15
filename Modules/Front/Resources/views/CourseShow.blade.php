@extends('front::layouts.master')
@section('content')
    <div class="content">
        <div class="container">
            <article class="article">
             @include('front::layouts.adds')
                <div class="h-t">
                    <h1 class="title">{{$course->title}}</h1>
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="/" title="خانه">خانه</a></li>
                            @if($course->category->parentCategory)
                                <li>
                                    <a href="{{$course->category->parentCategory->path()}}"
                                       title="{{$course->category->parentCategory->title}}">
                                        {{$course->category->parentCategory->title}}
                                    </a>
                                </li>
                            @endif
                            <li><a href="{{$course->category->path()}}" title="{{$course->category->title}}">{{$course->category->title}}</a></li>
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
                                    @if($course->courseHasDiscountForEveryOne())
                                    <del class="discount-Price">{{number_format($course->getPrice())}}</del>
                                    @endif
                                    <p class="price">
                        <span class="woocommerce-Price-amount amount">{{number_format($course->FinalPrice())}}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                    </p>
                                </div>
                                <button class="btn buy btn-buy">خرید دوره</button>
                            @endif
                        @else
                            <div class="sell_course">
                                <strong>قیمت :</strong>
                                <del class="discount-Price">{{number_format($course->getPrice())}}</del>
                                <p class="price">
                        <span class="woocommerce-Price-amount amount">{{number_format($course->FinalPrice())}}
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                                </p>
                            </div>
                            <p class="wrongAccessToCourse">شما هنوز به حساب کاربری خود وارد نشده اید</p>

                            <a href="{{route('login')}}" class="btn buy">ورود به حساب </a>
                        @endauth
                        <div class="average-rating-sidebar">
                            <div class="rating-stars">
                                <div class="slider-rating">
                                    <span class="slider-rating-span slider-rating-span-100" data-value="100%"
                                          data-title="خیلی خوب"></span>
                                    <span class="slider-rating-span slider-rating-span-80" data-value="80%"
                                          data-title="خوب"></span>
                                    <span class="slider-rating-span slider-rating-span-60" data-value="60%"
                                          data-title="معمولی"></span>
                                    <span class="slider-rating-span slider-rating-span-40" data-value="40%"
                                          data-title="بد"></span>
                                    <span class="slider-rating-span slider-rating-span-20" data-value="20%"
                                          data-title="خیلی بد"></span>
                                    <div class="star-fill"></div>
                                </div>
                            </div>
                            <div class="average-rating-number">
                                <span class="title-rate title-rate1">امتیاز</span>
                                <div class="schema-stars">
                                    <span class="value-rate text-message"> 4 </span>
                                    <span class="title-rate">از</span>
                                    <span class="value-rate"> 555 </span>
                                    <span class="title-rate">رأی</span>
                                </div>
                            </div>
                        </div>
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
                            <a href="{{route('Tutor.show' , $course->teacher->username)}}"><img alt="{{$course->teacher->name}}" class="img-fluid lazyloaded" src="{{$course->teacher->thumb}}" loading="lazy">
                                <noscript>
                                    <img class="img-fluid" src="{{$course->teacher->thumb}}" alt="{{$course->teacher->name}}"></noscript>
                            </a>
                            <div class="name">
                                <a href="{{route('Tutor.show' , $course->teacher->username)}}" class="btn-link"><h6>{{$course->teacher->name}}</h6>
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
                    @if($lessonVideo->media->type == 'video')
                    <div class="preview">
                        <video width="100%" controls="">
                            <source  src="@can('download' , $lessonVideo){{ $lessonVideo ->downloadLink()}}@endcan" type="video/mp4">
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
                    <div class="tags">
                        <ul>
                            <li><a href="">ری اکت</a></li>
                            <li><a href="">reactjs</a></li>
                            <li><a href="">جاوااسکریپت</a></li>
                            <li><a href="">javascript</a></li>
                            <li><a href="">reactjs چیست</a></li>
                        </ul>
                    </div>
                </div>
                <div class="episodes-list">
                    <div class="episodes-list--title">فهرست جلسات</div>
                    @include('front::layouts.lessons')
                </div>
            </div>
        </div>
        <div class="container">
            <div class="comments">
                <div class="comment-main">
                    <div class="ct-header">
                        <h3>نظرات ( 180 )</h3>
                        <p>نظر خود را در مورد این مقاله مطرح کنید</p>
                    </div>
                    <form action="" method="post">
                        <div class="ct-row">
                            <div class="ct-textarea">
                                <textarea class="txt ct-textarea-field"></textarea>
                            </div>
                        </div>
                        <div class="ct-row">
                            <div class="send-comment">
                                <button class="btn i-t">ثبت نظر</button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="comments-list">
                    <div id="Modal2" class="modal">
                        <div class="modal-content" style="width: 1000px;">
                            <div class="modal-header">
                                <p>ارسال پاسخ</p>
                                <div class="close">×</div>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="">
                                    <textarea class="txt hi-220px" placeholder="متن دیدگاه"></textarea>
                                    <button class="btn i-t">ثبت پاسخ</button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <ul class="comment-list-ul">
                        <div class="div-btn-answer">
                            <button class="btn-answer">پاسخ به دیدگاه</button>
                        </div>
                        <li class="is-comment">
                            <div class="comment-header">
                                <div class="comment-header-avatar">
                                    <img src="img/profile.jpg">
                                </div>
                                <div class="comment-header-detail">
                                    <div class="comment-header-name">کاربر : گوگل گوگل گوگل گوگل</div>
                                    <div class="comment-header-date">10 روز پیش</div>
                                </div>
                            </div>
                            <div class="comment-content">
                                <p>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                    برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی
                                    می باشد.
                                </p>
                            </div>
                        </li>
                        <li class="is-answer">
                            <div class="comment-header">
                                <div class="comment-header-avatar">
                                    <img src="img/laravel-pic.png">
                                </div>
                                <div class="comment-header-detail">
                                    <div class="comment-header-name">مدیر سایت : محمد نیکو</div>
                                    <div class="comment-header-date">10 روز پیش</div>
                                </div>
                            </div>
                            <div class="comment-content">
                                <p>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                    برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی
                                    می باشد.
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                    برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی
                                    می باشد.
                                </p>
                            </div>
                        </li>
                        <li class="is-comment">
                            <div class="comment-header">
                                <div class="comment-header-avatar">
                                    <img src="img/profile.jpg">
                                </div>
                                <div class="comment-header-detail">
                                    <div class="comment-header-name">کاربر : گوگل</div>
                                    <div class="comment-header-date">10 روز پیش</div>
                                </div>
                            </div>
                            <div class="comment-content">
                                <p>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                    برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی
                                    می باشد.
                                </p>
                            </div>
                        </li>

                    </ul>
                    <ul class="comment-list-ul">
                        <div class="div-btn-answer">
                            <button class="btn-answer">پاسخ به دیدگاه</button>
                        </div>
                        <li class="is-comment">
                            <div class="comment-header">
                                <div class="comment-header-avatar">
                                    <img src="img/profile.jpg">
                                </div>
                                <div class="comment-header-detail">
                                    <div class="comment-header-name">کاربر : گوگل</div>
                                    <div class="comment-header-date">10 روز پیش</div>
                                </div>
                            </div>
                            <div class="comment-content">
                                <p>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                    برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی
                                    می باشد.
                                </p>
                            </div>
                        </li>
                        <li class="is-answer">
                            <div class="comment-header">
                                <div class="comment-header-avatar">
                                    <img src="img/laravel-pic.png">
                                </div>
                                <div class="comment-header-detail">
                                    <div class="comment-header-name">مدیر سایت : محمد نیکو</div>
                                    <div class="comment-header-date">10 روز پیش</div>
                                </div>
                            </div>
                            <div class="comment-content">
                                <p>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                    برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی
                                    می باشد.
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                    برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی
                                    می باشد.
                                </p>
                            </div>
                        </li>

                    </ul>


                </div>
            </div>
        </div>
        <div id="Modal-buy" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <p>کد تخفیف را وارد کنید</p>
                    <div class="close">&times;</div>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('dashboard.courses.buy' , $course->id)}}">
                        @csrf
                        <table class="table text-center table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>قیمت کل دوره</th>
                                <td> {{number_format($course->getPrice())}}تومان</td>
                            </tr>
                            <tr>
                                <th>درصد تخفیف</th>
                                <td><span id="discountPercent" data-value="{{$course->discountPercent()}}">{{$course->discountPercent()}}</span>%</td>
                            </tr>
                            <tr>
                                <th> مبلغ تخفیف</th>
                                <td class="text-red"><span
                                        id="discountAmount" data-value="{{$course->discountAmount()}}">{{$course->discountAmount()}}</span> تومان
                                </td>
                            </tr>
                            <tr>
                                <th> قابل پرداخت</th>
                                <td class="text-blue"><span
                                        id="payableAmount" data-value="{{$course->FinalPrice()}}">{{$course->FinalPrice()}}</span> تومان
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn i-t ">پرداخت آنلاین</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

