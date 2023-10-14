<?php

namespace App\Http\Middleware;

use App\Domain\User\BLL\Auth\AuthBLLInterface;
use App\Http\Responses\ApiErrorResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class JwtMiddleware
{
    private AuthBLLInterface $authBLL;

    public function __construct(AuthBLLInterface $authBLL)
    {
        $this->authBLL = $authBLL;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response|ApiErrorResponse
     */
    public function handle(Request $request, Closure $next): Response|ApiErrorResponse
    {
        try {
            // Validate token
            if (!$this->authBLL->validateToken($request->bearerToken())) {
                return new ApiErrorResponse(
                    trans('auth.unauthorized'),
                    Response::HTTP_UNAUTHORIZED
                );
            }
        } catch (Throwable $e) {
            return new ApiErrorResponse(
                trans('auth.unauthorized'),
                Response::HTTP_UNAUTHORIZED
            );
        }

        return $next($request);
    }
}
