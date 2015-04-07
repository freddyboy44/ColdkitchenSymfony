<?php

namespace ColdkitchenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SpelerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam')
            ->add('voornaam')
            ->add('geboortedatum')
            ->add('straat')
            ->add('huisnr')
            ->add('bus')
            ->add('woonplaats')
            ->add('postcode')
            ->add('telefoon')
            ->add('gSM')
            ->add('emailadres')
            ->add('rugnummer')
            ->add('ploeg')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ColdkitchenBundle\Entity\Speler'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coldkitchenbundle_speler';
    }
}
