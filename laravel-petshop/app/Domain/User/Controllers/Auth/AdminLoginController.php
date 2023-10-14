<?php

namespace App\Domain\User\Controllers\Auth;

use App\Domain\User\BLL\Auth\AuthBLLInterface;
use App\Domain\User\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminLoginController extends Controller
{
    private AuthBLLInterface $authBLL;

    public function __construct(AuthBLLInterface $authBLL)
    {
        $this->authBLL = $authBLL;
    }

    /**
     * @param LoginRequest $request
     * @return ApiSuccessResponse|ApiErrorResponse
     */
    public function __invoke(LoginRequest $request): ApiSuccessResponse|ApiErrorResponse
    {
        if (!$this->authBLL->authenticateAdmin($request)) {
            return new ApiErrorResponse(
                trans('auth.failed'),
                Response::HTTP_UNPROCESSABLE_ENTITY,
                null
            );
        }

        return new ApiSuccessResponse(
            ['token' => $this->authBLL->createToken()],
            'success'
        );
    }
}
