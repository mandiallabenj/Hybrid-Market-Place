<?php

namespace App\Form;

use App\Entity\Collaborator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\IsTrue;

class CollaboratorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('githubUrl', UrlType::class, [
                    'attr' => [
                        'class' => 'lead',
                        'placeholder' => 'https:/example.com or http:/example.com'
                    ]
                ])
                ->add('Reason', TextareaType::class, [
                    'attr' => [
                        'class' => 'lead',
                        'placeholder' => 'i have built built plugins that i would like to integrate ....,'
                    ]
                ])
                ->add('agreeToTerms', CheckboxType::class, [
                    'mapped' => FALSE,
                    'constraints' => [
                        new IsTrue(
                                [
                            'message' => 'I know, it\'s silly, but you must agree to our terms.'
                                ])
                    ]
                ])
                ->add('Make Request', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Collaborator::class,
        ]);
    }

}
