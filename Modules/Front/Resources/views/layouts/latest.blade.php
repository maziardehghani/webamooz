<div class="box-filter">
    <div class="b-head">
        <h2>newest courses</h2>
        <a href="{{route('all_courses')}}">view all</a>
    </div>
    <div class="posts">

        @foreach($latestCourses as $coursesItem)
            @include('front::layouts.latestCourses')
        @endforeach
    </div>
</div>
