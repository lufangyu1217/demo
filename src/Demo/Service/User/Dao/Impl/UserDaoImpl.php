<?php 
namespace Demo\Service\User\Dao\Impl;

use Demo\Service\Common\BaseDao;
use Demo\Service\User\Dao\UserDao;

class UserDaoImpl extends BaseDao implements UserDao
{
    private $table = 'course';

    public function get()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db()->fetchAll($sql);
    }
}