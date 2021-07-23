<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rue', TextType::class, [
                'label' => 'Adresse : ',
                'attr' => [ 'placeholder' => 'Numéro et rue (ex: 5 rue Jean Perrin)' ]
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville : ',
                'attr' => [ 'placeholder' => 'Tapez le nom de la Ville ici' ]
            ])
            ->add('codePostal', TextType::class, [
                'label' => 'Code Postal : ',
                'attr' => [ 'placeholder' => 'Tapez le Code Postal ici' ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
