<?php

namespace App\Form;

use App\DTO\SearchDishCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchDishType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Rechercher dans le titre :',
                'required' => false,
            ])
            ->add('limit', NumberType::class, [
                'label' => 'Limite :'
            ])
            ->add('page', NumberType::class, [
                'label' => 'N° de page :'
            ])
            ->add('sumit', SubmitType::class, [
                'label' => 'Rechercher'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchDishCriteria::class,
            'method' => 'GET'
        ]);
    }
}
