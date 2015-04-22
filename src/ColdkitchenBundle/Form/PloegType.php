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
        //$em = $this->getDoctrine()->getManager();
      
        $builder
            ->add('ploegnaam','text', array(
                    'label' => 'Ploegnaam'
                ))
            ->add('kapiteinNaam','text', array(
                    'label' => 'Naam (*): ',
                    'required' => true,
                ))
            ->add('kapiteinVoornaam','text', array(
                    'label' => 'Voornaam (*):',
                    'required' => true,
                ))
            ->add('geboortedatum', 'date', array(
                    'label' => 'Geboortedatum (dd/mm/jjjj) (*)',
                    'widget' => 'choice',
                    'years'  => range(1930,2000)

                ))
            ->add('straat','text', array(
                    'label'=>'Straat (*)',
                    'required'=>true 
                ))
            ->add('huisnr','text', array(
                    'label'=>'Huisnr (*)',
                    'required'=>true 
                ))
            ->add('bus','text', array(
                    'label'=>'Bus',
                    'required'=>false 
                ))
            ->add('postcode','text', array(
                    'label'=>'Postcode (*)',
                    'required'=>true 
                ))
            ->add('woonplaats','text', array(
                    'label'=>'Woonplaats (*)',
                    'required'=>true 
                ))
            ->add('telefoon','text', array(
                    'label'=>'Telefoon',
                    'required'=>false 
                ))
            ->add('gsm','text', array(
                    'label'=>'GSM (*)',
                    'required'=>true 
                ))
            ->add('emailadres','email', array(
                    'label'=>'Email (*)',
                    'required'=>true 
                ))
            ->add('competitie', 'entity', array(
                    'class' => 'ColdkitchenBundle:Competitie',
                    
                    'label' => 'Competitie (*)',
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
        return 'coldkitchenbundle_ploeg';
    }
}
