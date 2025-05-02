<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ProductException extends Exception
{
    protected $code = 400;

    public static function notExists(): self
    {
        return new self('Product does not exist');
    }

    public static function exists(): self
    {
        return new self("Product already exists");
    }

    public function render(): JsonResponse
    {
        return response()
            ->json([
                'message' => $this->getMessage(),
            ], $this->getCode());
    }
}
