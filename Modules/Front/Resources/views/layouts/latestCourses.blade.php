<div class="col">
    <a href="{{$coursesItem->path()}}">
        <div class="course-status">
            @lang($coursesItem->status)
        </div>
        @if($coursesItem->courseHasDiscountForEveryOne())
        <div class="discountBadge">
            <p>{{$coursesItem->discountPercent()}}%</p>
            تخفیف
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
                @if($coursesItem->courseHasDiscountForEveryOne())
                <div class="discountPrice">{{number_format($coursesItem->getPrice())}}</div>
                @endif
                <div class="endPrice">{{number_format($coursesItem->FinalPrice())}}</div>
            </div>
        </div>
    </a>
</div>
