<?php

namespace App\Domain\User\BLL\Auth;

use App\Domain\User\Models\User;
use App\Domain\User\Requests\LoginRequest;
use App\DomainUtils\BaseBLL\BaseBLLInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Token\Parser;

interface AuthBLLInterface extends BaseBLLInterface
{
    /**
     * Login admin
     *
     * @param LoginRequest $request
     * @return Authenticatable|bool
     */
    public function authenticateAdmin(LoginRequest $request): Authenticatable|bool;

    /**
     * Create JWT token
     *
     * @param User $user
     * @return string
     */
    public function createToken(User $user): string;

    /**
     * Parsing JWT token
     *
     * @param $bearerToken
     * @return Token
     */
    public function parsingToken($bearerToken): Token;

    /**
     * Validate JWT token
     *
     * @param $bearerToken
     * @return bool
     */
    public function validateToken($bearerToken): bool;

    /**
     * Get user uuid from JWT
     *
     * @param $bearerToken
     * @return mixed
     */
    public function getUserUuid($bearerToken): mixed;

    /**
     * Get user id from token
     *
     * @return mixed
     */
    public function getUserIdFromToken(): mixed;
}
