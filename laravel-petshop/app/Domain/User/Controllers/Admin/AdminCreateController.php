<?php

namespace App\Domain\User\Controllers\Admin;

use App\Domain\User\BLL\Auth\AuthBLLInterface;
use App\Domain\User\BLL\User\UserBLLInterface;
use App\Domain\User\Requests\AdminCreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/admin/create",
 *     summary="Create admin",
 *     tags={"Admin"},
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="first_name",
 *                      type="string",
 *                      example="ikhsan"
 *                  ),
 *                  @OA\Property(
 *                      property="last_name",
 *                      type="string",
 *                      example="nugraha"
 *                  ),
 *                  @OA\Property(
 *                      property="email",
 *                      type="string",
 *                      example="inu@example.com"
 *                  ),
 *                  @OA\Property(
 *                      property="password",
 *                      type="string",
 *                      example="user"
 *                  ),
 *                 @OA\Property(
 *                      property="password_confirmation",
 *                      type="string",
 *                      example="user"
 *                  ),
 *                @OA\Property(
 *                      property="address",
 *                      type="string",
 *                      example="address"
 *                  ),
 *                @OA\Property(
 *                      property="phone_number",
 *                      type="string",
 *                      example="0811122299"
 *                  ),
 *               @OA\Property(
 *                      property="avatar",
 *                      type="string",
 *                      example="6d9bffd4-3330-49e0-a78f-cc6e848011de"
 *                  ),
 *              )
 *          )
 *     ),
 *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
 *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
 *     @OA\Response(response=422, description="Unprocessable Entity", @OA\JsonContent()),
 *     @OA\Response(response=404, description="Page not found", @OA\JsonContent()),
 *     @OA\Response(response=500, description="Internal server error", @OA\JsonContent())
 * )
 */
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
