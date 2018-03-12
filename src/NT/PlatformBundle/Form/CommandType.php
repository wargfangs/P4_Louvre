<?php

namespace NT\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class CommandType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('email', EmailType::class, array(
                    'attr' => array(
                        'class' => 'email'
                    ),
                ))    
                ->add('tickets', CollectionType::class, array(
                    'entry_type' => TicketType::class,
                    'label'=>'Vos billets : ',
                    'attr' => array(
                        'class' => 'billet'
                    ),
                    'entry_options' => array('label' => false),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false
                     ))
                ->add('Valider', SubmitType::class, array(
                    'attr' => array(
                        'class' => 'btn btn-success'
                    )
                ));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NT\PlatformBundle\Entity\Command'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nt_platformbundle_command';
    }


}
