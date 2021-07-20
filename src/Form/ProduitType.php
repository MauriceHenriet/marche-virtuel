<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du Produit : ',
                'attr' => [ 'placeholder' => 'Tapez le nom ici' ]
            ])
            ->add('prix', MoneyType::class, [
                'label' => "Prix du produit",
                'currency' =>'EUR',
                'attr' => ['placeholder' => 'Prix du produit en € (EUR).'],
                'divisor' => 100
            ])
            ->add('description', CKEditorType::class, [
                'label' => 'Description du produit',
                'attr' => ['placeholder' => 'Tapez la description du produit ici']
            ])
            ->add('imageUrl', FileType::class, [
                'label' => 'Sélectionnez une image',
                'mapped' => false,
                'required' => false
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Disponible' => 'Disponible',
                    'Indisponible' => 'Indisponible',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
