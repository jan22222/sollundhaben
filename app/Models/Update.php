<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Update extends Model
{
    use HasFactory;
    protected $fillable = [
        'checked',
        'user_id',
        'topic',
        'message'
    ];
    public function user(){
        return $this->belongsTo(User::class);
     }
}
