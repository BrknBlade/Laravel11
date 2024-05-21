<?php

namespace App\Enums;

enum BulletinStatus: string
{
    case Pending = 'pending';
    case Accepted = 'accepted';
    case Denied = 'denied';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Pendiente',
            self::Accepted => 'Aceptado',
            self::Denied => 'Denegado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'grey',
            self::Accepted => '#00ff47',
            self::Denied => '#ff1500',
        };
    }
}
