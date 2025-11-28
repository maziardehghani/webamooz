<div class="col-12 bg-white margin-bottom-15 border-radius-3">
    <p class="box__title">سرفصل ها</p>
    <form action="{{route('dashboard.seasons.store' , $course->id)}}" method="post" class="padding-30">
        @csrf
        <input name="title" type="text" placeholder="عنوان سرفصل" class="text">
        <input name="number" type="text" placeholder="شماره سرفصل" class="text">
        <button class="btn btn-webamooz_net">اضافه کردن</button>
    </form>
    <div class="table__box padding-30">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th class="p-r-90">شناسه</th>
                <th>عنوان فصل</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($course->season as $season)
            <tr role="row" class="">
                <td><a href="">{{$season->number}}</a></td>
                <td><a href="">{{$season->title}}</a></td>
                <td>
                    @can(\Modules\RolePermissions\Models\Permission::PERMISSION_MANAGEMENT)

                    <a href="{{route('dashboard.seasons.destroy' , $season->id)}}" class="item-delete mlg-15"  title="حذف"></a>
                    <a href="" class="item-reject mlg-15" title="رد"></a>
                    <a href="" class="item-confirm mlg-15" title="تایید"></a>
                    @endcan
                    <a href="{{route('dashboard.seasons.edit' , $season->id)}}" class="item-edit " title="ویرایش"></a>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
