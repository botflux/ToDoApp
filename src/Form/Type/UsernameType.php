<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 02/11/2017
 * Time: 13:32
 */

namespace Todo\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;


class UsernameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 2,
                        'max' => 25
                    ]),
                ],
            ]);
    }
}