<?php

namespace voa\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    /**
     * Get the anchor that owns the programs.
     */
    public function anchor()
    {
    	return $this->belongsTo('voa\Models\Anchor');
    }

    /**
     * Get the programType that owns the programs.
     */
    public function programType()
    {
    	return $this->belongsTo('voa\Models\ProgramType');
    }    
}
