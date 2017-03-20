<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Demo\Service\Common\BaseController;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        $this->getUserService()->get();

        return $this->render('AppBundle::index.html.twig');
    }

    public function getUserService()
    {
        return $this->createService('User:UserService');
    }
}
