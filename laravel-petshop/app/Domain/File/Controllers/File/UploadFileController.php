<?php

namespace App\Domain\File\Controllers\File;

use App\Domain\File\BLL\File\FileBLLInterface;
use App\Domain\File\Requests\UploadFileRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/v1/file/upload",
 *     summary="Upload file",
 *     tags={"File"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\RequestBody(
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  @OA\Property(
 *                      property="file",
 *                      type="file",
 *                      format="file"
 *                  ),
 *                  required={"file"}
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
class UploadFileController extends Controller
{
    private FileBLLInterface $fileBLL;

    public function __construct(FileBLLInterface $fileBLL)
    {
        $this->fileBLL = $fileBLL;
    }

    /**
     * Upload file
     *
     * @param UploadFileRequest $request
     * @return ApiSuccessResponse
     */
    public function __invoke(UploadFileRequest $request): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->fileBLL->uploadFile($request),
            trans('messages.file_uploaded')
        );
    }
}
