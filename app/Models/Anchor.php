<?php

namespace voa\Models;

use Illuminate\Database\Eloquent\Model;

class Anchor extends Model
{
    /**
     * Get the programs for the anchor.
     */
    public function programs()
    {
    	return $this->hasMany('voa\Models\Program');
    }
}
