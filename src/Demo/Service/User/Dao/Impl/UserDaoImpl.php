<?php 
namespace Demo\Service\User\Dao\Impl;

use Demo\Service\Common\BaseDao;
use Demo\Service\User\Dao\UserDao;

class UserDaoImpl extends BaseDao implements UserDao
{
    private $table = 'demo';

    public function get()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->db()->fetchAll($sql);
    }

    public function update($item, $total, $less, $redundant)
    {
        $sql = "UPDATE {$this->table} SET items = '{$item['items']}',total = '{$total}', less = '{$less}', redundant = '{$redundant}' WHERE name = '{$item['name']}'";

        return $this->db()->exec($sql);
    }

    public function updateTwo($name, $less, $redundant)
    {
        $sql = "UPDATE {$this->table} SET less = '{$less}', redundant = '{$redundant}' WHERE name = '{$name}'";

        return $this->db()->exec($sql);
    }
}