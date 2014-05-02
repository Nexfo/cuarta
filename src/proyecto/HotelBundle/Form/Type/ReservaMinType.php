<?php
namespace proyecto\HotelBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
 
class ReservaMinType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
			->add('tipo', 'entity', array('class' => 'proyectoHotelBundle:TipoHabitacion',
				'property' => 'nombre',
				'query_builder' => function(EntityRepository $er) {
					return $er->createQueryBuilder('e')
					->orderBy('e.id', 'ASC');
				},
				"mapped" => false,
				'label' => 'Tipo de habitación:'
			))
			->add('fecha_entrada', 'datePicker', array('label' => 'Fecha de entrada'))
			->add('fecha_salida', 'datePicker', array('label' => 'Fecha de salida'))
            ->add('adultos', 'choice', array(
				'label' => 'Adultos',
				'choices'   => array(
					'1' => '1',
					'2' => '2',
				),
			))
			->add('ninios', 'choice', array(
				'label' => 'Niños',
				'choices'   => array(
					'0' => '0',
					'1' => '1',
					'2' => '2',
					'3' => '3',
				),
			))
			->add('reservar', 'submit');
    }
 
    public function getName()
    {
        return 'reserva';
    }
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'proyecto\HotelBundle\Entity\Reserva',
			/*'cascade_validation' => true,*/
		));
	}
}