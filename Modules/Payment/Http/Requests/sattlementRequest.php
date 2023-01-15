<?php

namespace Modules\Payment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Modules\Payment\Models\Sattlement;
use Modules\Payment\Services\SattlementService;

class sattlementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (request()->method === 'PUT')
        {
            return SattlementService::userCanEditSattlementRequest(request()->route('sattlement'));
        }

        return SattlementService::userCanSendSattlementRequest(request()->route('user'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (request()->method === 'PUT') {
            return
                [
                    'transaction' => 'required|numeric',
                    'cart' => 'required|numeric',
                ];
        }
        return
            [
                'name' => 'required',
                'cart' => 'required|numeric',
                'amount' => 'required|numeric|min:10000|max:' . auth()->user()->balance
            ];
    }
}
