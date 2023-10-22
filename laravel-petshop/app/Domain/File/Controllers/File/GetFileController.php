<?php

namespace App\Domain\File\Controllers\File;

use App\Domain\File\BLL\File\FileBLLInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/v1/file/{uuid}",
 *     summary="Find File",
 *     tags={"File"},
 *    @OA\Parameter(
 *          name="uuid",
 *          in="path",
 *          description="file uuid",
 *          required=true,
 *          @OA\Schema(type="string")
 *    ),
 *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
 *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
 *     @OA\Response(response=422, description="Unprocessable Entity", @OA\JsonContent()),
 *     @OA\Response(response=404, description="Page not found", @OA\JsonContent()),
 *     @OA\Response(response=500, description="Internal server error", @OA\JsonContent())
 * )
 */
class GetFileController extends Controller
{
    private FileBLLInterface $fileBLL;

    public function __construct(FileBLLInterface $fileBLL)
    {
        $this->fileBLL = $fileBLL;
    }

    /**
     * Get file
     *
     * @param string $uuid
     * @return ApiSuccessResponse
     */
    public function __invoke(string $uuid): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->fileBLL->getFile($uuid),
            'File Uploaded'
        );
    }
}
