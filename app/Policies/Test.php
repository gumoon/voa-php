<?php

namespace voa\Policies;

use voa\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Test
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
