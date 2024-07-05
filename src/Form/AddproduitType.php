<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Pro;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddproduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('quantity')
            ->add('price')
            ->add('cat',EntityType::class,[
                'class'=>Category::class,
                'choice_label'=>'name',
                'expanded'=> false,
                'multiple'=>false
            ]
            )
            ->add('save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pro::class,
        ]);
    }
}
