<?php

namespace ColdkitchenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AchtergrondFotoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('zichtbaar','checkbox', array(
                            'required'=>false
                            ))
            ->add('file','file', array(
                            'label'=>'Foto',
                            'required'=>false,
                            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ColdkitchenBundle\Entity\AchtergrondFoto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coldkitchenbundle_achtergrondfoto';
    }
}
