<?php

namespace App\Versions\Admin\Http\Requests;

use App\Enums\CouponTypeEnum;
use App\Rules\CouponAmountTypeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('coupons', 'code'),
            ],
            'description'      => ['nullable', 'string', 'max:512'],
            'amount'           => ['required', 'integer', new CouponAmountTypeRule()],
            'min_price'        => ['nullable', 'integer', 'min:0'],
            'type'             => ['required', 'integer', Rule::enum(CouponTypeEnum::class)],
            'quantity_allowed' => ['nullable', 'integer', 'min:1'],
            'expires_date'     => ['nullable', 'date', 'after:today'],
        ];
    }
}
