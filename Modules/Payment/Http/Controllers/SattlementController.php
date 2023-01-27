<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Payment\Events\SattlementStatusChanged;
use Modules\Payment\Events\settledUserRequest;
use Modules\Payment\Http\Requests\sattlementRequest;
use Modules\Payment\Models\Sattlement;
use Modules\Payment\Repasitories\sattlementRepository;
use Modules\RolePermissions\Models\Permission;

class SattlementController extends Controller
{
    public $sattlementRepository;
    public function __construct(sattlementRepository $sattlementRepository)
    {
        $this->sattlementRepository = $sattlementRepository;
    }

    public function index()
    {
        $this->authorize('manage' , Sattlement::class);
        $sattlements = $this->sattlementRepository->getuserSattlement(auth()->id());
        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGEMENT))
        {
            $sattlements = $this->sattlementRepository->getSattlements();
        }

        return view('payment::sattlement' , compact('sattlements'));
    }

    public function create()
    {
        $this->authorize('manage' , Sattlement::class);
        return view('payment::sattlementCreate');
    }
    public function store(sattlementRequest $request , $user_id)
    {
        $this->authorize('manage' , Sattlement::class);

        $sattlement = $this->sattlementRepository->store($request , $user_id);
        event(new SattlementStatusChanged($this->sattlementRepository->find($sattlement->id)));
        return redirect()->to(route('dashboard.sattlement.index'));
    }

    public function edit($sattlement)
    {
        $this->authorize('rejectAndAccept' , Sattlement::class);
        $sattlement = $this->sattlementRepository->find($sattlement);
        return view('payment::sattlementEdit' , compact('sattlement'));
    }

    public function update(sattlementRequest $request , $sattlement_id)
    {
        $this->authorize('rejectAndAccept' , Sattlement::class);

        $this->sattlementRepository->update($request , $sattlement_id);
        return redirect()->to(route('dashboard.sattlement.index'));
    }

    public function settled($sattlement_id)
    {
        $this->authorize('rejectAndAccept' , Sattlement::class);
        $this->sattlementRepository->settled($sattlement_id);
        return redirect()->to(route('dashboard.sattlement.index'));
    }
    public function rejected($sattlement_id)
    {
        $this->authorize('rejectAndAccept' , Sattlement::class);
        $this->sattlementRepository->rejected($sattlement_id);
        event(new SattlementStatusChanged($this->sattlementRepository->find($sattlement_id)));
        return redirect()->to(route('dashboard.sattlement.index'));
    }



}

