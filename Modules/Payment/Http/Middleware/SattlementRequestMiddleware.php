<?php

namespace Modules\Payment\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Payment\Http\Requests\sattlementRequest;
use Modules\Payment\Repasitories\sattlementRepository;
use Modules\Payment\Services\SattlementService;
use Modules\RolePermissions\Models\Permission;

class SattlementRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_TEACHER))
        {
            return $next($request);
        }
        return redirect()->back();
    }
}
