<div class="col">
    <a href="{{$coursesItem->path()}}">
        <div class="course-status">
            @lang($coursesItem->status)
        </div>
        <div class="discountBadge">
            <p>45%</p>
            تخفیف
        </div>
        <div class="card-img"><img src="{{$coursesItem->banner->thumb}}" alt="{{$coursesItem->title}}"></div>
        <div class="card-title"><h2>{{$coursesItem->title}}</h2></div>
        <div class="card-body">
            <img src="{{$coursesItem->teacher->thumb}}" alt="{{$coursesItem->teacher->name}}">
            <span>{{$coursesItem->teacher->name}}</span>
        </div>
        <div class="card-details">
            <div class="time">{{$coursesItem->formattedTime()}}</div>
            <div class="price">
                <div class="discountPrice">50000</div>
                <div class="endPrice">{{$coursesItem->formattedPrice()}}</div>
            </div>
        </div>
    </a>
</div>
