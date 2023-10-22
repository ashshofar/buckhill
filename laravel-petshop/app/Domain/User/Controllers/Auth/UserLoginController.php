<?php

namespace App\Domain\User\Controllers\Auth;

use App\Domain\User\BLL\Auth\AuthBLLInterface;
use App\Domain\User\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Post(
 *     path="/api/v1/user/login",
 *     summary="Login as user",
 *     tags={"User"},
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="application/json",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="email",
 *                      type="string",
 *                      example="nbailey@jacobi.com",
 *                  ),
 *                  @OA\Property(
 *                      property="password",
 *                      type="string",
 *                      example="password",
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
class UserLoginController extends Controller
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
        if (!$user = $this->authBLL->authenticateAdmin($request)) {
            return new ApiErrorResponse(
                trans('auth.failed'),
                Response::HTTP_UNPROCESSABLE_ENTITY,
                null
            );
        }

        return new ApiSuccessResponse(
            ['token' => $this->authBLL->createToken($user)],
            trans('messages.login_success')
        );
    }
}
