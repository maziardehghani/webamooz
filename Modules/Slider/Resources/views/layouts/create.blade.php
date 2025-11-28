@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.sliders')}}" title="ایجاد بنر">ایجاد بنر</a></li>
@endsection
@section('content')
    <p class="box__title">ایجاد بنر جدید</p>
    <div class="row no-gutters bg-white">
        <div class="col-12">
            <form action="{{route('dashboard.slider.store')}}" method="post" class="padding-30" enctype="multipart/form-data">
               @csrf
                <input name="title" type="text" class="text" placeholder="عنوان بنر" value="{{old('title')}}">
                @error('title')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <input name="link" type="text" class="text text-left " placeholder="لینک بنر" value="{{old('link')}}" >
                @error('link')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <input name="priority" type="text" class="text text-left " placeholder="شماره بنر" value="{{old('priority')}}">
                @error('priority')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <select name="status" required>
                    <option value="{{0}}">وضعیت</option>
                        <option value="{{0}}">غیر فعال</option>
                        <option value="{{1}}">فعال</option>
                </select>
                @error('status')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <select name="type" required>
                    @foreach(\Modules\Slider\Models\Slider::$types as $type)
                        <option value="{{$type}}">@lang($type)</option>
                    @endforeach
                </select>
                @error('type')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror

                <div class="file-upload">
                    <div class="i-file-upload">
                        <span>آپلود تصویر</span>
                        <input type="file" class="file-upload" name="banner"/>
                    </div>
                    <span class="filesize"></span>
                    <span class="selectedFiles">فایلی انتخاب نشده است</span>
                </div>
                @error('banner')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror

                <button class="btn btn-webamooz_net">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
