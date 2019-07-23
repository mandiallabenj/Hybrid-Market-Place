<?php

namespace App\Form;

use App\Entity\Projectfiles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjectFileType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add
                ('versionName',TextType::class, [
                    'attr'=> [
                        'placeholder'=>'Alpha 1.6',
                        'class'=>'lead'
                    ],
                    'required'=> TRUE,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Version Name',
                                ]),
                        new Length([
                            'max' => 25,
                            'maxMessage' => 'Your Version Name should not exceed {{ limit }} characters',
                                // max length allowed by Symfony for security reasons
                                ]),
                    ],
                        ]
                )
                ->add('features', TextareaType::class,[
                    'attr' => [
                        'placeholder'=>'E.g Visa Payment, Chat Online',
                        'class'=>'lead'
                        ]
                    
                ])
                ->add('projectfile', FileType::class,  [
                    'label' => 'Zip Files Only'])
                ->add('upload', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Projectfiles::class,
        ]);
    }

}
