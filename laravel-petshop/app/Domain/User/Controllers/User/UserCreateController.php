<?php

namespace App\Domain\User\Controllers\User;

use App\Domain\User\BLL\Auth\AuthBLLInterface;
use App\Domain\User\BLL\User\UserBLLInterface;
use App\Domain\User\Requests\UserCreateRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/user/create",
 *     summary="Create User",
 *     tags={"User"},
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
class UserCreateController extends Controller
{
    public function __construct(
        public AuthBLLInterface $authBLL,
        public UserBLLInterface $userBLL
    ) {}

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
