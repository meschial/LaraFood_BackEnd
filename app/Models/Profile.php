<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
      
    /**
     * permissions
     *
     * @return BelongsToMany
     */
    public function permissions():BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * permissions
     *
     * @return BelongsToMany
     */
    public function plans():BelongsToMany
    {
        return $this->belongsToMany(Plan::class);
    }
    
    /**
     * permissionsAvailable
     *
     * @return void
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIn('permissions.id', function($query){
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter){
            if($filter){
                $queryFilter->where('permissions.name', 'like', "%{$filter}%");
            }
        })
        ->paginate();

        return $permissions;
    }
}
