<style>
    body {
        font-family: 'Arial', sans-serif;
        background: #f4f5f7;
        color: #333;
        margin: 0;
        padding: 0;
    }

    /* --- Course Card --- */
    .col {
        width: 300px;
        margin: 20px;
        display: inline-block;
        vertical-align: top;
    }

    .col a {
        text-decoration: none;
        color: inherit;
    }

    .card {
        background: #fff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .card-img img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
    }

    .course-status {
        position: absolute;
        top: 15px;
        left: 15px;
        background: #ff6b6b;
        color: #fff;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .discountBadge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: #1e90ff;
        color: #fff;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .card-title h2 {
        font-size: 18px;
        margin: 15px;
        color: #222;
    }

    .card-body {
        display: flex;
        align-items: center;
        margin: 0 15px 15px 15px;
    }

    .card-body img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
    }

    .card-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0 15px 15px 15px;
        font-size: 14px;
        color: #555;
    }

    .card-details .price {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .discountPrice {
        text-decoration: line-through;
        color: #999;
    }

    .endPrice {
        font-weight: bold;
        color: #fff;
    }

    /* --- Features Section --- */
    .features {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 30px;
        padding: 50px 20px;
    }

    .feature-box {
        background: #fff;
        border-radius: 15px;
        padding: 30px 20px;
        text-align: center;
        width: 250px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s;
    }

    .feature-box:hover {
        transform: translateY(-8px);
    }

    .feature-box h3 {
        margin-bottom: 15px;
        font-size: 18px;
    }

    .feature-box p {
        font-size: 14px;
        color: #666;
    }

    /* --- Stats Section --- */
    .stats {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 30px;
        padding: 50px 20px;
    }

    .stat-box {
        background: #1e90ff;
        color: #fff;
        border-radius: 15px;
        width: 200px;
        padding: 30px 20px;
        text-align: center;
        transition: transform 0.3s;
    }

    .stat-box:hover {
        transform: translateY(-8px);
    }

    .stat-box h2 {
        font-size: 36px;
        margin: 0;
    }

    .stat-box p {
        margin: 5px 0 0;
        font-size: 16px;
    }

    </style>





@foreach($latestCourses as $coursesItem)
    <!-- --- Course Card Example --- -->
    <div class="col">
        <a href="{{$coursesItem->path()}}">
            <div class="card">
                <div class="course-status">{{$coursesItem->status}}</div>
                @if($coursesItem->global_discount())
                    <div class="discountBadge">{{$coursesItem->discountPercent()}}% Off</div>
                @endif
                <div class="card-img">
                    <img src="{{$coursesItem->banner?->thumb}}" alt="{{$coursesItem->title}}">
                </div>
                <div class="card-title">
                    <h2>{{$coursesItem->title}}</h2>
                </div>
                <div class="card-body">
                    <img src="{{$coursesItem->teacher->thumb}}" alt="{{$coursesItem->teacher->name}}">
                    <span>{{$coursesItem->teacher->name}}</span>
                </div>
                <div class="card-details">
                    <div class="time">{{$coursesItem->formattedTime()}}</div>
                    <div class="price">
                        @if($coursesItem->global_discount())
                            <div class="discountPrice">${{number_format($coursesItem->getPrice())}}</div>
                        @endif
                        <div class="endPrice">${{number_format($coursesItem->FinalPrice())}}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>


@endforeach

<!-- --- Our Advantages Section --- -->



