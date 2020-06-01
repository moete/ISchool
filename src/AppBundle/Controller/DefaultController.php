<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    public function frontAction()
    {
        // replace this example code with whatever you need
        return $this->render('baseFront.html.twig');
    }
    public function backAction()
    {
        // replace this example code with whatever you need
        return $this->render('base.html.twig');
    }
    public function BaseAction()
    {
        // replace this example code with whatever you need
        return $this->render('templatelogin.twig');
    }


}
