<?php

namespace App\Form;

use App\Entity\offreEmploi\OffreEmploi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OffreEmploiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Titre')
            ->add('Description')
            ->add('Experience')
            ->add('Emplacement')
            ->add('TypeContrat', ChoiceType::class, [
                'choices'  => [
                    'SIVP' => 'SIVP',
                    'CDD' => 'CDD',
                    'CDI' => 'CDI',
                ],
            ])
            ->add('DateExpiration')
            ->add('etat')
            ->add('categorie',EntityType::class,[
                'class'=>'App\Entity\Categorie\Categorie'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OffreEmploi::class,
        ]);
    }
}
