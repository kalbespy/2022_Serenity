<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : Procédure post-opératoire',
                    'maxlength' => 255,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'Titre de la vidéo :',
            ])
            ->add('picture', UrlType::class, [
                'attr' => [
                    'placeholder' => 'Ex : https://www.youtube.com/watch?v=6oJ_VkilrS4',
                    'maxlength' => 255,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'URL de la vidéo (Youtube uniquement):',
                'help' => "1. Rendez vous sur la page Youtube de la vidéo. </br>
                2. Copier l'URL complet de la vidéo qui se trouve dans la barre de recherche. <br>
                3. Coller l'URL dans le champ ci-dessous'.",
                'help_html' => true
            ])
            ->add('duration', NumberType::class, [
                'attr' => [
                    'placeholder' => 10.30,
                    'min' => 0,
                    'max' => 60,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'scale' => 2,
                'required' => true,
                'label' => 'Durée de la vidéo (en minutes) :',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
