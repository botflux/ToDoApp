<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 02/11/2017
 * Time: 21:05
 */

namespace Todo\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class PasswordChangedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('last_password', PasswordType::class, [
            'label' => 'Ancien mot de passe'
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques.',
                'first_options' => [
                    'label' => 'Nouveau mot de passe',
                    'constraints' => [
                        new NotBlank(),
                        new Length([
                            'min' => 8,
                            'max' => 20,
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => 'Retapez le mot de passe'
                ],
            ]);
    }
}