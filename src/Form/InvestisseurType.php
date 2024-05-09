<?php

namespace App\Form;

use App\Entity\Investisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvestisseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('email')
            ->add('compteBancaire')
            ->add('address')
            ->add('contact')
            ->add('SecteurInteret', ChoiceType::class, [
                'choices' => array_flip(Investisseur::SECTEUR_INTERET),
                'label' => 'Secteur d\'Intérêt',
                'placeholder' => 'Choisir un secteur d\'intérêt',
                'required' => true,
                'attr' => ['class' => 'form-control', 'id' => 'secteur_interet'],
            ])
            
            ->add('MontantInvestissementMinimum', null, [
                'label' => 'Montant Investissement Minimum',
                'attr' => ['class' => 'form-control'],
            ])
            
            
            ->add('MontantInvesti')
            ->add('HistoriqueInvestissements')
            ->add('PhoneNumber');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Investisseur::class,
        ]);
    }
}
