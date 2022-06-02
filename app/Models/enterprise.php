<?php

namespace App\Models;

use App\Models\User;
use App\Models\leader;
use App\Models\Tabula;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class enterprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'register_code'
    ];

    public function leader(){
        return $this->hasOne(leader::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function tabulas(){
        return $this->hasMany(Tabula::class);
    }
}
