<?php 
namespace Demo\Service\Common;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public function createService($name)
    {
        $demo_container = $this->getDemoContainer();

        return $demo_container->createService($name);
    }

    public function getDemoContainer()
    {
        return $this->get('demo');
    }
}