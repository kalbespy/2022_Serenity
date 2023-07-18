<?php

namespace App\Form;

use App\Entity\MedicalCourse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MedicalCourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('step', IntegerType::class, [
                'attr' => [
                    'placeholder' => 1,
                    'min' => 1,
                    'max' => 20,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'Numéro d\'étape de l\'hospitalisation :',
            ])
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : Consultation pré-opératoire',
                    'maxlength' => 255,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'Nom de l\'étape :',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MedicalCourse::class,
        ]);
    }
}
