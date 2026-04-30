<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UploadedDataLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'uploaded_data_logs';

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'createdBy','id');    
    }

     public function profile(): BelongsTo
    {
        return $this->belongsTo(LogbookProfile::class, 'chasisNumber', 'chasisNumber');
    }
}
