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
            ->add('naam','text', array(
                    'label' => 'Naam',
                    'required' => true)
            ->add('voornaam','text', array(
                    'label' => 'Voornaam',
                    'required' => true)
            ->add('geboortedatum','date', array(
                    'label' => 'Geboortedatum',
                    'required' => true)
            ->add('straat','text', array(
                    'label' => 'Straat',
                    'required' => false)
            ->add('huisnr','text', array(
                    'label' => 'Huisnummer',
                    'required' => false)
            ->add('bus','text', array(
                    'label' => 'Bus',
                    'required' => false)
            ->add('woonplaats','text', array(
                    'label' => 'Woonplaats',
                    'required' => false)
            ->add('postcode','text', array(
                    'label' => 'Postcode',
                    'required' => false)
            ->add('telefoon','text', array(
                    'label' => 'Telefoon',
                    'required' => false)
            ->add('gsm','text', array(
                    'label' => 'GSM',
                    'required' => false)
            ->add('emailadres','email', array(
                    'label' => 'Emailadres',
                    'required' => false)
            ->add('rugnummer','integer', array(
                    'label' => 'Rugnummer',
                    'required' => false)
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
