<?php

namespace EvaluationBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cC')->add('noteds')->add('noteexamen')->add('subject',EntityType::class,[
            'class' => 'EvaluationBundle\Entity\Matiere',
            'placeholder' => 'Select Class *',
            'mapped' => true
        ])
            ->add('student',EntityType::class,[
                'class' => 'AppBundle\Entity\User',
                'placeholder' => 'Select Student *',
                'mapped' => true
            ])
        ->add('Affect', SubmitType::class , [
            'attr' => ['class' => 'btn-fill-lg btn-gradient-yellow btn-hover-bluedark'],
        ])    ->add('Reset',ResetType::class, [
                'attr' => ['class' => 'btn-fill-lg bg-blue-dark btn-hover-yellow'],
            ]);;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EvaluationBundle\Entity\Note'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'evaluationbundle_note';
    }


}
