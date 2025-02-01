<div class="top-info">
    <div class="slideshow">
        @foreach($sliders as $slider)
            <div class="slide"><img src="{{$slider?->banner?->original}}" alt=""></div>
        @endforeach

        <a class="prev" onclick="move(-1)"><span>&#10095</span></a>
        <a class="next" onclick="move(1)"><span>&#10094</span></a>

        <div class="items">
            @foreach($sliders as $slider)
                <div class="item">
                    <div class="item-inner"></div>
                </div>
            @endforeach

        </div>
    </div>
    <div class="optionals">
        @foreach($adds as $add)
        <div><img src="{{$add->banner?->original}}" alt=""></div>
        @endforeach
    </div>
</div>
