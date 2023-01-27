<div class="box-filter">
    <div class="b-head">
        <h2>جدید ترین دوره ها</h2>
        <a href="{{route('all_courses')}}">مشاهده همه</a>
    </div>
    <div class="posts">

        @foreach($latestCourses as $coursesItem)
            @include('front::layouts.latestCourses')
        @endforeach
    </div>
</div>
