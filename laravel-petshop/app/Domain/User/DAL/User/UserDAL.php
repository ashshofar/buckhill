<?php

namespace App\Domain\User\DAL\User;

use App\Domain\User\Models\User;
use App\DomainUtils\BaseDAL\BaseDAL;

/**
 * @property User model
 */
class UserDAL extends BaseDAL implements UserDALInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Find User by uuid
     *
     * @param string $uuid
     * @return User|null
     */
    public function findUserByUuid(string $uuid): User|null
    {
        return $this->model->where('uuid', $uuid)->firstOrFail();
    }
}
