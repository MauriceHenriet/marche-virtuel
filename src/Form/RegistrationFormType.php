<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('rue', TextType::class, [
            //     'required' => false,
            //     'label' => 'Rue et numéro : ',
            //     'attr' => ['placeholder' => 'entrez votre adresse ici']
            // ])
            // ->add('ville', TextType::class, [
            //     'required' => false,
            //     'label' => 'Ville : ',
            //     'attr' => ['placeholder' => 'entrez votre ville ici']
            // ])
            // ->add('codePostal', TextType::class, [
            //     'required' => false,
            //     'label' => 'Code Postal : ',
            //     'attr' => ['placeholder' => 'entrez votre code postal ici']
            // ])
            ->add('email', EmailType::class, [
                'required' => false,
                'label' => 'Email : ',
                'attr' => ['placeholder' => 'entrez votre Email ici']
            ])
            ->add('name', TextType::class, [
                'required' => false,
                'label' => 'Nom : ',
                'attr' => ['placeholder' => 'entrez votre Nom ici']
            ])
            ->add('firstName', TextType::class, [
                'required' => false,
                'label' => 'Prénom : ',
                'attr' => ['placeholder' => 'entrez votre Prénom ici']
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'label' => 'Numéro de téléphone : ',
                'attr' => ['placeholder' => 'entrez votre numéro de téléphone ici']
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Accepter les conditions générales d\'utilisations du site : ',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions générales d\'utilisations.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'required' => false,
                'label' => 'Mot-de-passe : ',
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'entrez un mot-de-passe ici'
                        ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez choisir un mot-de-passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 200,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
