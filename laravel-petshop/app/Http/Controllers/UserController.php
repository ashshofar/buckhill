<?php

namespace App\Http\Controllers;

use DateTimeImmutable;
use Illuminate\Http\Request;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\JwtFacade;
use Lcobucci\JWT\Signer\Ecdsa\Sha256;
use Lcobucci\JWT\Signer\Eddsa;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Validator;
use Lcobucci\JWT\Token\Parser;


class UserController extends Controller
{
    private Configuration $config;

    public function __construct()
    {
        $this->config = Configuration::forAsymmetricSigner(
            new Sha256(),
            InMemory::file(base_path() . '/ec-secp256k1-priv-key.pem'),
            InMemory::file(base_path() . '/ec-secp256k1-pub-key.pem')
        );
    }

    public function createToken()
    {
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));

        $now = new DateTimeImmutable();
        $token = $tokenBuilder->issuedBy('http://example.com')
                            ->permittedFor('http://example.com')
                            ->identifiedBy('4f1g23a12aa')
                            ->issuedAt($now)
                            ->withClaim('uid', 1)
                            ->withHeader('foo', 'bar')
                            ->getToken($this->config->signer(), $this->config->signingKey());

        return response()->json($token->toString());
    }

    public function parsingToken()
    {
        $jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiIsImZvbyI6ImJhciJ9.eyJpc3MiOiJodHRwOi8vZXhhbXBsZS5jb20iLCJhdWQiOiJodHRwOi8vZXhhbXBsZS5jb20iLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTY5NzAzODUwNi43MjgxNiwidWlkIjoxfQ.7RpkYs1TzOosJxNp2iTK8SWDmDs_auwa3nsW4No1TT7stglQ3h9Ma4rz2PcHISXBm_nI7S49Gxb00WyGHyGB3g";
        $parser = new Parser(new JoseEncoder());
        $token = $parser->parse($jwt);
        $validator = new Validator();

        $result = $validator->validate(
            $token,
            new SignedWith(
                new Sha256(),
                InMemory::file(base_path() . '/ec-secp256k1-pub-key.pem')
            )
        );

        return response()->json($result);
    }
}
