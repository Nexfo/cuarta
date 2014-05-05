<?php

namespace proyecto\HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use proyecto\HotelBundle\Form\Type\ReservaMinType;
use proyecto\HotelBundle\Entity\Reserva;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

class ReservasController extends Controller
{
    public function primeraAction()
    {
		$reserva = new Reserva();
		
		$form = $this->createForm(new ReservaMinType(), $reserva, array(
			'action' => $this->generateUrl('pagina_reservas_habitacion')
		));
		
		return $this->render('proyectoHotelBundle:Reservas:primera.html.twig', array('form' => $form->createView()));
    }
	
	public function habitacionAction(Request $request)
    {
		$reserva = new Reserva();
		
		$form = $this->createForm(new ReservaMinType(), $reserva, array(
			'action' => $this->generateUrl('pagina_reservas_habitacion')
		));
		
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$objDoctrine = $this->getDoctrine()->getManager();
			
			$reserva->setFechaPreReserva(new \DateTime("now"));
			
			$objDoctrine->persist($reserva);
			$objDoctrine->flush();
			
			$id = self::obtenerIdReserva($reserva);
			
			if (is_null($id)) {
				return $this->redirect($this->generateUrl('pagina_reservas'));
			} else {			
				$session = $this->get("session");
				$session->set("id_reserva", $id);
				
				//$session->get(string $name, mixed $default = null);
				return $this->render('proyectoHotelBundle:Reservas:habitacion.html.twig', array('id' => $session->get('id_reserva')));
			}
		} else {
			return $this->render('proyectoHotelBundle:Reservas:primera.html.twig', array('form' => $form->createView()));
		}
    }
	
	private function obtenerIdReserva($reserva) {
		$objDoctrine = $this->getDoctrine()->getManager();
		
		$query = $objDoctrine->createQuery(
			'SELECT r
			   FROM proyectoHotelBundle:Reserva r
			  WHERE r.adultos = :adultos AND 
				r.ninios = :ninios AND 
				r.fecha_entrada = :entrada AND 
				r.fecha_salida = :salida AND 
				r.fecha_pre_reserva = :reserva AND 
				r.confirmada = 0 AND 
				r.tipo_habitacion = :tipo'
		)->setParameter('adultos', $reserva->getAdultos())
		->setParameter('ninios', $reserva->getNinios())
		->setParameter('entrada', $reserva->getFechaEntrada())
		->setParameter('salida', $reserva->getFechaSalida())
		->setParameter('reserva', $reserva->getFechaPreReserva())
		->setParameter('tipo', $reserva->getTipoHabitacion());
		 
		$reservas = $query->getOneOrNullResult();
		
		if (is_null($reservas)) {
			return null;
		} else {
			return $reservas->getId();
		}
	}
}
