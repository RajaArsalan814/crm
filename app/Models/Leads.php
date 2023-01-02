<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    use HasFactory;

    /**
     * Get the user associated with the Leads
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function brand()
    {
        return $this->hasOne(Brands::class, 'id', 'brand_id');
    }

}
