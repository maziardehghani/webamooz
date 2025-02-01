<div class="col-4 bg-white">
    <p class="box__title">Create New Discount</p>
    <form action="{{route('dashboard.discounts.store')}}" method="post" class="padding-30">
        @csrf
        <input type="text" placeholder="Discount Code" class="text" name="code" value="{{old('code')}}">
        @error('code')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input type="text" placeholder="Discount Percentage" class="text" name="percent" value="{{old('percent')}}" required>
        @error('percent')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input type="text" placeholder="Usage Limitation (Users)" class="text" name="usage_limitation" value="{{old('usage_limitation')}}">
        @error('limitation')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input type="text" placeholder="Time Limitation (in hours)" class="text" name="expire_at" value="{{old('expire_at')}}" required>
        @error('expire_at')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <p class="box__title">This discount is for</p>
        <div class="notificationGroup">
            <input id="discounts-field-1" class="discounts-field-pn" name="type" value="all" type="radio"/>
            <label for="discounts-field-1">All Courses</label>
        </div>
        <div class="notificationGroup">
            <input id="discounts-field-2" class="discounts-field-pn" name="type" value="special" type="radio"/>
            <label for="discounts-field-2">Specific Course</label>
        </div>
        <select name="course">
            <option value="">Select Course</option>
            @foreach($courses as $course)
                <option value="{{$course->id}}">{{$course->title}}</option>
            @endforeach
        </select>
        @error('title')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input type="text" placeholder="More Info Link" class="text" name="link" value="{{old('link')}}">
        @error('link')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <input type="text" placeholder="Description" class="text margin-bottom-15" name="description" value="{{old('description')}}">
        @error('description')
        <div class="text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <button class="btn btn-webamooz_net">Add</button>
    </form>
</div>
<script src="{{asset('js/tagsInput.js')}}"></script>
