<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjectType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title')
                ->add('icon', FileType::class, ['label' => 'Project Icon (JPG, JPEG, PNG)', 'required'=> True,'data_class'=>null])
                ->add('description', TextareaType::class)
                ->add('category', ChoiceType::class, [
                    'choices'=> [
                        'Web'=>'Web', 
                        'Mobile'=>'Mobile']
                ])
                ->add('Create', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }

}
