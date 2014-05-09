<?php
namespace proyecto\HotelBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
 
class EmailType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
			->add('nombre')
			->add('email', 'email')
			->add('asunto')
			->add('mensaje', 'textarea')
			->add('enviar', 'submit');
    }
 
    public function getName()
    {
        return 'email';
    }
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'proyecto\HotelBundle\Entity\Email'
		));
	}
}