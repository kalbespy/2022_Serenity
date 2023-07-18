<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Welfare;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WelfareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('score', ChoiceType::class, array (
                'choices' => array (
                    'Mal' => 4,
                    'Stressé.e' => 3,
                    'Fatigué.e' => 2,
                    'Bien' => 1,
                ),
                    'expanded' => true,
                    'multiple' => false,
                    'label' => false,
                    'attr' => ['class' => 'check-mood']
            ));
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Welfare::class,
        ]);
    }
}
