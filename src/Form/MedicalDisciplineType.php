<?php

namespace App\Form;

use App\Entity\MedicalDiscipline;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MedicalDisciplineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : Kinésithérapeute',
                    'maxlength' => 255,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'Ajouter un profesionnel de santé :',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MedicalDiscipline::class,
        ]);
    }
}
