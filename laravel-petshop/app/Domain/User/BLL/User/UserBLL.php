<?php

namespace App\Domain\User\BLL\User;

use App\DomainUtils\BaseBLL\BaseBLL;
use App\DomainUtils\BaseBLL\BaseBLLFileUtils;
use App\Domain\User\DAL\User\UserDALInterface;

/**
 * @property UserDALInterface DAL
 */
class UserBLL extends BaseBLL implements UserBLLInterface
{
    use BaseBLLFileUtils;

    public function __construct(UserDALInterface $userDAL)
    {
        $this->DAL = $userDAL;
    }
}
