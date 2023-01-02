<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];


    /**
     * Get the user that owns the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
