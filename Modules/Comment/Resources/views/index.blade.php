@extends('dashboard::layouts.master')

@section('breadcrumb')
    <li><a href="{{ route('dashboard.comments') }}" title="Comments">Comments</a></li>
@endsection

@section('content')

<div class="tab__box">
    <div class="tab__items">
        <a class="tab__item is-active" href="{{ route('dashboard.comments') }}">All Comments</a>
        <a class="tab__item is-active" href="{{ route('dashboard.comments') }}?status=rejected">Unapproved Comments</a>
        <a class="tab__item is-active" href="{{ route('dashboard.comments') }}?status=accepted">Approved Comments</a>
        <a class="tab__item is-active" href="{{ route('dashboard.comments') }}?status=new">New Comments</a>
    </div>
</div>

<div class="bg-white padding-20">
    <div class="t-header-search">
        <form action="" onclick="event.preventDefault();">
            <div class="t-header-searchbox font-size-13">
                <input type="text" class="text search-input__box font-size-13" placeholder="Search in Comments">
                <div class="t-header-search-content">
                    <input type="text" class="text" placeholder="Part of Comment Text">
                    <input type="text" class="text" placeholder="Email">
                    <input type="text" class="text margin-bottom-20" placeholder="Full Name">
                    <button class="btn btn-webamooz_net">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="table__box">
    <table class="table">
        <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th>ID</th>
                <th>Author</th>
                <th>For</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
            <tr role="row">
                <td><a href="">{{ $loop->iteration }}</a></td>
                <td><a href="">{{ $comment->user->name }}</a></td>
                <td><a href="{{ $comment->commentable->path() }}">{{ $comment->commentable->title }}</a></td>
                <td>{{ $comment->body }}</td>
                <td>{{ verta($comment->created_at) }}</td>
                <td class="{{ $comment->status == \Modules\Comment\Models\Comment::STATUS_ACCEPTED ? 'text-success' : 'text-error' }}">
                    @lang($comment->status)
                </td>
                <td>
                    @can('accept_reject_delete')
                        <a href="{{ route('dashboard.comments.delete', $comment->id) }}" class="item-delete mlg-15" title="Delete"></a>
                        <a href="{{ route('dashboard.comments.reject', $comment->id) }}" class="item-reject mlg-15" title="Reject"></a>
                        <a href="{{ route('dashboard.comments.accept', $comment->id) }}" class="item-confirm mlg-15" title="Approve"></a>
                    @endcan
                    <a href="{{ route('dashboard.comments.answers', $comment->id) }}" class="item-eye mlg-15" title="View"></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
