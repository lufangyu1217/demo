<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Demo\Service\Common\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends BaseController
{
    private $defaults = array();

    public function indexAction(Request $request)
    {
        $t = $this->getUserService()->get();

        return $this->render('AppBundle::layout.html.twig', array(
            't' => $t
        ));
    }

    public function boxAction(Request $request)
    {
        $fields = $request->request->all(); 

        if ($request->getMethod() == 'POST') {
            try {
                $this->checkUser($fields['people'], $fields['password']);
                $this->getUserService()->update($fields);

                return new JsonResponse(true);
            } catch (\Exception $e) {
                return new JsonResponse(false);
            }
        }

        $items = $this->getUserService()->get();
        $total = 0;
        foreach ($items as $item) {
            $total += $item['total'];
        }
        return $this->render('AppBundle::layout.html.twig', array(
            'items' => $this->getUserService()->get(),
            'total' => $total
        ));
    }
    
    private function checkUser($name, $password)
    {
        $standard = array(
            'criss'    => '123',
            'xiaoZhu'  => '321',
            'lufangyu' => '123456'
        );

        if ($standard[$name] != $password) {
            throw new \Exception;
        }
    }

    public function getUserService()
    {
        return $this->createService('User:UserService');
    }
}
