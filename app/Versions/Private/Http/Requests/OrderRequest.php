<?php

namespace App\Versions\Private\Http\Requests;

use App\Rules\CouponCodeCheck;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'carts'   => ['required', 'array', 'min:1'],
            'carts.*' => [
                'required',
                'int',
                Rule::exists('carts', 'id')
                    ->where('user_id', auth()->id()),
            ],
            'coupon_code' => ['nullable', 'string', new CouponCodeCheck()],
        ];
    }
}
