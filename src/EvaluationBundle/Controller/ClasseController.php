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

    $Classe = new Classe();
    $form = $this->createForm(ClasseType::class, $Classe);
    $form = $form->handleRequest($request);
    if ($form->isSubmitted() and $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($Classe);
        $em->flush();
        return $this->redirectToRoute('admin_AddClasse');
    }
    return $this->render('@Evaluation/Classe/AddClass.html.twig', array('allClasses'=>$form->createView()));

}


}