<?php

namespace App\Versions\Admin\Dtos;

use App\Enums\CouponTypeEnum;
use App\Versions\Admin\Http\Requests\CouponRequest;
use Carbon\Carbon;

class CouponDto
{
    public function __construct(
        private string         $code,
        private string         $description,
        private int            $amount,
        private CouponTypeEnum $type,
        private ?int           $quantityAllowed,
        private ?Carbon        $expiresDate,
    ) {
    }

    public static function fromRequest(CouponRequest $request): CouponDto
    {
        $validated = $request->validated();

        return new self(
            code: $validated['code'],
            description: $validated['description'] ?? null,
            amount: $validated['amount'],
            type: CouponTypeEnum::from($validated['type']),
            quantityAllowed: $validated['quantity_allowed'] ?? null,
            expiresDate: Carbon::make($validated['expires_date'] ?? null),
        );
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'description' => $this->description,
            'amount' => $this->amount,
            'type' => $this->type,
            'quantity_allowed' => $this->quantityAllowed,
            'expires_date' => $this->expiresDate,
        ];
    }
}
