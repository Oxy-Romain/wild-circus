<?php

namespace App\Form;

use App\Entity\Price;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('target', TextType:: class, [
                'label' => 'Target Audience'
            ])
            ->add('week', NumberType::class, [
                'label' => 'Week Price ($)',
                'scale' => 1,
                'required' => false
            ])
            ->add('weekend', NumberType::class, [
                'label' => 'Weekend Price ($)',
                'scale' => 2,
                'required' => false
            ])
            ->add('unit', CheckboxType:: class, [
                'label' => 'Unit Price (don\'t check if you create a group!)',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Price::class,
        ]);
    }
}
