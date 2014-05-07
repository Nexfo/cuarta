<?php
namespace proyecto\HotelBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
 
class ClienteType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
			->add('nombre')
			->add('primerApellido')
			->add('segundoApellido')
			->add('direccion', 'text', array('label' => 'Dirección'))
			->add('ciudad')
			->add('provincia')
			->add('cod_postal', 'text', array('label' => 'Código postal'))
			->add('telefono', 'text', array('label' => 'Teléfono'))
			->add('email')
			->add('email2', 'email', array(
				'mapped' => false,
				'label' => 'Repetir email'
			))
			->add('volver', 'submit')
			->add('reservar', 'submit');
    }
 
    public function getName()
    {
        return 'cliente';
    }
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'proyecto\HotelBundle\Entity\Cliente',
			/*'cascade_validation' => true,*/
		));
	}
}