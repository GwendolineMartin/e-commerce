<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Profil;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('delivery_adress_one')
            ->add('delivery_adress_two')
            ->add('delivery_adress_three')
            ->add('additional_Information')
            ->add('billing_adress')
            ->add('phone')
            ->add('save', SubmitType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Profil::class,
            'csrf_protection' => false
        ));
    }
}