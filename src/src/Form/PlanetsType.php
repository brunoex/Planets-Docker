<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Planets;

class PlanetsType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planets::class,
            'choices' => null,
            'csrf_protection' => false,
            "allow_extra_fields" => true
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $choices = [];

        foreach($options['choices'] as $planetChoice) {
            $choices[$planetChoice->getName()] = $planetChoice->getId();
        }

        $builder
            ->add('name', ChoiceType::class, [
                'choices' => $choices,
                'label' => 'Select your planet: '
            ])
            ->add(
                'date', 
                DateType::class, 
                [
                    'label' => 'What Terran date do you want to calculate: ',
                ]
            )
            ->add(
                'calculate', 
                SubmitType::class, 
                [
                    'attr' => ['class' => 'glow-on-hover']
                ]
            );
    }
}