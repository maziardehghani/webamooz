
<style>
    /* --- Stats Horizontal Bar --- */
.stats {
    margin-top: 20px;
    background: linear-gradient(135deg, #1e90ff, #3742fa);
    padding: 20px;
    border-radius: 14px;

    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;

    overflow-x: auto;        /* موبایل = اسکرول افقی */
    scrollbar-width: none;  /* Firefox */
}

.stats::-webkit-scrollbar {
    display: none;
}

/* هر آیتم نوار آمار */
.stat-box {
    min-width: 140px;
    flex: 0 0 auto;

    background: rgba(255,255,255,0.15);
    color: #fff;
    text-align: center;
    padding: 14px 10px;
    border-radius: 10px;

    backdrop-filter: blur(6px);
    transition: transform 0.25s ease, background 0.25s ease;
}

.stat-box:hover {
    transform: translateY(-4px);
    background: rgba(255,255,255,0.25);
}

/* شماره آمار */
.stat-box h2 {
    font-size: 22px;
    margin: 0 0 6px;
    font-weight: bold;
}

/* متن زیر عدد */
.stat-box p {
    font-size: 13px;
    margin: 0;
    opacity: 0.9;
}

    /* --- Banner Section --- */
    .top-banner {
        width: 100%;
        max-height: 500px;
        background: url('{{ $sliders[0]?->banner?->original }}') center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 40px;
    }

    .top-banner::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.35); /* Overlay for better text visibility */
    }

    .banner-content {
        position: relative;
        color: #fff;
        text-align: center;
        padding: 20px;
    }

    .banner-content h1 {
        font-size: 48px;
        margin-bottom: 15px;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
    }

    .banner-content p {
        font-size: 18px;
        margin-bottom: 25px;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.5);
    }

    .banner-content a {
        display: inline-block;
        padding: 12px 30px;
        background: #1e90ff;
        color: #fff;
        font-weight: bold;
        text-decoration: none;
        border-radius: 8px;
        transition: background 0.3s, transform 0.3s;
    }

    .banner-content a:hover {
        background: #3742fa;
        transform: translateY(-3px);
    }
    </style>

    <!-- --- Banner HTML --- -->
    <div class="top-banner">
        <div class="banner-content">
            <h1>{{ $sliders[0]?->title ?? 'Welcome to Our Courses' }}</h1>
            <p>{{ $sliders[0]?->subtitle ?? 'Explore hundreds of professional courses and learn at your own pace.' }}</p>
            <a href="{{ $sliders[0]?->link ?? '#' }}">Explore Courses</a>
        </div>
    </div>

    <!-- --- Slideshow HTML --- -->
    <div class="top-info">


        <div class="stats">
            <div class="stat-box">
                <h2>18,450+</h2>
                <p>Active Students</p>
            </div>
            <div class="stat-box">
                <h2>520+</h2>
                <p>Courses Available</p>
            </div>
            <div class="stat-box">
                <h2>75+</h2>
                <p>Professional Teachers</p>
            </div>
            <div class="stat-box">
                <h2>1,200+</h2>
                <p>Certificates Issued</p>
            </div>
            <div class="stat-box">
                <h2>98%</h2>
                <p>Positive Reviews</p>
            </div>
            <div class="stat-box">
                <h2>24/7</h2>
                <p>Online Support</p>
            </div>
        </div>

    </div>


    <style>
        /* --- Teachers Slider با اسکرول مخفی --- */
        .teachers-slider {

            padding: 40px 20px;
            box-shadow: 0 -5px 15px rgba(0,0,0,0.05);

            display: flex;
            overflow-x: auto;      /* فعال کردن اسکرول افقی */
            gap: 20px;

            /* مخفی کردن scrollbar */
            scrollbar-width: none;  /* Firefox */
            -ms-overflow-style: none;  /* IE 10+ */
        }

        .teachers-slider::-webkit-scrollbar {
            display: none;  /* Chrome, Safari, Opera */
        }

        .teacher-card {
            flex: 0 0 auto;    /* عرض ثابت، جلوی shrink شدن */
            width: 120px;
            text-align: center;
            transition: transform 0.3s;
            cursor: pointer;
        }

        .teacher-card:hover {
            transform: translateY(-8px);
        }

        .teacher-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 3px solid #1e90ff;
        }

        .teacher-card span {
            display: block;
            font-size: 14px;
            color: #333;
            font-weight: bold;
        }
        </style>

        <!-- --- Teachers Section --- -->
        <div class="teachers-slider">
            @foreach($teachers as $teacher)
                <div class="teacher-card">
                    <img src="{{$teacher->thumb}}" alt="{{$teacher->name}}">
                    <span>{{$teacher->name}}</span>
                </div>
            @endforeach
        </div>
