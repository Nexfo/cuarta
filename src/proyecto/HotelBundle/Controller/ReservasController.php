<?php

namespace proyecto\HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use proyecto\HotelBundle\Form\Type\ReservaMinType;
use proyecto\HotelBundle\Entity\Reserva;
use proyecto\HotelBundle\Form\Type\ClienteType;
use proyecto\HotelBundle\Entity\Cliente;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

class ReservasController extends Controller
{
    public function primeraAction(Request $request)
    {
		$reserva = new Reserva();
		
		$form = $this->createForm(new ReservaMinType(), $reserva);
		
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$objDoctrine = $this->getDoctrine()->getManager();
			
			$reserva->setFechaPreReserva(new \DateTime("now"));
			
			$objDoctrine->persist($reserva);
			$objDoctrine->flush();
			
			/* ================================= */
			$session = $this->get("session");

			$id = self::obtenerIdReserva($reserva);
			
			if (is_null($id)) {
				/* NOTIFICAR ERROR */
				return $this->render('proyectoHotelBundle:Reservas:primera.html.twig', array('form' => $form->createView()));
			} else {			
				$session->set("id_reserva", $id);
				
				return $this->redirect($this->generateUrl('pagina_reservas_habitacion'));
			}
		}
		
		return $this->render('proyectoHotelBundle:Reservas:primera.html.twig', array('form' => $form->createView()));
    }
	
	public function habitacionAction(Request $request)
    {
		$session = $this->get("session");
		$reserva = null;
		$objDoctrine = $this->getDoctrine()->getManager();
		
		if ($session->has("id_reserva")) {
			$repositorio = $this->getDoctrine()->getRepository('proyectoHotelBundle:Reserva');
			$reserva = $repositorio->find($session->get("id_reserva"));
		} else {
			return $this->redirect($this->generateUrl('pagina_reservas'));
		}
		
		/* =========== Reservar las habitaciones ============ */
		if (self::reservarHabitaciones($this->get('request')->request->get('habitacion'), $objDoctrine, $reserva)) {
			return $this->redirect($this->generateUrl('pagina_reservas_cliente'));
		}
		/* =========== Fin Reservar las habitaciones ======== */
		
		/* =========== Actualizar Reserva =================== */
		$form = $this->createForm(new ReservaMinType(), $reserva);
		
		$form->handleRequest($request);
		
		$habitaciones = self::obenterHabitaciones($session->get('id_reserva'));
		
		if ($form->isValid()) {
			$reserva->setFechaPreReserva(new \DateTime("now"));
			
			$objDoctrine->persist($reserva);
			$objDoctrine->flush();
			
			return $this->redirect($this->generateUrl('pagina_reservas_habitacion'));
		}
		/* =========== Fin Actualizar Reserva =============== */
		
		return $this->render('proyectoHotelBundle:Reservas:habitacion.html.twig',
			array('habitaciones' => $habitaciones,
				  'form_reserva' => $form->createView()
		));
    }
	
	public function clienteAction(Request $request)
    {
		$cliente = new Cliente();
		$form = $this->createForm(new ClienteType(), $cliente/*, array(
			'action' => $this->generateUrl('pagina_reservas')
		)*/);
		
        return $this->render('proyectoHotelBundle:Reservas:cliente.html.twig',
			array('form' => $form->createView(),
		));
	}
	
	private function reservarHabitaciones($idHabitaciones, $doctrine, $reserva) {
		if (!is_null($idHabitaciones)) {
			$reserva->setFechaPreReserva(new \DateTime("now"));
			$doctrine->persist($reserva);
			
			foreach($idHabitaciones as $idHab) {
				$repositorio = $this->getDoctrine()->getRepository('proyectoHotelBundle:Habitacion');
				$habitacion = $repositorio->find($idHab);
				
				$doctrine->persist($habitacion->setReserva($reserva));
			}
			
			$doctrine->flush();
			return true;
		} else {
			return false;
		}
	}
	
	private function obenterHabitaciones($idReserva) {
		$objDoctrine = $this->getDoctrine()->getManager();
		
		$query = $objDoctrine->createQuery(
			'SELECT r
			 FROM proyectoHotelBundle:Reserva r
			 WHERE r.id = :id'
		)->setParameter('id', $idReserva);
		
		$tipoHabitacion = $query->getOneOrNullResult()->getTipoHabitacion();
		
		return $habitaciones = $tipoHabitacion->getHabitaciones();
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
