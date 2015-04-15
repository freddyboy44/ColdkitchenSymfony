<?php

namespace ColdkitchenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class WachtwoordType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oudwachtwoord','password', array(
                    'label' => 'Oude wachtwoord',
                    'required' => true
                ))
            ->add('nieuwwachtwoord','password', array(
                    'label' => 'Nieuwe wachtwoord',
                    'required' => true
                ))
            ->add('nieuwwachtwoord2','password', array(
                    'label' => 'Controle',
                    'required' => true
                ))
            
            ->add('submit','button');
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ColdkitchenBundle\Entity\Ploeg'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coldkitchenbundle_wachtwoord';
    }
}
