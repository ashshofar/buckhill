<?php

namespace App\Domain\User\BLL\Auth;

use App\Domain\User\Models\User;
use App\Domain\User\Requests\LoginRequest;
use App\DomainUtils\BaseBLL\BaseBLLInterface;

interface AuthBLLInterface extends BaseBLLInterface
{
    /**
     * @param LoginRequest $request
     * @return string
     */
    public function authenticateAdmin(LoginRequest $request): string;

    /**
     * Create JWT token
     *
     * @return string
     */
    public function createToken(): string;
}
