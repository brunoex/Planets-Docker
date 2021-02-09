<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Planets;

class AddPlanetsType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planets::class,
            'csrf_protection' => false,
            "allow_extra_fields" => true
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Planet name: '])
            ->add('month', IntegerType::class, ['label' => 'How many months a year: '])
            ->add('day', IntegerType::class, ['label' => 'How many days each month: '])
            ->add('save', SubmitType::class, ['attr' => ['class' => 'glow-on-hover']])
        ;
    }
}