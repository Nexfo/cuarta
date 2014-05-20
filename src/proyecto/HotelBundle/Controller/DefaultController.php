<?php

namespace proyecto\HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use proyecto\HotelBundle\Form\Type\ReservaMinType;
use proyecto\HotelBundle\Entity\Reserva;

class DefaultController extends Controller
{
    public function indexAction()
    {
		$reserva = new Reserva();
		$form = $this->createForm(new ReservaMinType(), $reserva, array(
			'action' => $this->generateUrl('pagina_reservas')
		));
		
		$objDoctrine = $this->getDoctrine()->getManager();
		
		$numHabs = $objDoctrine->createQuery(
			'SELECT COUNT(h)
			FROM proyectoHotelBundle:Habitacion h'
		)->getResult();
		
		$query = $objDoctrine->createQuery(
			'SELECT h
			 FROM proyectoHotelBundle:Habitacion h
			 WHERE h.id IN (' . implode(',', self::habitaciones($numHabs[0])) . ')'
		);
		$habitaciones = $query->getResult();
		
        return $this->render('proyectoHotelBundle:Default:index.html.twig',
			array('form' => $form->createView(),
			'habitaciones' => $habitaciones
		));
    }
	
	private function habitaciones($numHabitaciones) {
		$resultado = array(); $correcto = false;
		
		while (!$correcto) {
			$num = rand(1, $numHabitaciones[1]);
			if (!in_array($num, $resultado)) {
				array_push($resultado, $num);
				if (count($resultado) == 3) {
					$correcto = true;
				}
			}
		}
		
		return $resultado;
	}
}