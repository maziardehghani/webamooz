<?php

namespace Modules\Payment\Repasitories;

use Hekmatinasser\Verta\Facades\Verta;
use Modules\Payment\Models\Payment;
use Modules\RolePermissions\Models\Permission;
use Modules\User\Models\User;

class paymentRepository
{
    private $query;

    public function __construct()
    {
        $this->query = Payment::query();
    }
    public static function store($data , $discount=null)
    {
        $payment = Payment::create([
            'buyer_id'=> $data['buyer_id'],
            'seller_id' =>$data['seller_id'],
            'paymentable_id'=>$data['paymentable_id'],
            'paymentable_type'=>$data['paymentable_type'],
            'amount'=>$data['amount'],
            'invoice_id'=>$data['invoice_id'],
            'gateWay'=>$data['gateWay'],
            'status'=>$data['status'],
            'seller_percent'=> $data['seller_percent'],
            'seller_share'=>$data['seller_share'],
            'site_share'=>$data['site_share'],
        ]);

        if (! is_null($discount))
        {
            $payment->discounts()->sync($discount);
        }
        return $payment;

    }
    public function findByAuthority($Authority)
    {
        return Payment::where('invoice_id' , $Authority)->first();
    }
    public function changeStatus($id,$status)
    {
        return Payment::where('id' , $id)->update([
            'status' => $status
        ]);
    }

    public function paginate()
    {
        return $this->query->latest()->paginate(10);
    }

    public function getSuccessfulSells($column , $date = null)
    {
        $query = Payment::query()->where('status' , Payment::STATUS_SUCCESS);
        if ($date)
        {
            $query->where('created_at' , '>=' , now()->addDays($date));
        }

        return $query->sum($column);

    }
    public function getCourseSuccessfulSells($column , $seller_id , $date = null)
    {
        $query = Payment::query()->where(['status' => Payment::STATUS_SUCCESS , 'seller_id' => $seller_id]);
        if ($date)
        {
            $query->where('created_at' , '>=' , now()->addDays($date));
        }

        return $query->sum($column);

    }
    public function transActionsCount($seller_id,$date)
    {
        $query = Payment::query()->where(['status' => Payment::STATUS_SUCCESS , 'seller_id' => $seller_id]);
        if ($date)
        {
            $query->where('created_at' , '>=' , now()->addDays($date));
        }
        return $query->count();

    }
    public function searchEmail($email = null)
    {
        if (!is_null($email))
        {
              $this->query
                  ->join('users' , 'payments.buyer_id' , 'users.id')
                  ->select('payments.*' , 'users.email')
                  ->where('users.email' ,'like', '%'. $email .'%' );
        }
        return $this;
    }
    public function searchAmount($amount = null)
    {
        if (!is_null($amount))
        {
             $this->query->where('amount' , $amount);
        }
        return $this;

    }
    public function searchInvoice_id($invoice_id = null)
    {
        if (!is_null($invoice_id))
        {
             $this->query->where('invoice_id' , 'like' , '%'. $invoice_id . '%');
        }
        return $this;
    }
    public function searchDateAfter($date = null)
    {
        if ($this->vertaHelperFunc($date))
        {
          $this->query->where('created_at' , '>=' , $this->vertaHelperFunc($date));
        }
        return $this;
    }
    public function searchDateBefore($date = null)
    {
        if ($this->vertaHelperFunc($date))
        {
            $this->query->where('created_at' , '<=' , $this->vertaHelperFunc($date));
        }
        return $this;
    }
    private function vertaHelperFunc($date = null)
    {
        if ($date)
            return Verta::parse($date)->datetime();
        return null;
    }

    public function getSellertransactions(User $seller)
    {
        if ($seller->hasPermissionTo(Permission::PERMISSION_TEACHER))
        {
            return Payment::query()->where('seller_id' , $seller->id)->get();
        }

        return Payment::query()->where('buyer_id' , $seller->id)->get();
    }

    public function myShops()
    {
        return Payment::query()->where('buyer_id' , auth()->id())->latest()->paginate();
    }

}
