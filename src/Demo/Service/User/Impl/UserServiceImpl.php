<?php 
namespace Demo\Service\User\Impl;

use Demo\Service\User\UserService;
use Demo\Service\Common\BaseService;

class UserServiceImpl extends BaseService implements UserService
{
    public function get()
    {
        return $this->getUserDao()->get();
    }

    protected function getUserDao()
    {
        return $this->createDao('User:UserDao');
    }
}