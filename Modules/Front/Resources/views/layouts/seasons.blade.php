@foreach($seasons as $season)
    <div class="episodes-list-section">
        <div class="episodes-list-group">
            <div class="episodes-list-group-head">
                <div class="head-right">
                    <div class="section-title">{{$season->title}}</div>
                    <span class="episode-count"> {{count($season->lessons)}} video </span>
                </div>
                <div class="head-left"></div>
            </div>
            <div class="episodes-list-group-body">
                @include('front::layouts.lessons')
            </div>
        </div>
    </div>
@endforeach

