<?php

namespace App\Domain\File\Controllers\File;

use App\Domain\File\BLL\File\FileBLLInterface;
use App\Domain\File\Requests\UploadFileRequest;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;

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
