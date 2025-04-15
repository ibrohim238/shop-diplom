<?php

namespace App\Versions\Private\Http\Requests;

use App\Rules\CouponCodeCheck;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'carts'       => ['required', 'array', 'min:1'],
            'carts.*'     => ['required', 'int', 'exists:carts,id'],
            'coupon_code' => ['nullable', 'string', new CouponCodeCheck()],
        ];
    }
}
