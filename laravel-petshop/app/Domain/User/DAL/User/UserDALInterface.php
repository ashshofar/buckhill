<?php

namespace App\Domain\User\DAL\User;

use App\Domain\User\Models\User;
use App\Domain\User\Requests\LoginRequest;
use App\DomainUtils\BaseDAL\BaseDALInterface;

interface UserDALInterface extends BaseDALInterface
{
    /**
     * Find User for login
     *
     * @param LoginRequest $request
     * @return User|null
     */
    public function findUserByEmailPassword(LoginRequest $request): User|null;
}
