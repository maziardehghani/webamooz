@foreach($lessons as $lesson)
    <div class="episodes-list-section">
        <div class="episodes-list-item @cannot('download' , $lesson) lock @endcannot">
            <div class="section-right">
                <span class="episodes-list-number">{{$lesson->number}}</span>
                <div class="episodes-list-title">
                    <a href="{{$lesson->path()}}">{{$lesson->title}}</a>
                </div>
            </div>
            <div class="section-left">
                <div class="episodes-list-details">
                    <div class="episodes-list-details">
                        <span class="detail-type">{{$lesson->is_free()?'رایگان':''}}</span>
                        <span class="detail-time">{{$lesson->time}} دقیقه</span>
                        <i class="icon-download"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endforeach


