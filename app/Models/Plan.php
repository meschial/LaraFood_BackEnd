<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
