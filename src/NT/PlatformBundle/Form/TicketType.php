<?php

namespace NT\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
//use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('firstname', TextType::class, array('label'=>'Prénom'))
                ->add('lastname', TextType::class, array('label'=>'Nom'))
                ->add('country', CountryType::class, array('label'=>'Pays'))
                ->add('birthday', DateType::class, array(
                    'label'=>'Date de naissance',
                    'widget' => 'choice',
                    'format' => 'dd-MM-yyyy',
                    'years' => range(1902, date('Y')),
                    ))
                ->add('visitDay', DateType::class, array(
                    'label'=>'Jour de visite',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'attr' => ['class' => 'js-datepicker'],
                    ))
                ->add('discount', CheckboxType::class, array(
                    'label'    => 'Tarif réduit (étudiant ou militaire)',
                    'required' => false,
                    ))
                ->add('halfDay', CheckboxType::class, array(
                    'label'    => 'Demi-journée',
                    'required' => false
                    ));
//                ->add('tarif', EntityType::class, array(
//                        'class'        => 'NTPlatformBundle:Tarif',
//                ))
//                ->add('command', EntityType::class, array(
//                    'class' => 'NTPlatformBundle:Command',
//                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NT\PlatformBundle\Entity\Ticket'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nt_platformbundle_ticket';
    }


}
