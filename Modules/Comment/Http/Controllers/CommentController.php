<?php

namespace Modules\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Comment\Event\CommentSubmittedEvent;
use Modules\Comment\Http\Requests\CommentRequest;
use Modules\Comment\Jobs\SendEmail;
use Modules\Comment\Models\Comment;
use Modules\Comment\Repository\CommentRepository;
use Modules\RolePermissions\Models\Permission;

class CommentController extends Controller
{
    private $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(CommentRequest $request)
    {
        $this->commentRepository->store($request->all());
        return redirect()->back();
    }

    public function index()
    {
        $this->authorize('index' , Comment::class);
        if (!auth()->user()->hasAnyPermission([Permission::PERMISSION_MANAGEMENT , Permission::PERMISSION_SUPER_ADMIN]))
        {
            $comments = $this->commentRepository->getComments(Comment::STATUS_ACCEPTED,auth()->id());
        }else
        {
            $comments = $this->commentRepository->getComments(request('status'));
        }

        return view('comment::index' , compact('comments'));
    }
    public function accept($id)
    {
        $this->authorize('manage' , Comment::class);
        $comment = $this->commentRepository->find($id);
        event(new CommentSubmittedEvent($comment));
        $this->commentRepository->changeStatus($comment , Comment::STATUS_ACCEPTED);
        return redirect()->back();
    }
    public function reject($id)
    {
        $this->authorize('manage' , Comment::class);
        $comment = $this->commentRepository->find($id);
        $this->commentRepository->changeStatus($comment , Comment::STATUS_REJECTED);
        return redirect()->back();
    }
    public function answers($id)
    {
        $comment = $this->commentRepository->findComment($id);
        $this->authorize('answer' ,$comment);

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
