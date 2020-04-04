<?php

namespace ademBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class SponsorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
                 ->add('typesponsor',ChoiceType::class,

                array('choices'=>array(
                    'Montant'=>"Montant",
                    'Quantité'=>"Quantité",
                ),))
                ->add('montant')
                ->add('quantite')
                ->add('email')
                ->add('imageFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_link' => true

            ]);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ademBundle\Entity\Sponsor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adembundle_sponsor';
    }


}
