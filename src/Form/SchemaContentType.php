<?php

namespace App\Form;

use App\Entity\SchemaContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SchemaContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('picture')
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : Système digestif',
                    'maxlength' => 255,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'Schéma médical :',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SchemaContent::class,
        ]);
    }
}
