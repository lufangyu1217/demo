<?php 
namespace Demo\Service\Common;

class BaseService
{
    private $demo_container;

    public function __construct($demo_container)
    {
        $this->demo_container = $demo_container;
    }

    public function createDao($name)
    {
        $demo_container->createDao($name);
    }
}