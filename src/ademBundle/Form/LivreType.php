<?php

namespace ademBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Vich\UploaderBundle\Form\Type\VichFileType;

class LivreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    $builder->add('titreLivre')
            ->add('dateEdition')
            ->add('descriptionLivre')
            ->add('qteLivre')
            ->add('auteur')
            ->add('categorieLivre',  ChoiceType::class,
                array('choices'=>array(
                    'art'=>"art",
                    'scientifique'=>"scientifique",
                    'medecine'=>"medecine",
                    'sport'=>"sport",
                    'informatique'=>"informatique",
                    'economie'=>"economie",

                ),))
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
            'data_class' => 'ademBundle\Entity\Livre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adembundle_livre';
    }


}
