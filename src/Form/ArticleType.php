<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title',TextType::class, [
                    'label' => 'Question',
                    'attr' => [
                        'placeholder' => 'How do i choose a php framwork?',
                        'class'=>'lead'
                    ]
                        ]
                )
                ->add('description',TextareaType::class, [
                    'label' => 'Additional Information',
                    'attr' => [
                        'placeholder' => 'im currecntly working on a CMS for a hotel ...',
                        'class' => 'lead'
                    ]
                ])
                ->add('ask', SubmitType::class, [
                    'label' => 'Ask a Question',
                    
                        'attr'=>[
                            'class'=>'btn-danger'
                        ]
                    
                ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }

}
