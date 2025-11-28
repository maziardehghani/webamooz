<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Dashboard\Http\Requests\UpdateUserPhotoRequest;
use Modules\Media\Services\MediaFileService;
use Modules\RolePermissions\Models\Permission;
use Modules\RolePermissions\Repository\PermissionRepository;
use Modules\User\Http\Requests\AddPermissionRequest;
use Modules\User\Http\Requests\AddRoleRequest;
use Modules\User\Http\Requests\editProfileRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Models\User;
use Modules\User\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepository;
    private $permissionRepository;
    public function __construct(UserRepository $userRepository , PermissionRepository $permissionRepository)
    {
        $this->userRepository = $userRepository;
        $this->permissionRepository = $permissionRepository;
    }
    public function index()
    {
        $this->authorize('index' , User::class);
        $users = $this->userRepository->paginate();
        $permissions = $this->permissionRepository->all();
        return view('user::admin.index' , compact('users' , 'permissions'));

    }

    public function create()
    {
        return view('user::create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('user::show');
    }

    public function edit(User $user)
    {
        $this->authorize('edit' , User::class);
        return view('user::admin.edit' , compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $this->authorize('edit' , User::class);
        $user = $this->userRepository->findByID($id);

        $this->userRepository->update($id , $request);
        // newFeedback('پیام موفقیت آمیز' , 'نقش مورد نظر به این کاربر داده شد' , 'success' );
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->authorize('delete' , User::class);
        $user = $this->userRepository->findByID($id);
        $user->delete();
        return back();
    }
    public function addPermission(AddPermissionRequest $request , User $user)
    {
        $this->authorize('addPermission' , User::class);
        $this->userRepository->addPermission($request ,$user);
        //        newFeedback('پیام موفقیت آمیز' , 'نقش مورد نظر به این کاربر داده شد' , 'success' );

        return back();
    }
    public function removePermission(Permission $userPermission , User $user)
    {
        $this->authorize('addPermission' , User::class);
        $user->revokePermissionTo($userPermission);
//        newFeedback('پیام موفقیت آمیز' , 'نقش مورد نظر به این کاربر داده شد' , 'success' );
        return back();
    }
    public function verifyEmail($id)
    {
        $this->authorize('manageVerify' , User::class);
        $user = $this->userRepository->findByID($id);
        $user->markEmailAsVerified();
        return back();
    }
    public function UpdateUserPhoto(UpdateUserPhotoRequest $request)
    {
        $this->authorize('editProfile' , User::class);

        $media = MediaFileService::uploadPublic($request->file('user_photo'));
        if (auth()->user()->image_id)
            auth()->user()?->image?->delete();
        auth()->user()->image_id = $media->id;
        auth()->user()->save();
        return back();
    }
    public function UserProfile()
    {

        $this->authorize('editProfile' , User::class);
        return view('user::admin.profile');
    }
    public function UpdateUserProfile(editProfileRequest $request)
    {
        $this->authorize('editProfile' , User::class);
        $this->userRepository->updateProfile($request);
        return back();
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
