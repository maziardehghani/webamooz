<div class="col">
    <a href="{{$coursesItem->path()}}">
        <div class="course-status">
            @lang($coursesItem->status) <!-- The status of the course is displayed in the language set by the system -->
        </div>
        @if($coursesItem->global_discount())
            <div class="discountBadge">
                <p>{{$coursesItem->discountPercent()}}%</p>
                discount <!-- Display the discount percentage if applicable -->
            </div>
        @endif
        <div class="card-img">
            <img src="{{$coursesItem->banner?->thumb}}" alt="{{$coursesItem->title}}"> <!-- Course banner image -->
        </div>
        <div class="card-title">
            <h2>{{$coursesItem->title}}</h2> <!-- Course title -->
        </div>
        <div class="card-body">
            <img src="{{$coursesItem->teacher->thumb}}" alt="{{$coursesItem->teacher->name}}"> <!-- Teacher's profile image -->
            <span>{{$coursesItem->teacher->name}}</span> <!-- Teacher's name -->
        </div>
        <div class="card-details">
            <div class="time">{{$coursesItem->formattedTime()}}</div> <!-- Course duration -->
            <div class="price">
                @if($coursesItem->global_discount())
                    <div class="discountPrice">{{number_format($coursesItem->getPrice())}}</div> <!-- Original price with discount -->
                @endif
                <div class="endPrice">${{number_format($coursesItem->FinalPrice())}}</div> <!-- Final price after discount -->
            </div>
        </div>
    </a>
</div>
