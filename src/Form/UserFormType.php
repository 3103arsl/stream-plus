<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Name is required.']),
                    new Assert\Length([
                        'max' => 6,
                        'maxMessage' => 'Name cannot less 6 characters.',
                        'min' => 50,
                        'minMessage' => 'Name cannot exceed 225 characters.',
                    ]),
                ],
            ])
            //->add('email', EmailType::class)
            //->add('phoneNumber', TextType::class)
//            ->add('subscriptionType', ChoiceType::class, [
//                'choices' => [
//                    'Free' => 'free',
//                    'Premium' => 'premium',
//                ],
//                'expanded' => true,
//                'multiple' => false,
//                'constraints' => [
//                    new Assert\NotBlank([
//                        'message' => 'Please select a subscription type.',
//                    ]),
//                    new Assert\Choice([
//                        'choices' => [1, 2],
//                        'message' => 'Invalid subscription type selected.',
//                    ]),
//                ],
//            ])
        ;
        //->add('city', TextType::class)
        //->add('postalCode', IntegerType::class)
        //->add('cardNumber', TextType::class)
        //->add('expiryDate', TextType::class)
        //->add('cvv', IntegerType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }
}