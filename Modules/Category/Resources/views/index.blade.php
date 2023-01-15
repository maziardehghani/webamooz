@extends('dashboard::layouts.master')
@section('breadcrumb')
    <li><a href="{{route('dashboard.categories')}}" title="دسته بندی ها">دسته بندی ها</a></li>
@endsection
@section('content')

        <div class="main-content padding-0 categories">
            <div class="row no-gutters  ">
                <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                    <p class="box__title">دسته بندی ها</p>
                    <div class="table__box">
                        <table class="table">
                            <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>شناسه</th>
                                <th>نام دسته بندی</th>
                                <th>نام انگلیسی دسته بندی</th>
                                <th>دسته پدر</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)

                                <tr role="row" class="">
                                <td><a href="">{{$loop->iteration}}</a></td>
                                <td><a href="">{{$category->title}}</a></td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->parent}}</td>
                                <td>
                                    <form id="destroyFrm" action="{{route('dashboard.categories.destroy', $category->id) }}" method="post">
                                        @method('DELETE')  @csrf
                                        <button type="submit" class="item-delete mlg-15" title="حذف"></button>
                                    <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                    <a href="{{route('dashboard.categories.edit' , $category->id)}}" class="item-edit " title="ویرایش"></a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @include('category::layouts.create')
@endsection

