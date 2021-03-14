<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Plan
 */
class Plan extends Model
{    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['name', 'url', 'price', 'description'];
    
    /**
     * details
     *
     * @return HasMany
     */
    public function details():HasMany
    {
        return $this->hasMany(DetailPlan::class);
    }
    
    /**
     * profiles
     *
     * @return BelongsToMany
     */
    public function profiles():BelongsToMany
    {
        return $this->belongsToMany(Profile::class);
    }
    
    /**
     * search
     *
     * @param  mixed $filter
     * @return void
     */
    public function search($filter = null)
    {
        $resusts = $this
                    ->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate();

        return $resusts;
    }

       
    /**
     * profilesAvailable
     *
     * @param  mixed $filter
     * @return void
     */
    public function profilesAvailable($filter = null)
    {
        $profiles = Profile::whereNotIn('profiles.id', function($query) {
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $profiles;
    }
}
