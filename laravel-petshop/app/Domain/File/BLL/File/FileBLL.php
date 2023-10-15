<?php

namespace App\Domain\File\BLL\File;

use App\Domain\File\Models\File;
use App\Domain\File\Requests\UploadFileRequest;
use App\DomainUtils\BaseBLL\BaseBLL;
use App\DomainUtils\BaseBLL\BaseBLLFileUtils;
use App\Domain\File\DAL\File\FileDALInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

/**
 * @property FileDALInterface DAL
 */
class FileBLL extends BaseBLL implements FileBLLInterface
{
    use BaseBLLFileUtils;

    public function __construct(FileDALInterface $fileDAL)
    {
        $this->DAL = $fileDAL;
    }

    /**
     * @param UploadFileRequest $request
     * @return mixed
     */
    public function uploadFile(UploadFileRequest $request): mixed
    {
        $file = $request->file('file');
        $name = $file->hashName();

        Storage::put("public/".File::PATH_IMAGE, $file);

        return $this->DAL->query()->create([
            'name' => "{$name}",
            'path' => File::PATH_IMAGE,
            'size' => $file->getSize(),
            'type' => $file->getClientMimeType()
        ]);
    }

    /**
     * Get file bu uuid
     *
     * @param string $uuid
     * @return File
     */
    public function getFile(string $uuid): File
    {
        return $this->DAL->getFileByUuid($uuid);
    }
}
