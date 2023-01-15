<div class="col-4 bg-white">
    <p class="box__title">ایجاد دسته بندی جدید</p>
    <form action="{{route('dashboard.categories.store')}}" method="post" class="padding-30">
        @csrf
        <input name="title" required type="text" placeholder="نام دسته بندی" class="text">
        <input name="slug" required type="text" placeholder="نام انگلیسی دسته بندی" class="text">
        <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
        <select name="parent_id" id="parent_id">
            <option value="">ندارد</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
</div>
