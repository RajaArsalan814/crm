<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    use HasFactory;

    public $fillable = ['first_name', 'last_name', 'email','contact','brand','service','user_id','inquiry','social_link'];
    /**
     * Get the user associated with the Leads
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brand()
    {
        return $this->hasOne(Brands::class, 'id', 'brand_id');
    }

    public function service()
    {
        return $this->hasOne(Services::class, 'id', 'service_id');
    }

}
