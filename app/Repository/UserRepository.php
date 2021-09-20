<?php

namespace App\Repository;

use App\Models\User;

class UserRepository extends Repository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
