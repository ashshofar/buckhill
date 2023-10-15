<?php

namespace App\Domain\User\Controllers\User;

use App\Domain\User\BLL\Auth\AuthBLLInterface;
use App\Domain\User\BLL\User\UserBLLInterface;
use App\Domain\User\Requests\UserCreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;

class UserCreateController extends Controller
{

    private UserBLLInterface $userBLL;
    private AuthBLLInterface $authBLL;

    public function __construct(
        AuthBLLInterface $authBLL,
        UserBLLInterface $userBLL
    ) {
        $this->authBLL = $authBLL;
        $this->userBLL = $userBLL;
    }

    /**
     * @param UserCreateRequest $request
     * @return ApiSuccessResponse
     */
    public function __invoke(UserCreateRequest $request): ApiSuccessResponse
    {
        $user = $this->userBLL->createUser($request);
        $user->token = $this->authBLL->createToken($user);

        return new ApiSuccessResponse($user, trans('messages.user_created'));
    }
}
