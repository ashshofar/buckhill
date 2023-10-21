<?php

namespace App\Domain\User\BLL\Auth;

use App\Domain\User\Models\User;
use App\Domain\User\Requests\LoginRequest;
use App\DomainUtils\BaseBLL\BaseBLL;
use App\DomainUtils\BaseBLL\BaseBLLFileUtils;
use App\Domain\User\DAL\User\UserDALInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Ecdsa\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Validator;

class AuthBLL extends BaseBLL implements AuthBLLInterface
{
    use BaseBLLFileUtils;

    private Configuration $config;

    public function __construct(UserDALInterface $userDAL)
    {
        $this->DAL = $userDAL;
        $this->config = Configuration::forAsymmetricSigner(
            new Sha256(),
            InMemory::file(base_path() . '/ec-secp256k1-priv-key.pem'),
            InMemory::file(base_path() . '/ec-secp256k1-pub-key.pem')
        );
    }

    /**
     * Login admin
     *
     * @param LoginRequest $request
     * @return Authenticatable|bool
     */
    public function authenticateAdmin(LoginRequest $request): Authenticatable|bool
    {
        if (!Auth::once($request->only('email', 'password'))) {
            return false;
        }

        return Auth::user();
    }

    /**
     * Create JWT token
     *
     * @param User $user
     * @return string
     */
    public function createToken(User $user): string
    {
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));

        $token = $tokenBuilder->issuedBy(config('app.url'))
                        ->withClaim('user_uuid', $user->uuid)
                        ->getToken($this->config->signer(), $this->config->signingKey());

        return $token->toString();
    }

    /**
     * Parsing JWT token
     *
     * @param $bearerToken
     * @return Token
     */
    public function parsingToken($bearerToken): Token
    {
        $parser = new Parser(new JoseEncoder());
        return $parser->parse($bearerToken);
    }

    /**
     * Validate JWT token
     *
     * @param $bearerToken
     * @return bool
     */
    public function validateToken($bearerToken): bool
    {
        $token = $this->parsingToken($bearerToken);

        $validator = new Validator();

        if (
            !$validator->validate($token, new SignedWith($this->config->signer(), $this->config->verificationKey())) ||
            is_null($this->DAL->findUserByUuid($this->getUserUuid($bearerToken)))
        ) {
            return false;
        }

        return true;
    }

    /**
     * Get user uuid from JWT
     *
     * @param $bearerToken
     * @return mixed
     */
    public function getUserUuid($bearerToken): mixed
    {
        $token = $this->parsingToken($bearerToken);
        return $token->claims()->get('user_uuid');
    }

    /**
     * Get user id from token
     *
     * @return mixed
     */
    public function getUserIdFromToken(): mixed
    {
        $token = request()->bearerToken();
        $uuid = $this->getUserUuid($token);
        return $this->DAL->findUserByUuid($uuid)->id;
    }

    /**
     * Get user from token
     *
     * @return User|null
     */
    public function getUserFromToken(): ?User
    {
        $token = request()->bearerToken();
        $uuid = $this->getUserUuid($token);

        return $this->DAL->findUserByUuid($uuid);
    }
}
