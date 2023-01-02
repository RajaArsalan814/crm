<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTarget extends Model
{
    use HasFactory;
    protected $fillable  = ['amount', 'balance', 'milestone','user_id', 'assign_id', 'assign_id',  'is_achieved', 'due_date'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


    public function agentmilestone(){
        return $this->hasMany(TargetMilestone::class, 'target_id', 'id');
    }

    public function assign()
    {
        return $this->hasOne(User::class, 'id', 'assign_id');
    }

}
