<?php
namespace EvaluationBundle\Controller;


use EvaluationBundle\Entity\Classe;
use EvaluationBundle\Form\ClasseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClasseController extends Controller
{
    public function AddClasseAction(Request $request)
{


    $em = $this->getDoctrine()->getManager();
    $allNotes = $em->getRepository(Classe::class)->findAll();



    $note = new Classe();
    $form = $this->createForm(ClasseType::class,$note);
    $form->handleRequest($request);
    if ($form->isSubmitted() and $form->isValid()) {
        $em->persist($note);
        $em->flush();
        return $this->redirectToRoute("admin_AddClasse");
    }
    return $this->render('@Evaluation\Classe\AddClass.html.twig',array('form'=>$form->createView(), 'allNotes'=>$allNotes));
}




}