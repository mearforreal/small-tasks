<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'message', 'application_id', 'user_id'
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}
