@extends('front::layouts.master')
@section('content')
    <main id="index">
        <div class="bt-0-top article mr-202"></div>
        <div class="bt-1-top">
            <div class="container">
                <div class="tutor">
                    <div class="tutor-item">
                        <div class="tutor-avatar">
                            <span class="tutor-image" id="tutor-image"><img src="{{$teacher->thumb}}" class="tutor-avatar-img"></span>
                            <div class="tutor-author-name">
                                <a id="tutor-author-name" href="" title="{{$teacher->name}}">
                                    <h3 class="title"><span class="tutor-author--name">{{$teacher->name}}</span></h3>
                                </a>
                            </div>
                            <div id="Modal1" class="modal">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="close">&times;</div>
                                    </div>
                                    <div class="modal-body">
                                        <img class="tutor--avatar--img" src="" alt="">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tutor-item">
                        <div class="stat">
                            <span class="tutor-number tutor-count-courses">{{count($teacher->course)}} </span>
                            <span class="">تعداد دوره ها</span>
                        </div>
                        <div class="stat">

                            <span class="tutor-number">{{$teacher->studentCount()}} </span>
                            <span class="">تعداد  دانشجویان</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="box-filter">
                <div class="b-head">
                    <h2>دوره های محمد نیکو</h2>
                </div>
                <div class="posts">
                    <div class="col">
                        <a href="react.html">
                            <div class="course-status">
                                تکمیل شده
                            </div>
                            <div class="discountBadge">
                                <p>45%</p>
                                تخفیف
                            </div>
                            <div class="card-img"><img src="img/banner/reactjs.png" alt="reactjs"></div>
                            <div class="card-title"><h2>دوره مقدماتی تا پیشرفته reactJs</h2></div>
                            <div class="card-body">
                                <img src="img/profile.png" alt="محمد نیکو">
                                <span>محمد نیکو</span>
                            </div>
                            <div class="card-details">
                                <div class="time">135:40:00</div>
                                <div class="price">
                                    <div class="discountPrice">159,000</div>
                                    <div class="endPrice">270,000</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="laravel1.html">
                            <div class="discountBadge">
                                <p>45%</p>
                                تخفیف
                            </div>
                            <div class="card-img"><img src="img/banner/php.png" alt="php"></div>
                            <div class="card-title"><h2>دوره متخصص php بخش مقدماتی</h2></div>
                            <div class="card-body">
                                <img src="img/profile.png" alt="محمد نیکو">
                                <span>محمد نیکو</span>
                            </div>
                            <div class="card-details">
                                <div class="time">135:40:00</div>
                                <div class="price">
                                    <div class="discountPrice">159,000</div>
                                    <div class="endPrice">270,000</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="php.html">
                            <div class="discountBadge">
                                <p>45%</p>
                                تخفیف
                            </div>
                            <div class="card-img"><img src="img/banner/lara.png" alt="laravel"></div>
                            <div class="card-title"><h2>دوره ساخت پیام رسان تحت وب مشابه Telegram با Laravel و ReactJs و
                                    WebSocket به صورت Spa</h2></div>
                            <div class="card-body">
                                <img src="img/profile.png" alt="محمد نیکو">
                                <span>محمد نیکو</span>
                            </div>
                            <div class="card-details">
                                <div class="time">135:40:00</div>
                                <div class="price">
                                    <div class="discountPrice">159,000</div>
                                    <div class="endPrice">270,000</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="angular.html">
                            <div class="discountBadge d-none">
                                <p>45%</p>
                                تخفیف
                            </div>
                            <div class="card-img"><img src="img/banner/angularjs.jpg" alt="reactjs"></div>
                            <div class="card-title"><h2>دوره مقدمات تا پیشرفته انگولار به همراه پروژه فروشگاهی</h2></div>
                            <div class="card-body">
                                <img src="img/profile.png" alt="محمد نیکو">
                                <span>محمد نیکو</span>
                            </div>
                            <div class="card-details">
                                <div class="time">135:40:00</div>
                                <div class="price">
                                    <div class="discountPrice">159,000</div>
                                    <div class="endPrice">270,000</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col">
                        <a href="react.html">
                            <div class="course-status">
                                تکمیل شده
                            </div>
                            <div class="discountBadge">
                                <p>45%</p>
                                تخفیف
                            </div>
                            <div class="card-img"><img src="img/banner/restfull-lara.jpg" alt="reactjs"></div>
                            <div class="card-title"><h2>دوره تولید و توسعه وب سرویس با </h2></div>
                            <div class="card-body">
                                <img src="img/profile.png" alt="محمد نیکو">
                                <span>محمد نیکو</span>
                            </div>
                            <div class="card-details">
                                <div class="time">135:40:00</div>
                                <div class="price">
                                    <div class="discountPrice">159,000</div>
                                    <div class="endPrice">270,000</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            <div class="pagination">
                <a href="" class="pg-prev"></a>
                <a href="" class="page current">1</a>
                <a href="" class="page ">2</a>
                <a href="" class="page ">3</a>
                <a href="" class="page ">4</a>
                <a href="" class="page ">5</a>
                <a href="" class="page ">6</a>
                <a href="" class="page ">7</a>
                <a href="" class="page ">...</a>
                <a href="" class="page ">100</a>
                <a href="" class="pg-next"></a>
            </div>
        </div>
    </main>
@endsection
