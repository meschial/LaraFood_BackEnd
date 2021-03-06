<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * DetailPlan
 */
class DetailPlan extends Model
{    
    /**
     * table
     *
     * @var string
     */
    protected $table = 'details_plan';
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['name'];
    
    /**
     * plan
     *
     * @return void
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
