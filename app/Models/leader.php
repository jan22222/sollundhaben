<?php

namespace App\Models;

use App\Models\User;
use App\Models\enterprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class leader extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'is_admin',
        'enterprise_id'
    ];

    public function enterprise(){
        $this->belongsTo(enterprise::class);
    }
    public function users(){
        $this->hasMany(User::class);
    }
}
