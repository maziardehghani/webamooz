<?php

namespace Modules\Payment\Repasitories;



use Modules\Payment\Models\Payment;
use Modules\Payment\Models\Sattlement;
use Modules\RolePermissions\Models\Permission;

class sattlementRepository
{
  public function store($request , $user_id)
  {
      return Sattlement::query()->create([

          'user_id' => $user_id,
          'to'=> [
              'name' => $request->name,
              'cart' => $request->cart,
          ],
          'amount' => $request->amount
          ]);
  }
    public function update($request , $sattlement_id)
    {
        $sattlement = $this->find($sattlement_id);
        return $sattlement->update([
            'transaction_id' => $request->transaction,

        ]);
    }

    public function find($sattlement)
    {
        return Sattlement::query()->findOrFail($sattlement);
    }

    public function getSattlements()
    {
        return Sattlement::query()->latest()->paginate(10);
    }

    public function settled($sattlement)
    {
        return Sattlement::query()->where('id' , $sattlement)->update(
            [
                'status' => Sattlement::STATUS_SETTLED
            ]
        );
    }

    public function userlastRequest($user_id)
    {
        return Sattlement::query()->where('user_id' , $user_id)->latest()->first();
    }

    public function rejected($user_id)
    {
        return Sattlement::query()->where('id' , $user_id)->update(
            [
                'status' => Sattlement::STATUS_REJECTED
            ]
        );
    }

    public function getuserSattlement($user_id)
    {
        return Sattlement::query()->where('user_id' , $user_id)->latest()->paginate(10);

    }
}
