<?php

declare(strict_types=1);

namespace App\Enums;

enum PedidoStatus: string
{
    case PENDENTE = 'pendente';
    case PROCESSANDO = 'processando';
    case ENVIADO = 'enviado';
    case ENTREGUE = 'entregue';
    case CANCELADO = 'cancelado';

    public function label(): string
    {
        return match ($this) {
            self::PENDENTE => 'Pendente',
            self::PROCESSANDO => 'Processando',
            self::ENVIADO => 'Enviado',
            self::ENTREGUE => 'Entregue',
            self::CANCELADO => 'Cancelado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDENTE => 'yellow',
            self::PROCESSANDO => 'blue',
            self::ENVIADO => 'indigo',
            self::ENTREGUE => 'green',
            self::CANCELADO => 'red',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
