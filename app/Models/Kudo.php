<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Kudo extends Model
{
    use HasFactory;

    protected $table = 'kudos';

    protected $fillable = [
        'descripcion',
        'kudoboard_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
