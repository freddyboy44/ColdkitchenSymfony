<?php

namespace ColdkitchenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PloegType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ploegnaam','text', array(
                    'label' => 'Ploegnaam'
                ))
            ->add('kapiteinNaam','text', array(
                    'label' => 'Naam:',
                    'required' => true,
                ))
            ->add('kapiteinVoornaam','text', array(
                    'label' => 'Voornaam:',
                    'required' => true,
                ))
            ->add('geboortedatum', 'date', array(
                    'widget' => 'choice',
                    'years'  => range(1930,2000)

                ))
            ->add('straat')
            ->add('huisnr')
            ->add('bus')
            ->add('postcode')
            ->add('woonplaats')
            ->add('telefoon')
            ->add('gsm')
            ->add('emailadres')
            ->add('competitie')
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
        return 'coldkitchenbundle_ploeg';
    }
}
