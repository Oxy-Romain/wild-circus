<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Member;
use App\Entity\Perform;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType:: class, [
                'label' => 'Name'
            ])
            ->add('image', TextType:: class, [
                'label' => 'Image'
            ])
            ->add('Job')
            ->add('perform', EntityType::class, [
                'class' => Perform::class,
                'choice_label' => 'title',
                'label' => 'Perform',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.title', 'ASC');
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
