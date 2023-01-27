@component('mail::message')
# یکی از دانشجویان به دوره آموزشی شما نظر داد

شما میتوانید با مراجعه به پنل مدیریت خود به این نظر پاسخ دهید یا اینکه با کلیک بر لینک زیر به آدرس دوره بروید
@component('mail::panel')
<a href="{{$comment->commentable->path()}}">{{$comment->commentable->title}}</a>
@endcomponent

با تشکر,<br>
{{ config('app.name') }}
@endcomponent
