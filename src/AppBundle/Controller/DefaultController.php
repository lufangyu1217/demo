<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Demo\Service\Common\BaseController;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        $t = $this->getUserService()->get();

        return $this->render('AppBundle::layout.html.twig', array(
            't' => $t
        ));
    }

    public function getUserService()
    {
        return $this->createService('User:UserService');
    }
}
