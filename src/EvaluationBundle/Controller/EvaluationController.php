<?php

namespace EvaluationBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class EvaluationController extends Controller
{
    public function TemplateAction()
    {
        return $this->render('EvaluationBundle:Default:back.html.twig');
    }
    public function TemplateFAction()
    {
        return $this->render('@EvaluationBundle/Evaluation/front.html.twig');
    }

}
