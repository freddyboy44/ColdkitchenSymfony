<?php

namespace ColdkitchenBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VraagType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('naam','text', array(
                'label' => false,
                'required' => true,
                 'attr' => array(
                     'placeholder' => 'Naam',
                    )
                ))
            ->add('email','email',array(
                'label' => false,
                'required' => true,
                'attr' => array(
                     'placeholder' => 'Email',
                    )
                ))
            ->add('telefoon', 'text', array(
                'label' => false,
                'required' => true,
                'attr' => array(
                     'placeholder' => 'Telefoon',
                    )
                ))
            ->add('tekst','textarea', array(
                'label' => false,
                'required' => true,
                'attr' => array(
                     'placeholder' => 'Uw vraag',
                    )
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ColdkitchenBundle\Entity\Vraag'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'coldkitchenbundle_vraag';
    }
}
