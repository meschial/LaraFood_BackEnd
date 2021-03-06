<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Profile
 */
class Profile extends Model
{    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
}
