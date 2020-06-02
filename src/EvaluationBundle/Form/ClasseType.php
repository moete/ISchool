<?php

namespace EvaluationBundle\Form;


use EvaluationBundle\Entity\Classe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClasseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nbetudiants')->add('nom',ChoiceType::class,array('choices'=>array('3A'=>'3A','3B'=>'3B',' 4 TWIN'=>'4 TWIN','2A'=>'2A')))->add('Add',SubmitType::class , [
            'attr' => ['class' => 'btn-fill-lg btn-gradient-yellow btn-hover-bluedark'],
        ])

            ->add('Reset',ResetType::class, [
                'attr' => ['class' => 'btn-fill-lg bg-blue-dark btn-hover-yellow'],
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EvaluationBundle\Entity\Classe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'evaluationbundle_classe';
    }


}
