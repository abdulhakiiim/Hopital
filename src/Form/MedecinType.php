<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\Service;
use App\Entity\Specialite;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class MedecinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom')
            ->add('nom')
            ->add('tel')
            ->add('datenais',DateType::class, ['widget' => 'single_text','format' => 'yyyy-MM-dd'])
            ->add('service', EntityType::class,['class'=>Service::class,'choice_label'=>'libelle'])
            ->add('specialites',EntityType::class,[
                'class'=>Specialite::class,'choice_label'=>'libelle',
                'multiple'=>true
                ]);
        /*$formModifier = function (FormInterface $form, Service $service = null) {
            $spetialites = null === $service ? [] : $service->getAvailableSpetialites();    

            $form
            ]);
        };
            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event) use ($formModifier) {
                $data = $event->getData();


                $formModifier($event->getForm(), $data->getService());
    
            }
        );
            $builder->get('service')->addEventListener(
                FormEvents::POST_SUBMIT,
                function (FormEvent $event) use ($formModifier) {
                    $service = $event->getForm()->getData();
                    $formModifier($event->getForm()->getParent(), $service);
            }
        );*/
            $builder->add('save', SubmitType::class);
    }
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medecin::class,
        ]);
    }
}

