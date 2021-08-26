<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Kudoboard;

class SharedKudoboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kudoboard_id'
    ];

    public function kudoboard() {
        return $this->belongsTo(kudoboard::class);
    }
}
