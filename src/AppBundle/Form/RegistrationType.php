<?php
/**
 * Created by PhpStorm.
 * User: Omri Fedi
 * Date: 18/02/2017
 * Time: 02:04
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface  $builder, array $options)
    {
        $builder->add('streetAddress',null,array('required' => false))
            ->add('city')
            ->add('state')
            ->add('zipCode',null,array('required' => false))
            ->add('country');
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}