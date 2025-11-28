@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.categories')}}" title="دسته بندی ها">دسته بندی ها</a></li>
    <li><a href="#" title="ویرایش دسته بندی ها">ویرایش دسته بندی ها</a></li>
@endsection
@section('content')
<div class="col-4 bg-white">
    <p class="box__title">ویرایش دسته بندی</p>
    <form action="{{route('dashboard.categories.update',$category->id)}}" method="post" class="padding-30">
        @csrf
        @method('PUT')
        <input name="title" required type="text" placeholder="نام دسته بندی" class="text" value="{{$category->title}}">
        <input name="slug" required type="text" placeholder="نام انگلیسی دسته بندی" class="text" value="{{$category->slug}}">
        <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>

        <select name="parent_id" id="parent_id">
            <option value="">ندارد</option>
            @foreach($categories as $category_item)
                <option value="{{$category_item->id}}" @if($category_item->id == $category->parent_id) selected @endif >{{$category_item->title}}</option>
            @endforeach
        </select>

        <button class="btn btn-webamooz_net">ویرایش</button>
    </form>
</div>
@endsection
