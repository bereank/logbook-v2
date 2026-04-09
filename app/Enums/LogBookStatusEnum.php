<?php

namespace App\Enums;

enum LogBookStatusEnum: string
{
    case DEFAULT = '1';
    case PENDING = '2';
    case PENDING_ACCEPTANCE = '3';
    case WITH_ISSUES = '4';
    case ACCEPTED = '5';

    case DISPATCHED = '6';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::DEFAULT => 'Pending',
            self::PENDING_ACCEPTANCE => 'P.Acceptance',
            self::WITH_ISSUES => 'With Issues',
            self::ACCEPTED => 'Accepted',
            self::DISPATCHED => 'Dispatched'
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::DEFAULT => 'warning',
            self::PENDING_ACCEPTANCE => 'info',
            self::WITH_ISSUES => 'danger',
            self::ACCEPTED => 'success',
            self::DISPATCHED => 'primary',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::PENDING => 'heroicon-m-lock-open',
            self::DEFAULT => 'heroicon-m-lock-open',
            self::PENDING_ACCEPTANCE => 'heroicon-m-lock-closed',
            self::WITH_ISSUES => 'heroicon-m-lock-closed',
            self::ACCEPTED => 'heroicon-m-check-badge',
            self::DISPATCHED => 'heroicon-m-truck',
        };
    }
}
