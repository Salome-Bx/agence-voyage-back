<?php

namespace App\Form;

use App\Entity\AvCategory;
use App\Entity\AvCountry;
use App\Entity\AvTravel;
use App\Entity\AvUser;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvTravelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title_travel')
            ->add('picture_travel')
            ->add('description_travel')
            ->add('datestart_travel', null, [
                'widget' => 'single_text'
            ])
            ->add('dateend_travel', null, [
                'widget' => 'single_text'
            ])
            ->add('price_travel')
            ->add('AvUser', EntityType::class, [
                'class' => AvUser::class,
'choice_label' => 'id',
            ])
            ->add('AvCategory', EntityType::class, [
                'class' => AvCategory::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('AvCountry', EntityType::class, [
                'class' => AvCountry::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AvTravel::class,
        ]);
    }
}
