<?php

namespace EvaluationBundle\Controller;


use EvaluationBundle\Entity\Matiere;
use EvaluationBundle\Form\MatiereType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Matiere controller.
 *
 */
class MatiereController extends Controller
{


       public function AddSubjectAction(Request $request)
       {
           $em = $this->getDoctrine()->getManager();
           $allSubjects = $em->getRepository(Matiere::class)->findAll();
           $dql = "SELECT s FROM EvaluationBundle:Matiere s";
           $query = $em->createQuery($dql);
           /**
            * @var $paginator \Knp\Component\Pager\Paginator
            */
           $paginator = $this->get('knp_paginator');
           $sort = $paginator->paginate($query);
           $subject = new Matiere();
           $form = $this->createForm(MatiereType::class,$subject);
           $form->handleRequest($request);
           if ($form->isSubmitted() and $form->isValid()) {
               $em->persist($subject);
               $em->flush();
               return $this->redirectToRoute("admin_AddSubject");
           }
           return $this->render('@Evaluation\Matiere\AddSubject.html.twig',array('form'=>$form->createView(), 'allSubjects'=>$sort));
       }
    public function searchSubjectAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $searchName = $request->get('searchName');
        $subjects = $em->getRepository('EvaluationBundle:Matiere')->findSubjectByName($searchName);
        if (!$subjects) {
            $result['subjects']['error'] = "There is no Subject with this name ";
        } else {
            $result['subjects'] = $this->getSubjects($subjects);
        }
        return new Response(json_encode($result));
    }

    public function getSubjects($subjects)
    {
        foreach ($subjects as $subjects) {
            $realEntities[$subjects->getId()] = [$subjects->getId(),$subjects->getNom(), $subjects->getCoeff()];

        }
        return $realEntities;
    }
    public function UpdateSubjectAction($id,Request $request){
        $em = $this->getDoctrine()->getManager();
        $allSubjects = $em->getRepository(Matiere::class)->findAll();
        $subject =  $em->getRepository(Matiere::class)->find($id);
        $form = $this->createForm(MatiereType::class,$subject);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $em->persist($subject);
            $em->flush();
            return $this->redirectToRoute("admin_AddSubject");
        }
        return $this->render('@Evaluation\Matiere\UpdateSubject.html.twig',array('form'=>$form->createView(), 'allSubjects'=>$allSubjects));
    }

    public function DeleteSubjectAction($id){
        $em=$this->getDoctrine()->getManager();
        $subject =  $em->getRepository(Matiere::class)->find($id);
        $em->remove($subject);
        $em->flush();
        return $this->redirectToRoute("admin_AddSubject");
    }
}
