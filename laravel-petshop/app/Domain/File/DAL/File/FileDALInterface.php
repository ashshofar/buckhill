<?php

namespace App\Domain\File\DAL\File;

use App\Domain\File\Models\File;
use App\DomainUtils\BaseDAL\BaseDALInterface;

interface FileDALInterface extends BaseDALInterface
{
    /**
     * Get file by UUID
     *
     * @param string $uuid
     * @return File
     */
    public function getFileByUuid(string $uuid): File;
}
