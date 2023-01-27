<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Comment\Event\CommentSubmittedEvent;
use Modules\Comment\Http\Requests\CommentRequest;
use Modules\Comment\Models\Comment;
use Modules\Comment\Repository\commentRepository;
use Modules\RolePermissions\Models\Permission;

class CommentController extends Controller
{
    private $commentRepository;
    public function __construct(commentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(CommentRequest $request)
    {
        $comment = $this->commentRepository->store($request->all());
        event(new CommentSubmittedEvent($comment));

//        newFeedback('موفقیت' , 'نظر شما با موفقیت ثبت شد' , 'success');
        return redirect()->back();
    }

    public function index()
    {
        $this->authorize('manage' , Comment::class);
        if (!auth()->user()->hasAnyPermission([Permission::PERMISSION_MANAGEMENT , Permission::PERMISSION_SUPER_ADMIN]))
        {
            $comments = $this->commentRepository->getComments(Comment::STATUS_ACCEPTED,auth()->id());
        }else
        {
            $comments = $this->commentRepository->getComments(request('status') , null);
        }

        return view('comment::index' , compact('comments'));
    }
    public function accept($id)
    {
        $this->authorize('manage' , Comment::class);
        $comment = $this->commentRepository->find($id);
        $this->commentRepository->changeStatus($comment , Comment::STATUS_ACCEPTED);

//        newFeedback('موفقیت' , 'تغییر وضعیت' , 'موفق');
        return redirect()->back();
    }
    public function reject($id)
    {
        $this->authorize('manage' , Comment::class);
        $this->commentRepository->changeStatus($id , Comment::STATUS_REJECTED);
//        newFeedback('موفقیت' , 'تغییر وضعیت' , 'موفق');
        return redirect()->back();
    }
    public function answers($id)
    {
        $comment = $this->commentRepository->findComment($id);
        $this->authorize('show' ,$comment);

        return view('comment::answers' , compact('comment'));
    }
    public function delete($id)
    {
        $this->authorize('manage' , Comment::class);
        $comment = $this->commentRepository->find($id);
        $comment->delete();
        //        newFeedback('موفقیت' , 'حذف نظر' , 'موفق');

        return redirect()->back();
    }

}
