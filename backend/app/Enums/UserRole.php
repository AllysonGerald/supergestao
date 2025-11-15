<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case MANAGER = 'manager';
    case USER = 'user';

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Administrador',
            self::MANAGER => 'Gerente',
            self::USER => 'Usuário',
        };
    }

    public function permissions(): array
    {
        return match($this) {
            self::ADMIN => ['*'], // Todas as permissões
            self::MANAGER => ['view', 'create', 'edit', 'delete'],
            self::USER => ['view', 'create'],
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }

    public function isManager(): bool
    {
        return $this === self::MANAGER;
    }
}

