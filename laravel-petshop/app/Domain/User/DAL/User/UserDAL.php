<?php

namespace App\Domain\User\DAL\User;

use App\Domain\User\Requests\LoginRequest;
use App\DomainUtils\BaseDAL\BaseDAL;
use App\Domain\User\Models\User;
use Illuminate\Support\Facades\Hash;

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
     * Find User for login
     *
     * @param LoginRequest $request
     * @return User|null
     */
    public function findUserByEmailPassword(LoginRequest $request): User|null
    {
        dd(Hash::make($request->input('password')));
        return $this->model->where('email', $request->input('email'))
                ->where('password', Hash::make($request->input('password')))
                ->first();
    }
}
