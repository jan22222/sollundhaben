<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'enterprise_id',
        'updated_at',
        'created_at'
    ];
}
