<?php

namespace App\Enums;

use UnitEnum;

trait EnumTrait
{
    public static function values(): array
    {
        return collect(self::cases())
            ->pluck('value')
            ->toArray();
    }

    public static function except(mixed $keys): array
    {
        return collect(self::cases())
            ->keyBy('value')
            ->except($keys)
            ->pluck('value')
            ->toArray();
    }

    public static function has(mixed $value): bool
    {
        return collect(self::cases())
            ->pluck('value')
            ->contains($value);
    }

    public function is(mixed $value): bool
    {
        if ($value instanceof UnitEnum) {
            return $this === $value;
        }

        return $this->value === $value;
    }

    public function localization(): string
    {
        return __('enum.' . static::class . '.' . $this->name);
    }
}
