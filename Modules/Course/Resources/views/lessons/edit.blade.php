@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.courses')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="{{route('dashboard.courses')}}" title="{{$course->title}}">{{$course->title}}</a></li>
    <li><a href="#" title="ویرایش درس">ویرایش درس</a></li>
@endsection
@section('content')
<div class="main-content padding-0">
    <p class="box__title">ویرایش درس</p>
    <div class="row no-gutters bg-white">
        <div class="col-12">
            <form action="{{route('dashboard.lessons.update', [$lesson->id,$course->id])}}" method="post" enctype="multipart/form-data" class="padding-30">
                @csrf
                @method('put')
                <input name="title" type="text" class="text" value="{{$lesson->title}}">
                @error('title')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <input name="slug" type="text" class="text text-left "  value="{{$lesson->slug}}">
                @error('slug')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <input name="number" type="text" class="text text-left "  value="{{$lesson->number}}">
                @error('number')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <input name="time" type="text" class="text text-left "  value="{{$lesson->time}}">
                @error('time')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror

                <p class="box__title">ایا این درس رایگان است ؟ </p>
                <div class="w-50">
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-1" name="free" value="0" type="radio" {{$lesson->free ? '':'checked'}}/>
                        <label for="lesson-upload-field-1">خیر</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-2" name="free" value="1" type="radio" {{$lesson->free ? 'checked':''}} />
                        <label for="lesson-upload-field-2">بله</label>
                    </div>
                </div>
                <select name="season_id">
                    <option value="">انتخاب سرفصل</option>
                    @foreach($seasons as $season)
                        <option value="{{$season->id}}" {{$season->id == $lesson->season->id ? 'selected' : ''}}>{{$season->title}}</option>
                    @endforeach
                </select>
                @error('season_id')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
                <div class="file-upload">
                    <div class="i-file-upload">
                        <span>آپلود درس</span>
                        <input type="file" class="file-upload" name="lesson_file"/>
                    </div>
                    <span class="filesize"></span>
                    <span class="selectedFiles">{{$lesson->media->filename}}</span>
                </div>
                @error('lesson_file')
                <div class=" text-danger colorRed">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror

                <textarea name="body" placeholder="توضیحات دوره" class="text h"> {{$lesson->body}}</textarea>
                <button class="btn btn-webamooz_net">آپلود درس</button>
            </form>
        </div>
    </div>
</div>
@endsection
