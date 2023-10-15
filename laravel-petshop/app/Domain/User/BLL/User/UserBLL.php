<?php

namespace App\Domain\User\BLL\User;

use App\Domain\User\Models\User;
use App\Domain\User\Requests\AdminCreateRequest;
use App\Domain\User\Requests\UserCreateRequest;
use App\DomainUtils\BaseBLL\BaseBLL;
use App\DomainUtils\BaseBLL\BaseBLLFileUtils;
use App\Domain\User\DAL\User\UserDALInterface;

/**
 * @property UserDALInterface DAL
 */
class UserBLL extends BaseBLL implements UserBLLInterface
{
    use BaseBLLFileUtils;

    public function __construct(UserDALInterface $userDAL)
    {
        $this->DAL = $userDAL;
    }

    /**
     * Create user or admin
     *
     * @param UserCreateRequest|AdminCreateRequest $request
     * @return User
     */
    public function createUser(UserCreateRequest|AdminCreateRequest $request): User
    {
        return $this->DAL->create($request->toArray());
    }

    /**
     * Assign role admin to user
     *
     * @param User $user
     * @return void
     */
    public function updateRoleToAdmin(User $user): void
    {
        $user->is_admin = true;
        $user->update();
    }
}
