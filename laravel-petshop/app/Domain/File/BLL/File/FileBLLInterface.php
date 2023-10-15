<?php

namespace App\Domain\File\BLL\File;

use App\Domain\File\Models\File;
use App\Domain\File\Requests\UploadFileRequest;
use App\DomainUtils\BaseBLL\BaseBLLInterface;

interface FileBLLInterface extends BaseBLLInterface
{
    /**
     * @param UploadFileRequest $request
     * @return mixed
     */
    public function uploadFile(UploadFileRequest $request): mixed;

    /**
     * Get file bu uuid
     *
     * @param string $uuid
     * @return File
     */
    public function getFile(string $uuid): File;
}
