<div class="col-4 bg-white">
    <p class="box__title">Create New User Role</p>
    <form action="{{route('dashboard.Role_permissions.store')}}" method="post" class="padding-30">
        @csrf
        <input name="name" required type="text" placeholder="Title" class="text" value="{{old('name')}}">
        @error('name')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <p class="box__title margin-bottom-15">Select Permissions</p>
        @foreach($permissions as $permission)
            <label class="ui-checkbox pt-1">
                <input name="permissions[{{$permission->name}}]" type="checkbox" class="sub-checkbox"
                       data-id="1" value="{{$permission->name}}"
                       @if(is_array(old('permissions')) && array_key_exists($permission->name , old('permissions'))) checked @endif
                >
                <span class="checkmark"></span>
                @lang($permission->name)
            </label>
        @endforeach
        @error('permissions')
        <div class=" text-danger colorRed">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <button type="submit" class="btn btn-webamooz_net mt-2">Add Role</button>
    </form>
</div>
