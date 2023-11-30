<?php

namespace App\Form;

use App\Entity\FicheTechnique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheTechniqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('id') 
            ->add('tax')
            ->add('assurence')
            ->add('visite_tech')
            ->add('vidange')
            ->add('id_v')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FicheTechnique::class,
        ]);
    }
}
