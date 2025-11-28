@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="" title="سرفصل ها">{{$season->course->title}}</a></li>
    <li><a href="#" title="ویرایش سرفصل ها">ویرایش سرفصل ها</a></li>
@endsection
@section('content')
    <div class="col-4 bg-white">
        <p class="box__title">ایجاد سرفصل</p>
    </div>
    <form action="{{route('dashboard.seasons.update' , $season->id)}}" class="padding-30" method="post"  enctype="multipart/form-data">
        @csrf
        @method('put')
        <input name="title" type="text" class="text" placeholder="عنوان سرفصل" required value="{{$season->title}}">
        @error('title')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <input name="number" type="text" class="text text-left "  value="{{$season->number}}" placeholder="نام انگلیسی سرفصل">
        @error('number')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <button class="btn btn-webamooz_net">ایجاد سرفصل</button>
    </form>
@endsection
@section('js')
    <script src="{{asset('panel/js/tagsInput.js')}}"></script>
@endsection
