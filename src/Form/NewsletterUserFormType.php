<?php

namespace App\Form;

use App\Entity\Newsletter\NewsletterUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsletterUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('newsUserEmail', EmailType::class)
            ->add('isRGPD', CheckboxType::class, [
                'constraints' => [
                    new IsTrue([
                        'message' => 'Please accept the RGPD.'
                    ])
                ],
                'label' => 'I accept the collect of personal data.'
            ])
            ->add('send', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewsletterUser::class,
        ]);
    }
}
