<?php

namespace App\Models;

use App\Models\User;
use App\Models\Tabula;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'user_id',
        'tabula_id',
        'enterprise_id',
        'completed_at'
    ];
    // protected $rules = [
    //     'tabula_id' => 'sometimes|required|email|unique:users',
    // ];
    public function user(){
       return $this->belongsTo(User::class);
    }
    
    public function tabula(){
        return $this->belongsTo(Tabula::class);
    }
}
