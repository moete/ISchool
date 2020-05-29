<?php

namespace EvaluationBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbsentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('heureDeb',ChoiceType::class,[
            'choices'=>[
                'Please Select*'=>false,
                '8'=>'8:00',
                '9'=>'9:00',
                '10'=>'10:00',
                '11'=>'11:00',
                '14'=>'14:00',
            ],
            'required' =>true
        ])
            ->add('heureFin',ChoiceType::class,[
                'choices'=>[
                    'Please Select*'=>false,
                    '8'=>'8:00',
                    '9'=>'9:00',
                    '10'=>'10:00',
                    '11'=>'11:00',
                    '14'=>'14:00',
                ],
                'required' =>true
            ])
            ->add('jour')->add('student')
            ->add('Save',SubmitType::class , [
                'attr' => ['class' => 'btn-fill-lg btn-gradient-yellow btn-hover-bluedark'],
            ])
            ->add('Reset',ResetType::class, [
                'attr' => ['class' => 'btn-fill-lg bg-blue-dark btn-hover-yellow']
            ]);;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EvaluationBundle\Entity\absence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'evaluationbundle_absence';
    }


}
