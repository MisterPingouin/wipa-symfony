<?php

namespace App\Form;

use App\Entity\Photo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Title']
            ])
            ->add('link', UrlType::class, [
                'label' => 'Picture URL',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Picture://URL']
            ])
            ->add('prompt', TextType::class, [
                'label' => 'Prompt',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Prompt']
            ])
            ->add('description', TextType::class, [
                'label' => 'Comment',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Comment']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
        ]);
    }
}
