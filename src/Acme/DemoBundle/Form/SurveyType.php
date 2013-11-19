<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class SurveyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->setAction($options['link'])
            ->add('iceCream', null, array('label' => 'iceCream', 'constraints' => array(new NotBlank())))
            ->add('superHero', null, array('label' => 'superHero', 'constraints' => array(new NotBlank())))
            ->add('movieStar', null, array('label' => 'movieStar', 'constraints' => array(new NotBlank())))
            ->add('worldEndTime', null, array('label' => 'worldEndTime', 'constraints' => array(new NotBlank())))
            ->add('winner', null, array('label' => 'winner', 'constraints' => array(new NotBlank())));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Acme\DemoBundle\Entity\Survey',
                'link' => '',
                'iceCream' => '',
                'superHero' => '',
                'movieStar' => '',
                'worldEndTime' => '',
                'winner' => '',
            )
        );
    }

    public function getName()
    {
        return 'survey';
    }
}