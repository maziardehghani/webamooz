<?php

namespace Modules\User\Actions;

use Illuminate\Http\Request;
use Modules\User\Http\Requests\verifyCodeRequest;
use Modules\User\Models\User;
use Modules\User\Services\VerifyCodeService;

class verificationCode
{
    public function verify(verifyCodeRequest $request)
    {
        if (! VerifyCodeService::check($request->verification_code,auth()->id()))
        {
            return back()->withErrors(['verification_code' , 'کد وارد شده معتبر نمیباشد']);
        }
        auth()->user()->markEmailAsVerified();
        return redirect()->route('home');

    }
}
