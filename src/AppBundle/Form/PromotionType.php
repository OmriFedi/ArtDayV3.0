<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('refPromotion')->add('tauxPromotion')->add('typePromotion') ->add('dateDebut', DateType::class, array(
            'widget' => 'single_text',
            // this is actually the default format for single_text
            'format' => 'yyyy-MM-dd'))  ->add('dateFin', DateType::class, array(
            'widget' => 'single_text',
            // this is actually the default format for single_text
            'format' => 'yyyy-MM-dd'))     ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Promotion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_promotion';
    }


}
