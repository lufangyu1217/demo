<?php 
namespace Demo\Service\Common;

class BaseDao
{
    private $demo_container;

    public function __construct($demo_container)
    {
        $this->demo_container = $demo_container;
    }

    public function db()
    {
        return $this->demo_container['db'];
    }
}