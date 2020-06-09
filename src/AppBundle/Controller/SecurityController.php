<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;


class SecurityController extends Controller
{
    public function addAction()
    {
        return $this->render('AppBundle:Security:admin_home.html.twig');
    }
    public function showParent()
    {
        return$this->render('AppBundle:Security:user_home.html.twig');
    }

    /**
     * @Route("/parent")
     */
    public function parentAction()
    {
        if($this->get(('security_authorization_checker')->isGranted('ROLE_PARENT')))
        {
            return $this->render('@App/Security/admin_home.html.twig');

        }
    }

    /**
     * @Route("/home")
     */
    public function redirectAction()
    {
        $authChecker=$this->container->get('security.authorization_checker');
        dump($authChecker);

        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN'))
        {
            return $this->render('@App/Security/admin_home.html.twig');
        }
        elseif ($this->get('security.authorization_checker')->isGranted('ROLE_USER'))
        {
            return $this->render('@App/Security/user_home.html.twig');
        }

        elseif ($this->get('security.authorization_checker')->isGranted('ROLE_PARENT'))
        {
            return $this->render('parent');

        }
        else
            return $this->render('@FOSUser/Security/user_home.html.twig');


    }




}