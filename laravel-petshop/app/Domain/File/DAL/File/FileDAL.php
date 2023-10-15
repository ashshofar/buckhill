<?php

namespace App\Domain\File\DAL\File;

use App\DomainUtils\BaseDAL\BaseDAL;
use App\Domain\File\Models\File;

/**
 * @property File model
 */
class FileDAL extends BaseDAL implements FileDALInterface
{
    public function __construct(File $file)
    {
        $this->model = $file;
    }

    /**
     * Get file by UUID
     *
     * @param string $uuid
     * @return File
     */
    public function getFileByUuid(string $uuid): File
    {
        return $this->model->where('uuid', $uuid)->firstorFail();
    }
}
