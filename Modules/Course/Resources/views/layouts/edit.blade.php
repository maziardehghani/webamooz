@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.courses')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش دوره ها">ویرایش دوره ها</a></li>
@endsection
@section('content')
    <div class="col-4 bg-white">
        <p class="box__title">ایجاد دوره</p>
    </div>
    <form action="{{route('dashboard.courses.update' , $course->id)}}" class="padding-30" method="post"
          enctype="multipart/form-data">
        @csrf
        @method('put')
        <input name="title" type="text" class="text" placeholder="عنوان دوره" required value="{{$course->title}}">
        @error('title')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="slug" type="text" class="text text-left " required value="{{$course->slug}}"
               placeholder="نام انگلیسی دوره">
        @error('slug')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror


        <div class="d-flex multi-text">
            <input name="priority" type="text" class="text text-left mlg-15" value="{{$course->priority}}"
                   placeholder="ردیف دوره">
            @error('priority')
            <div class=" text-danger colorRed">
                <strong>{{ $message }}</strong>
            </div>
            @enderror

            <input name="price" type="text" placeholder="مبلغ دوره" required value="{{$course->price}}"
                   class="text-left text mlg-15">
            @error('price')
            <div class=" text-danger colorRed">
                <strong>{{ $message }}</strong>
            </div>
            @enderror

            <input name="percent" type="text" placeholder="درصد مدرس" required value="{{$course->percent}}"
                   class="text-left text">
            @error('percent')
            <div class=" text-danger colorRed">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>
        <select name="category_id" required>
            <option value="">دسته بندی</option>
            @foreach($categories as $category)
                <option
                    value="{{$category->id}}" {{$category->id == $course->category_id ? 'selected' :''}}>{{$category->title}}</option>
            @endforeach
        </select>
        @error('category_id')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <select name="teacher_id">
            <option value="">انتخاب مدرس دوره</option>
            @foreach($teachers as $teacher)
                <option
                    value="{{$teacher->id}}" {{$teacher->id == $course->teacher_id ? 'selected' :''}}>{{$teacher->name}}</option>
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
                <option value="{{$type}}" {{$type == $course->type ? 'selected' : ''}}>@lang($type)</option>
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
                <option value="{{$status}}" {{$status == $course->status ? 'selected' : ''}}>@lang($status)</option>
            @endforeach
        </select>
        @error('status')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror


        <select name="category_id" required>
            <option value="">دسته بندی</option>
            @foreach($categories as $category)
                <option
                    value="{{$category->id}}" {{$category->id == $course->category_id ? 'selected' : ''}}>{{$category->title}}</option>
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
                <input type="file" class="file-upload" id="files"
                       value="{{$course->banner_id ? $course->banner->filename : ''}}" name="image"/>
            </div>
            <span class="filesize"></span>
            @if(isset($course->banner_id))
                <img src="{{$course->banner->thumb}}" width="150">
            @else
                <span class="selectedFiles">فایلی انتخاب نشده است</span>
            @endif
        </div>
        @error('image')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror


        <textarea name="description" placeholder="توضیحات دوره" class="text h">{{$course->description}}</textarea>
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
