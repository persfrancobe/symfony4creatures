<?php

namespace App\Form;

use App\Entity\Creatures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreaturesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('textelead')
            ->add('textesuite')
            ->add('datecreation')
            ->add('image')
            ->add('slug')
            ->add('film')
            ->add('tag')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Creatures::class,
        ]);
    }
}
