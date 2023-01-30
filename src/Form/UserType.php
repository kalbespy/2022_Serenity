<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Secretariat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Ex : dr.noailles@gmail.com',
                    'maxlength' => 255,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'Adresse email :',
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
                'multiple' => true,
                'expanded' => false,
            ])
            ->add('password', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : prénom + date de naissance',
                    'maxlength' => 255,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'Mot de passe :',
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : Jean-Paul',
                    'maxlength' => 255,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'Prénom :',
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : Belmondo',
                    'maxlength' => 255,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'Nom de famille :',
            ])
            ->add('phonenumber', TelType::class, [
                'attr' => [
                    'placeholder' => 'Ex : 0690897867',
                    'pattern' => '^((\+|00)33\s?|0)[67](\s?\d{2}){4}$',
                    'class' => 'crud-input',
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^((\+|00)33\s?|0)[67](\s?\d{2}){4}$/',
                        'message' => 'Le numéro de téléphone n\'est pas valide',
                    ]),
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'Numéro de téléphone :',
            ])
            ->add('secretariat', EntityType::class, [
                'class' => Secretariat::class,
                'choice_label' => 'name'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
