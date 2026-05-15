<?php

namespace App\Enums;

enum UploadProcessTypeEnum: string
{
    case BULK_UPLOAD_REQUEST = '1';
    case UPDATE_REQUEST = '2';

    case DISPATCHED = '3';
    case DIRECT_TRANSFER_UPLOAD = '8';


    public function label(): string
    {
        return match ($this) {
            self::BULK_UPLOAD_REQUEST => 'Bulk Upload Request',
            self::UPDATE_REQUEST => 'Update Request',
            self::DISPATCHED => 'Dispatched',
            self::DIRECT_TRANSFER_UPLOAD => 'Direct Transfer Upload',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::BULK_UPLOAD_REQUEST => 'warning',
            self::UPDATE_REQUEST => 'indigo',
            self::DIRECT_TRANSFER_UPLOAD => 'success',
            self::DISPATCHED => 'primary',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::BULK_UPLOAD_REQUEST => 'heroicon-m-lock-open',
            self::UPDATE_REQUEST => 'heroicon-m-arrow-path-rounded-square',
            self::DISPATCHED => 'heroicon-m-check-circle',
            self::DIRECT_TRANSFER_UPLOAD => 'heroicon-m-truck',
 
        };
    }
}
