<?php

namespace App\Domain\User\BLL\Auth;

use App\Domain\User\Requests\LoginRequest;
use App\DomainUtils\BaseBLL\BaseBLL;
use App\DomainUtils\BaseBLL\BaseBLLFileUtils;
use App\Domain\User\DAL\User\UserDALInterface;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Ecdsa\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;

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
     * @return string
     */
    public function authenticateAdmin(LoginRequest $request): string
    {
        return Auth::attempt($request->only('email', 'password'));
//        if (!Auth::once($request->only('email', 'password'))) {
//            return false;
//        }
//
//        return $this->createToken();
    }

    /**
     * Create JWT token
     *
     * @return string
     */
    public function createToken(): string
    {
        $user = Auth::getUser();
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));

        $token = $tokenBuilder->issuedBy(config('app.url'))
                        ->withClaim('user_uuid', $user->uuid)
                        ->getToken($this->config->signer(), $this->config->signingKey());

        return $token->toString();
    }
}
