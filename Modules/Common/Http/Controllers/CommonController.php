<?php

namespace Modules\Common\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CommonController extends Controller
{
   public function notificationMarkAsReed()
   {
       auth()->user()->unreadNotifications->markAsRead();
   }
}
