@foreach($lessons as $lesson)
<div class="episodes-list-section">
    <div class="episodes-list-item ">
        <div class="section-right">
            <span class="episodes-list-number">۱</span>
            <div class="episodes-list-title">
                <a href="{{$lesson->path()}}">{{$lesson->title}}</a>
            </div>
        </div>
        <div class="section-left">
            <div class="episodes-list-details">
                <div class="episodes-list-details">
                    <span class="detail-type">{{$lesson->is_free()}}</span>
                    <span class="detail-time">44:44</span>
                    <a class="detail-download">
                        <i class="icon-download"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="episodes-list-item {{$course}}">
        <div class="section-right">
            <span class="episodes-list-number">3</span>
            <div class="episodes-list-title">
                <a href="#">اضافه کردن متد های جدید به router - از فصل اول بخش اخر</a>
            </div>
        </div>
        <div class="section-left">
            <div class="episodes-list-details">
                <div class="episodes-list-details">
                    <!--                                            <span class="detail-type">نقدی</span>-->
                    <span class="detail-time">44:44</span>
                    <a class="detail-download">
                        <i class="icon-download"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
