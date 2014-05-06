<?php
namespace proyecto\HotelBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
 
class HabitacionesType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$builder
			->add('tipo_habitacion', 'entity', array('class' => 'proyectoHotelBundle:Habitacion',
				'property' => 'nombre',
				'query_builder' => function(EntityRepository $er) {
					return $er->createQueryBuilder('h')
					->where('h.reserva is NULL')
					->orderBy('h.id', 'ASC');
				},
				"mapped" => false,
				'label' => 'Tipo de habitación:',
				'multiple' => true,
				'expanded' => true
			))
			->add('seleccionar', 'submit');
    }
 
    public function getName()
    {
        return 'habitacion';
    }
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'proyecto\HotelBundle\Entity\Habitacion',
			/*'cascade_validation' => true,*/
		));
	}
}