<?php

namespace Modules\Payment\Services;

use Modules\Payment\Models\Payment;
use Modules\Payment\Repasitories\sattlementRepository;

class SattlementService
{
    public static function userCanSendSattlementRequest($user_id)
    {
        $userLastRequest = (new sattlementRepository())->userlastRequest($user_id);
        if (isset($userLastRequest) &&
            $userLastRequest->status == Payment::STATUS_PENDING)
        {
            return false;
        }
        return true;
    }
    public static function userCanEditSattlementRequest($sattlement)
    {

        $sattlement = (new sattlementRepository())->find($sattlement);
        if ($sattlement->status == Payment::STATUS_PENDING)
        {
            return true;
        }
            return false;
    }

}
