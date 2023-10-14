<?php

namespace App\Domain\User\BLL\Auth;

use App\Domain\User\Models\User;
use App\Domain\User\Requests\LoginRequest;
use App\DomainUtils\BaseBLL\BaseBLLInterface;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Token\Parser;

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
}
