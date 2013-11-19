<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->setAction($options['link'])
            ->add('firstName', null, array('label' => 'firstName', 'constraints' => array(new NotBlank())))
            ->add('secondName', null, array('label' => 'secondName', 'constraints' => array(new NotBlank())))
            ->add('email', null, array('label' => 'email', 'constraints' => array(new NotBlank())))
            ->add('birthday', null, array('label' => 'birthday', 'constraints' => array(new NotBlank())))
            ->add('shoeSize', null, array('label' => 'shoeSize', 'constraints' => array(new NotBlank())));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Acme\DemoBundle\Entity\User',
                'link' => '',
                'firstName' => '',
                'secondName' => '',
                'email' => '',
                'birthday' => '',
                'shoeSize' => '',
            )
        );
    }

    public function getName()
    {
        return 'user';
    }
}