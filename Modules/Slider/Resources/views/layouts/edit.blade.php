@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.sliders')}}" title="ویرایش بنر">ویرایش بنر</a></li>
@endsection
@section('content')
    <p class="box__title">ویرایش بنر جدید</p>
    <div class="row no-gutters bg-white">
        <div class="col-12">
            <form action="{{route('dashboard.slider.update' , $slider->id)}}" method="post" class="padding-30" enctype="multipart/form-data">
               @csrf
                @method('put')
                <input name="title" type="text" class="text" placeholder="عنوان بنر" value="{{$slider->title}}">
                @error('title')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <input name="link" type="text" class="text text-left " placeholder="لینک بنر" value="{{$slider->link}}" >
                @error('link')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <input name="priority" type="text" class="text text-left " placeholder="شماره بنر" value="{{$slider->priority}}">
                @error('priority')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <select name="status" required>
                    <option value="{{0}}">وضعیت</option>
                        <option value="{{0}}" {{$slider->status == 0 ? 'selected' : ''}}>غیر فعال</option>
                        <option value="{{1}}" {{$slider->status == 1 ? 'selected':''}}>فعال</option>
                </select>
                @error('status')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <select name="type" required>
                    @foreach(\Modules\Slider\Models\Slider::$types as $type)
                        <option value="{{$type}}" {{$slider->type == $type ? 'selected':''}}>@lang($type)</option>
                    @endforeach
                </select>
                @error('type')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror

                <a href=""><img class="img__slideshow" src="{{$slider->banner->thumb}}" alt=""></a>
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
