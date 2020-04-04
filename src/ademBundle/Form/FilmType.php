<?php

namespace ademBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class FilmType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('genre',ChoiceType::class,
                array('choices'=>array
                (   'Action'=>"Action",
                    'Animation'=>"Animation",
                    'Aventure'=>"Aventure",
                    'Comedie'=>"Comedie",
                    'Drame'=>"Drame",
                    'Policier'=>"Policier",
                    'Romance'=>"Romance",
                    'Horreur'=>"Horreur",
                ),))
            ->add('prix')
            ->add('description')
            ->add('imageFile',VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_link' => true

            ])
            ->add('dateDebut')
            ->add('dateFin')
            ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ademBundle\Entity\Film'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adembundle_film';
    }


}
