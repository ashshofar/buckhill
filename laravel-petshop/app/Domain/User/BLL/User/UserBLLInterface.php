<?php

namespace App\Domain\User\BLL\User;

use App\Domain\User\Models\User;
use App\Domain\User\Requests\AdminCreateRequest;
use App\Domain\User\Requests\UserCreateRequest;
use App\DomainUtils\BaseBLL\BaseBLLInterface;

interface UserBLLInterface extends BaseBLLInterface
{
    /**
     * Create user or admin
     *
     * @param UserCreateRequest|AdminCreateRequest $request
     * @return User
     */
    public function createUser(UserCreateRequest|AdminCreateRequest $request): User;

    /**
     * Assign role admin to user
     *
     * @param User $user
     * @return void
     */
    public function updateRoleToAdmin(User $user): void;
}
