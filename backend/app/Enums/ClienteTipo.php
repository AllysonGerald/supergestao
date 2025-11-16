<?php

declare(strict_types=1);

namespace App\Enums;

enum ClienteTipo: string
{
    case FISICA = 'fisica';
    case JURIDICA = 'juridica';

    public function label(): string
    {
        return match ($this) {
            self::FISICA => 'Pessoa Física',
            self::JURIDICA => 'Pessoa Jurídica',
        };
    }

    public function abbreviation(): string
    {
        return match ($this) {
            self::FISICA => 'PF',
            self::JURIDICA => 'PJ',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
