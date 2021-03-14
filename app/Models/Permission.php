<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

         
    /**
     * profiles
     *
     * @return BelongsToMany
     */
    public function profiles():BelongsToMany
    {
        return $this->belongsToMany(Profile::class);
    }
}
