<?php

namespace App\Domain\User\Controllers\Admin;

use App\Domain\User\BLL\Auth\AuthBLLInterface;
use App\Domain\User\BLL\User\UserBLLInterface;
use App\Domain\User\Requests\AdminCreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;

class AdminCreateController extends Controller
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
     * @param AdminCreateRequest $request
     * @return ApiSuccessResponse
     */
    public function __invoke(AdminCreateRequest $request): ApiSuccessResponse
    {
        $admin = $this->userBLL->createUser($request);
        $this->userBLL->updateRoleToAdmin($admin);
        $admin->token = $this->authBLL->createToken($admin);

        return new ApiSuccessResponse($admin, trans('messages.admin_created'));
    }
}
