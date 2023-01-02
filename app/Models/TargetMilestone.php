<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetMilestone extends Model
{
    use HasFactory;
    protected $fillable = ['target_id', 'amount', 'user_id', 'is_achieved'];


    public function salestarget(){
        $this->hasOne(SalesTarget::class, 'id', 'target_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}