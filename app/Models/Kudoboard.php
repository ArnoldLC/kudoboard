<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Kudo;

class Kudoboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'receptor',
        'titulo',
        'user_id'
    ];

    public function kudos() {
        return $this->hasMany(Kudo::class);
    }
}
