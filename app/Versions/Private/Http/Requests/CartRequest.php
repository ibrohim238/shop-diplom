<?php

namespace App\Versions\Private\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity'   => ['required', 'int', 'min:1', 'max:100'],
        ];
    }
}
