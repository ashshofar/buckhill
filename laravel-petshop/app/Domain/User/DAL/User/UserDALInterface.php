<?php

namespace App\Domain\User\DAL\User;

use App\Domain\User\Models\User;
use App\Domain\User\Requests\LoginRequest;
use App\DomainUtils\BaseDAL\BaseDALInterface;

interface UserDALInterface extends BaseDALInterface
{
    /**
     * Find User by uuid
     *
     * @param string $uuid
     * @return User|null
     */
    public function findUserByUuid(string $uuid): User|null;
}
