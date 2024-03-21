<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
		->add('name', TextType::class, [
			'attr' => [
				'placeholder' => 'Enter your name',
				'class' => 'common-input'
			],
			'label' => false,
			'constraints' => [
				new NotBlank([
					'message' => 'Please enter your name.'
				]),
				new Length([
					'min' => 2,
					'minMessage' => 'Your name should be at least {{ limit }} characters long.',
					'max' => 255
				]),
			]
		])
		->add('email', EmailType::class, [
			'attr' => [
				'placeholder' => 'Enter your email',
				'class' => 'common-input'
			],
			'label' => false,
			'constraints' => [
				new NotBlank([
					'message' => 'Please enter your email.'
				]),
				new Length([
					'min' => 2,
					'minMessage' => 'Your email should be at least {{ limit }} characters long.',
					'max' => 255
				]),
			]
		])
		->add('number', TextType::class, [
			'attr' => [
				'placeholder' => 'Enter your phone number',
				'class' => 'common-input'
			],
			'label' => false,
			'constraints' => [
				new NotBlank([
					'message' => 'Please enter your phone number.'
				]),
				new Length([
					'min' => 2,
					'minMessage' => 'Your phone number should be at least {{ limit }} characters long.',
					'max' => 255
				]),
			]
		])
		->add('subject', TextType::class, [
			'attr' => [
				'placeholder' => 'Enter your subject',
				'class' => 'common-input'
			],
			'label' => false,
			'constraints' => [
				new NotBlank([
					'message' => 'Please enter your subject.'
				]),
				new Length([
					'min' => 2,
					'minMessage' => 'Your subject should be at least {{ limit }} characters long.',
					'max' => 255
				]),
			]
		])
		->add('message', TextareaType::class, [
			'attr' => [
				'placeholder' => 'Enter your message',
				'class' => 'common-input'
			],
			'label' => false,
		])
		;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
			'data_class' => Contact::class,
		]);
    }
}
