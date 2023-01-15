<div class="col-4 bg-white">
    <p class="box__title">ایجاد تخفیف جدید</p>
    <form action="{{route('dashboard.discounts.store')}}" method="post" class="padding-30">
       @csrf
        <input type="text" placeholder="کد تخفیف" class="text" name="code" value="{{old('code')}}">
        @error('code')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input type="text" placeholder="درصد تخفیف" class="text" name="percent" value="{{old('percent')}}" required>
        @error('percent')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input type="text" placeholder="محدودیت افراد" class="text" name="usage_limitation" value="{{old('usage_limitation')}}" >
        @error('limitation')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input type="text" placeholder="محدودیت زمانی به ساعت" class="text" name="expire_at" value="{{old('expire_at')}}" required>
        @error('expire_at')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <p class="box__title">این تخفیف برای</p>
        <div class="notificationGroup">
            <input id="discounts-field-1" class="discounts-field-pn" name="type" value="all" type="radio"/>
            <label for="discounts-field-1">همه دوره ها</label>
        </div>
        <div class="notificationGroup">
            <input id="discounts-field-2" class="discounts-field-pn" name="type" value="special" type="radio"/>
            <label for="discounts-field-2">دوره خاص</label>
        </div>
        <select name="course">
            <option value="">انتخاب دوره</option>
        @foreach($courses as $course)
            <option value="{{$course->id}}">{{$course->title}}</option>
            @endforeach
        </select>
        @error('title')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input type="text" placeholder="لینک اطلاعات بیشتر" class="text" name="link" value="{{old('link')}}">
        @error('link')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input type="text" placeholder="توضیحات" class="text margin-bottom-15" name="description" value="{{old('description')}}">
        @error('description')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <button class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
</div>
<script src="{{asset('js/tagsInput.js')}}"></script>
