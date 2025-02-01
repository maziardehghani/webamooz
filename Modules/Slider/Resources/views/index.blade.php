@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.sliders')}}" title="بنر ها">بنر ها</a></li>
@endsection
@section('content')

            <div class="tab__box">
                <div class="tab__items">
                    <a class="tab__item is-active" href="banners.html">لیست بنر ها ها</a>
                    <a class="tab__item " href="{{route('dashboard.slider.create')}}">ایجاد بنر جدید</a>

                </div>
            </div>
            <div class="table__box">
                <table class="table">

                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th class="p-r-90">الویت</th>
                        <th>عنوان</th>
                        <th>تصویر</th>
                        <th>لینک</th>
                        <th>تاریخ ایجاد</th>
                        <th>نوع</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sliders as $slider)
                    <tr role="row" class="">
                        <td><a href="">{{$slider->priority}}</a></td>
                        <td><a href="">{{$slider->title}}</a></td>
                        <td><a href=""><img class="img__slideshow" src="{{$slider->banner?->thumb}}" alt=""></a>
                        </td>
                        <td><a href="{{$slider->link}}">{{$slider->link}}</a></td>
                        <td>{{verta($slider->created_at)}}</td>
                        <td>{{$slider->type}}</td>
                        <td id="status" class="{{$slider->status == 1 ? 'text-success': 'text-error'}}">{{$slider->status == 1 ? 'فعال' : 'غیرفعال'}}</td>
                        <td>
                            <a  href="{{route('dashboard.slider.delete' , $slider->id) }}" class="item-delete mlg-15" title="حذف"></a>
                            <a  href="{{route('dashboard.slider.changeStatus' , [0,$slider->id]) }}"  class="item-reject mlg-15" title="رد"></a>
                            <a  href="{{route('dashboard.slider.changeStatus' , [1,$slider->id]) }}"  class="item-confirm mlg-15" title="تایید"></a>
                            <a href="{{route('dashboard.slider.edit' , $slider->id) }}" class="item-edit" title="ویرایش"></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>



@endsection


