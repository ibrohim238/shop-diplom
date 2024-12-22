<?php

namespace App\Versions\Private\Http\Requests;

use App\Rules\CouponCodeCheck;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'baskets' => ['required', 'array', 'min:1'],
            'baskets.*' => ['required', 'int', 'exists:baskets,id'],
            'coupon_code' => ['nullable', 'string', new CouponCodeCheck()],
        ];
    }
}
