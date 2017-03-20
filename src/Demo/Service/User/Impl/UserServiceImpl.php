<?php 
namespace Demo\Service\User\Impl;

use Demo\Service\User\UserService;
use Demo\Service\Common\BaseService;

class UserServiceImpl extends BaseService implements UserService
{
    public function get()
    {
        echo "22";
    }
}