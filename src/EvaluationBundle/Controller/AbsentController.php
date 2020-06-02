<?php

namespace EvaluationBundle\Controller;

use AppBundle\Entity\User;
use EvaluationBundle\Entity\absence;
use EvaluationBundle\Form\AbsentType;
use EvaluationBundle\Form\TeacherType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AbsentController extends Controller
{
    public function AddTeacherAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $allUsers = $em->getRepository(User::class)->findAll();
        $user = new User();
        $user->setUser($this->get('security.token_storage')->getToken()->getUser());
        $user->setRoles(array("ROLE_PROFESSEUR"));

        $form = $this->createForm(TeacherType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $id = $user->getId();
            $firstName = $user->getFirstName();
            $lastName = $user->getLastName();
            $username = $firstName . '.' . $lastName;
            $pwd = password_hash($id, PASSWORD_BCRYPT);
            $user->setPassword($pwd);
            $user->setUsername($username);
            $user->setEnabled(1);
            $user->setId($id);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setUserType("Teacher");
            $email = $user->getEmail();


            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute("addTeacher");


        }
        return $this->render('@Evaluation/absence/addTeacher.html.twig', array('form' => $form->createView(), 'allUsers' => $allUsers));


    }

    public function ShowTeacherAction()
    {
        $var = $this->getDoctrine()->getRepository(User::class)->findBy(array('userType' => "Teacher"));
        return $this->render('@Evaluation/absence/showTeacher.html.twig',
            array(
                'var' => $var
            ));

    }

    public function ShowAbsenceAction(Request $request, $id)
    {

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $var = $this->getDoctrine()->getRepository(AbsentType::class)->findBy(array('student' => $id));
        $nb = $this->getDoctrine()->getRepository('EvaluationBundle:AbsentType')->countAbsence($id);
        return $this->render('@Evaluation/absence/showAbsent.html.twig',
            array(
                'var' => $var, 'user' => $user , 'nb' => $nb
            ));

    }

    public function AddAbsAction(Request $request, $id)
    {

        $absence = new absence();
        $form = $this->createForm(AbsentType::class, $absence);
        $form->handleRequest($request);
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUserType("Etudiant");
            $absence->setStudent($user);


            $em = $this->getDoctrine()->getManager();
            $em->persist($absence);
            $em->flush();


            return $this->redirectToRoute("etudiant_list");

        }

        return $this->render('@Evaluation\absence\addAbsence.hmtl.twig',
            array(
                'form' => $form->createView()
            , 'id' => $id));
    }

    public function allstudentsAction()
    {
        $allstudents = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['userType' => 'Etudiant']
        );
        return $this->render('@Evaluation/absence/allstudents.html.twig', array(
            'students' => $allstudents
        ));
    }

    public function ShowStudentDetailsAction($id)
    {


        $em = $this->getDoctrine()->getManager();
        $var = $em->getRepository('AppBundle:User')->find($id);
        $nb = $em->getRepository('EvaluationBundle:absence')->countAbsence($id);
        $nb1 = $em->getRepository('EvaluationBundle:absence')->findAb($id);

        return $this->render('@Evaluation/absence/showDetailStudent.html.twig', array(
            'var' => $var, 'nb' => $nb, 'nb1' => $nb1));
    }

    //FRONT
    public function ShowTeacherDetailsFAction($id)
    {

        $activeuser = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $var = $em->getRepository('AppBundle:User')->find($id);
        $userType = $var->getUserType();
        if ($userType == 'Etudiant') {
            $ab = $em->getRepository('EvaluationBundle:absence')->findOneBy(array('student' => $id));
            return $this->render('@Evaluation/absence/Front/showTeacherDetailsF.html.twig', array(
                'var' => $var, 'ab' => $ab));
        }

        return $this->redirectToRoute("templatefront_aff");
    }

    public function InterfaceAction($id)
    {


        return $this->render('@Evaluation/absence/Front/interfaceTeacher.html.twig');

    }
}

