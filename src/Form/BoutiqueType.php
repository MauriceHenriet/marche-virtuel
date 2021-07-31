<?php

namespace App\Form;

use App\Entity\Boutique;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BoutiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la boutique : ',
                'attr' => [ 'placeholder' => 'Tapez le nom ici' ]
            ])
            ->add('description', CKEditorType::class, [
                'label' => 'Decrivez votre boutique : ',
                'attr' => [ 'placeholder' => 'N\'hésitez pas à détailler en plusieurs lignes' ]
            ])
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Fromages & Laitages' => 'LAIT',
                    'Fruits et Légumes' => 'VEGE',
                    'Charcuteries' => 'CHAR',
                    'Conserves' => 'CONS',
                    'Céréales & Graines' => 'CERE',
                    'Vins & Alcools' => 'ALCO',
                    'Miels & Confiseries' => 'SUCR',
                    'Eaux et Boissons sans alcool' => 'H2O',
                    'Huiles et Assaisonnements' => 'EPIC',
                    'Objets, Outils' => 'OBJE',
                    'Habits et Autres' => 'HABI',
                ],
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Ouverte (les produits de la boutique seront accessibles à la vente)' => 'OPEN',
                    'Fermée (les produits ne seront pas accessibles à la vente)' => 'CLOSED',
                ],
            ])
            ->add('fdp', MoneyType::class, [
                'label' => "Frais de port",
                'currency' =>'EUR',
                'attr' => ['placeholder' => 'Frais de port en € (EUR).'],
                'divisor' => 100
            ])
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
            ->add('imageUrl', FileType::class, [
                'label' => 'Ajoutez une image',
                'required' => false,
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Boutique::class,
        ]);
    }
}
