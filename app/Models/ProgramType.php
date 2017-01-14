<?php

namespace voa\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramType extends Model
{
    /**
     * Get the programs for the programType.
     */
    public function programs()
    {
    	return $this->hasMany('voa\Models\Program');
    }
}
