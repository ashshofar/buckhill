<?php

namespace App\Domain\File\Controllers\File;

use App\Domain\File\BLL\File\FileBLLInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;

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
