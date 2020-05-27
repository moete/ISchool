<?php

namespace EvaluationBundle\Controller;



use AppBundle\Entity\User;
use EvaluationBundle\Entity\note;
use EvaluationBundle\Form\NoteType;
use EvaluationBundle\Form\ParentsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Note controller.
 *
 */
class NoteController extends Controller
{
    public function AffectMarkAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $allNotes = $em->getRepository(note::class)->findAll();
        //$allusers =$em->getRepository(User::ROLE_DEFAULT)->findAll();
        $dql = "SELECT s FROM EvaluationBundle:note s";
        $query = $em->createQuery($dql);
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $sort = $paginator->paginate($query);
        $note = new note();
        $form = $this->createForm(NoteType::class,$note);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $em->persist($note);
            $em->flush();
            return $this->redirectToRoute("AffectMark");
        }
        return $this->render('@Evaluation\notes\AffectMark.html.twig',array('form'=>$form->createView(), 'allNotes'=>$sort));
    }
    public function marksViewAction()
    {

        $mark = $this->getDoctrine()->getRepository(note::class)->findAll();
        return $this->render('@Evaluation/notes/MarksView.html.twig',array('mark'=>$mark));
    }
    public function AjoutFrontAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $allUsers = $em->getRepository(User::class)->findAll();
        $user = new User();
        $form = $this->createForm(ParentsType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $id = $user->getId();
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $username = $firstName . '.' . $lastName;
            $pwd = password_hash($id, PASSWORD_BCRYPT);
            $user->setPassword($pwd);
            $user->setUsername($username);
            $user->setEnabled(0);

            $user->setUserType("Parent");
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("ajout_front");

        }
        return $this->render('@Evaluation/notes/ajoutParent.html.twig', array('form' => $form->createView(), 'allUsers' => $allUsers));
    }
    public function AfficherParentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $nbp= $em->getRepository(User::class)->countParent();

        $dql= "SELECT pa FROM AppBundle:User  pa WHERE pa.userType = 'Parent'";
        $query=$em->createQuery($dql);
        /**
         * @var @paginator \knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $request= $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/

        );

        return $this->render('@Evaluation/notes/afficherparent.html.twig',
            array('var' => $request,'nbp'=>$nbp));


    }


    public function AjoutParentAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $allUsers = $em->getRepository(User::class)->findAll();
        $user = new User();
        $form = $this->createForm(ParentsType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $id = $user->getId();
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $username = $firstName . '.' . $lastName;
            $pwd = password_hash($id, PASSWORD_BCRYPT);
            $user->setPassword($pwd);
            $user->setUsername($username);
            $user->setEnabled(0);

            $user->setId($id);
            $user->setUserType("Parent");
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("inscription_parent");

        }
        return $this->render('@Evaluation/notes/inscriparent.html.twig', array('form' => $form->createView(), 'allUsers' => $allUsers));
    }
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $posts = $em->getRepository('AppBundle:User')->findUserByName($requestString);
        if (!$posts) {
            $result['posts']['error'] = "Post Not found  ";
        } else {
            $result['posts'] = $this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($posts)
    {
        foreach ($posts as $posts) {
            $realEntities[$posts->getId()] = [$posts->getId(),$posts-> getFirstName(), $posts->getLastName(),$posts-> getGender(),$posts->getOccupation(),$posts->getEmail()];
        }
        return $realEntities;
    }
    public function AccepterParentAction($id)
    {
        $user = new User();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $user->setEnabled(1);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('afficher_parent');


    }

    public function RefuserParentAction($id)
    {
        $user = new User();
        $em = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $user->setEnabled(0);
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('afficher_parent');
    }
    public function DetailParentAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $var = $em->getRepository('AppBundle:User')->find($id);
        return $this->render('@Evaluation/notes/detailparent.html.twig', array(
            'var' => $var));


    }
    /**
     *  Render in a PDF the pdf_homepage URL
     * @return Response
     */
    public function DisplayPDFAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $user =  $em->getRepository(User::class)->find($id);
        $snappy = $this->get('knp_snappy.pdf');
        $html = $this->renderView('@Evaluation\notes\PDF.html.twig',array(
            'base_dir' => $this->get('kernel')->getRootDir() . '/../web' . $request->getBasePath(),'var'=>$user
        ));
        $filename = 'firstPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"',

            )
        );
    }

}