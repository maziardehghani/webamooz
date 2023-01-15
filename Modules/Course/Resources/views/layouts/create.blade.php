@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.courses')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش دوره ها">ایجاد دوره ها</a></li>
@endsection
@section('content')
    <div class="col-4 bg-white">
        <p class="box__title">ایجاد دوره</p>
    </div>
    <form action="{{route('dashboard.courses.store')}}" class="padding-30" method="post"  enctype="multipart/form-data">
        @csrf
        <input name="title" type="text" class="text" placeholder="عنوان دوره" required value="{{old('title')}}">
        @error('title')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="slug" type="text" class="text text-left " required value="{{old('slug')}}" placeholder="نام انگلیسی دوره">
        @error('slug')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror



        <div class="d-flex multi-text">
            <input name="priority" type="text" class="text text-left mlg-15" value="{{old('priority')}}" placeholder="ردیف دوره">
            @error('priority')
            <div class=" text-danger colorRed">
                <strong>{{ $message }}</strong>
            </div>
            @enderror

            <input name="price" type="text" placeholder="مبلغ دوره" required value="{{old('price')}}" class="text-left text mlg-15">
            @error('price')
            <div class=" text-danger colorRed">
                <strong>{{ $message }}</strong>
            </div>
            @enderror

            <input name="percent" type="text" placeholder="درصد مدرس" required value="{{old('percent')}}" class="text-left text">
            @error('percent')
            <div class=" text-danger colorRed">
                <strong>{{ $message }}</strong>
            </div>
            @enderror

        </div>
        <select name="teacher_id">
            <option value="">انتخاب مدرس دوره</option>
            @foreach($teachers as $teacher)
                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
            @endforeach
        </select>
        @error('teacher_id')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror


        <ul class="tags">

            <li class="addedTag">dsfsdf<span class="tagRemove" onclick="$(this).parent().remove();">x</span>
                <input type="hidden" value="dsfsdf" name="tags[]"></li>
            <li class="addedTag">dsfsdf<span class="tagRemove" onclick="$(this).parent().remove();">x</span>
                <input type="hidden" value="dsfsdf" name="tags[]"></li>
            <li class="tagAdd taglist">
                <input type="text" id="search-field">
            </li>
        </ul>
        <select name="type" required>
            <option value="">نوع دوره</option>
            @foreach(\Modules\Course\Models\courses::$types as $type)
                <option value="{{$type}}">@lang($type)</option>
            @endforeach
        </select>
        @error('type')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror


        <select name="status" required>
            <option value="">وضعیت دوره</option>
            @foreach(\Modules\Course\Models\courses::$statuses as $status)
                <option value="{{$status}}">@lang($status)</option>
            @endforeach
        </select>
        @error('status')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror


        <select name="category_id"  required>
            <option value="">دسته بندی</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
        @error('category_id')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror


        <div class="file-upload">
            <div class="i-file-upload">
                <span>آپلود بنر دوره</span>
                <input type="file" class="file-upload" id="files" value="{{old('image')}}" required name="image"/>
            </div>
            <span class="filesize"></span>
            <span class="selectedFiles">فایلی انتخاب نشده است</span>
        </div>
        @error('image')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror


        <textarea name="description"  placeholder="توضیحات دوره" class="text h">{{old('description')}}</textarea>
        @error('description')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror


        <button class="btn btn-webamooz_net">ایجاد دوره</button>
    </form>
@endsection
@section('js')
    <script src="{{asset('panel/js/tagsInput.js')}}"></script>
@endsection
