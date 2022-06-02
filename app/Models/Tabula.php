<?php

namespace App\Models;

use App\Models\Task;
use App\Models\enterprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tabula extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'soll',
        'haben',
        'enterprise_id'
    ];

    public function enterprise(){
        $this->belongsTo(enterprise::class);
    }
    public function task(){
        $this->hasOne(Task::class);
    }
}