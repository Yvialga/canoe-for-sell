<?php

namespace App\Form;

use App\Entity\Boat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoatAdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                "attr" => ['class' => "border"]
            ])
            ->add('boatType', ChoiceType::class, [
                'choices' => [
                    'kayak' => 'kayak',
                    'canoë' => 'canoë'
                ],
                'attr' => ['class' => 'border']
            ])
            ->add('brand', null, [
                "attr" => ['class' => "border"]
            ])
            ->add('numberOfPlaces', NumberType::class, [
                'html5' => true,
                "attr" => ['class' => "border"]
            ])
            ->add('material', null, [
                "attr" => ['class' => "border"]
            ])
            ->add('price', MoneyType::class, [
                "attr" => ['class' => "border"]
            ])
            ->add('description', TextareaType::class, [
                "attr" => ['class' => "border"]
            ])
            ->add('texte', SubmitType::class, [
                'label' => "coucou",
                "attr" => ['class' => "btn"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Boat::class,
        ]);
    }
}
