<?php

namespace App\Versions\Private\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CartUpdateQuantityRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'quantity' => ['required', 'int', 'min:1', 'max:100'],
        ];
    }
}
