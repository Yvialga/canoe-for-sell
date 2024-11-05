<?php

namespace App\Form;

use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options):void {

        $builder
            ->add('boat', ChoiceType::class, [
                'choices' => [
                    'all' => '',
                    'canoe' => "canoe",
                    'kayak' => "kayak",
                ],
                'label' => false,
                'required' => false,
                'attr' => [
                ],
                'placeholder' => false
            ])
            ->add('places', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nombre de places',
                    'class' => "border"
                ]
            ])
            ->add('min', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix min',
                    'class' => "border"
                ]
            ])
            ->add('max', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix max',
                    'class' => "border"
                ]
            ])
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver):void {

        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix():string {
        return '';
    }
}