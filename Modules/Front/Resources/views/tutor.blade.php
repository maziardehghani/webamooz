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
                                    <h3 class="title"><span class="tutor-author--name">{{$teacher->username}}</span></h3>
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
                            <span class="">Number of Courses</span>
                        </div>
                        <div class="stat">

                            <span class="tutor-number">{{$teacher->studentCount()}} </span>
                            <span class="">Number of Students</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="box-filter">
                <div class="b-head">
                    <h2>Courses by {{$teacher->username}}</h2>
                </div>
                <div class="posts">
                    @foreach($teacherCourses as $coursesItem)
                        <div class="col">
                            <a href="{{$coursesItem->path()}}">
                                <div class="course-status">
                                    @lang($coursesItem->status)
                                </div>
                                @if($coursesItem->global_discount())
                                    <div class="discountBadge">
                                        <p>{{$coursesItem->discountPercent()}}%</p>
                                        Discount
                                    </div>
                                @endif
                                <div class="card-img"><img src="{{$coursesItem->banner->thumb}}" alt="{{$coursesItem->title}}"></div>
                                <div class="card-title"><h2>{{$coursesItem->title}}</h2></div>
                                <div class="card-body">
                                    <img src="{{$coursesItem->teacher->thumb}}" alt="{{$coursesItem->teacher->name}}">
                                    <span>{{$coursesItem->teacher->name}}</span>
                                </div>
                                <div class="card-details">
                                    <div class="time">{{$coursesItem->formattedTime()}}</div>
                                    <div class="price">
                                        @if($coursesItem->global_discount())
                                            <div class="discountPrice">{{number_format($coursesItem->getPrice())}}</div>
                                        @endif
                                        <div class="endPrice">{{number_format($coursesItem->FinalPrice())}}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
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
