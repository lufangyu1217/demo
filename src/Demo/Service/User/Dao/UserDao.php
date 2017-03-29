<?php 
namespace Demo\Service\User\Dao;

interface UserDao
{
    public function get();

    public function update($item, $total, $less, $redundant);

    public function updateTwo($name, $less, $redundant);
}