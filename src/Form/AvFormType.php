<?php

namespace App\Form;

use App\Entity\AvForm;
use App\Entity\AvStatus;
use App\Entity\AvTravel;
use App\Entity\AvUser;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('message_form')
            ->add('AvTravel', EntityType::class, [
                'class' => AvTravel::class,
'choice_label' => 'id',
            ])
            ->add('AvStatus', EntityType::class, [
                'class' => AvStatus::class,
'choice_label' => 'id',
            ])
            ->add('AvUser', EntityType::class, [
                'class' => AvUser::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AvForm::class,
        ]);
    }
}
