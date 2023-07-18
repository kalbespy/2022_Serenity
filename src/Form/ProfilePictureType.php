<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilePictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('profilePicture', VichFileType::class, [
                'label' => false,
                'required'      => false,
                'delete_label' => 'Supprimer ma photo',
                'allow_delete'  => true, // not mandatory, default is true
                'download_label' => 'Télécharger ma photo',
                'download_uri' => true, // not mandatory, default is true
                'attr' => [
                    'class' => 'form-control upload-form-picture'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
