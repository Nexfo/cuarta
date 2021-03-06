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
		$this->get('purgador')->purgar();
		$session = $this->get("session");
		$reserva = null;
		
		if (!($reserva = self::cargarReserva($session))) {
			$reserva = new Reserva();
		}
		
		$form = $this->createForm(new ReservaMinType(), $reserva);		
		$form->handleRequest($request);
		
		$error = "";
		
		if ($form->isValid()) {
			$objDoctrine = $this->getDoctrine()->getManager();
			if ($reserva->getFechaEntrada() > (new \DateTime("now"))) {
				if ($reserva->getFechaSalida() > $reserva->getFechaEntrada()) {
					$reserva->setFechaPreReserva(new \DateTime("now"));
					$objDoctrine->persist($reserva);
					$objDoctrine->flush();
					
					if (!is_null($reserva->getId())) {
						$this->get("session")->set("id_reserva", $reserva->getId());
						
						return $this->redirect($this->generateUrl('pagina_reservas_habitacion'));
					} else {			
						$error = "Ocurrió un error inesperado, vuelve a intentarlo.";
					}
				} else {
					$error = "La fecha de salida debe ser posterior a la fecha de entrada.";
				}
			} else {
				$error = "La fecha de entrada no puede haber pasado.";
			}
		}
		
		return $this->render('proyectoHotelBundle:Reservas:primera.html.twig',
			array('form' => $form->createView(),
			'error' => $error
		));
    }
	
	public function habitacionAction(Request $request)
    {
		$this->get('purgador')->purgar();
		$session = $this->get("session");
		$reserva = null;
		$objDoctrine = $this->getDoctrine()->getManager();
		
		if (!($reserva = self::cargarReserva($session))) {
			return $this->redirect($this->generateUrl('pagina_reservas'));
		}
		
		$error = "";
		
		if (!is_null($this->get('request')->request->get('habitacion'))) {
			if ($reserva->getAdultos() > ($reserva->getTipoHabitacion()->getNumPlazas() * count($this->get('request')->request->get('habitacion')))) {
				$error = "Debes seleccionar al menos " .
						 round($reserva->getAdultos() / $reserva->getTipoHabitacion()->getNumPlazas()) . " " .
						 strtolower($reserva->getTipoHabitacion()->getNombrePlural()) . ".";
			} else {
				if (self::reservarHabitaciones($this->get('request')->request->get('habitacion'), $objDoctrine, $reserva)) {
					return $this->redirect($this->generateUrl('pagina_reservas_cliente'));
				}
			}
		}
		
		$habitaciones = self::obtenerHabitaciones($reserva);
		if (count($habitaciones) == 0) {
			$error = "No hay habitaciones disponibles para esas fechas.";
		}
		
		$form = $this->createForm(new ReservaMinType(), $reserva, array(
			'action' => $this->generateUrl('pagina_reservas')
		));
		
		return $this->render('proyectoHotelBundle:Reservas:habitacion.html.twig',
			array('habitaciones' => $habitaciones,
				  'form_reserva' => $form->createView(),
				  'error' => $error
		));
    }
	
	public function clienteAction(Request $request)
    {
		$this->get('purgador')->purgar();
		$objDoctrine = $this->getDoctrine()->getManager();
		$session = $this->get("session");
		$reserva = null;
		
		if (!($reserva = self::cargarReserva($session))) {
			return $this->redirect($this->generateUrl('pagina_reservas'));
		}
		
		if (!is_null($request->get('cliente'))) {
			if (array_key_exists('volver', $request->get('cliente'))) {
				$reserva->setFechaPreReserva(new \DateTime("now"));
				$objDoctrine->persist($reserva);
				
				$habitaciones = $reserva->getHabitaciones();
				
				foreach ($habitaciones as $habitacion) {
					$reserva->removeHabitacione($habitacion);
				}
				
				$objDoctrine->flush();
				
				return $this->redirect($this->generateUrl('pagina_reservas_habitacion'));
			}
		}
		
		$cliente = new Cliente();
		$form = $this->createForm(new ClienteType(), $cliente);
		
		$form->handleRequest($request);
			
		$aCliente = $request->get('cliente');
		$error = ""; $errorBool = true;
		if ($aCliente['email'] != $aCliente['email2']) {
			$error = 'Debes introducir el mismo email dos veces.';
			$errorBool = false;
		}
		
		if ($form->isValid()) {
			if (!self::validarDni($aCliente['dni'])) {
				$error = 'El D. N. I. debe ser "00000000-X".';
				$errorBool = false;
			}
		}
		
		if ($form->isValid() && $errorBool) {
			$query = $objDoctrine->createQuery(
				'SELECT c
				 FROM proyectoHotelBundle:Cliente c
				 WHERE c.dni = :dni'
			)->setParameter('dni', $cliente->getDni());
			$rCliente = $query->getOneOrNullResult();
			
			$objDoctrine->persist($reserva->setFechaPreReserva(new \DateTime("now")));
			
			if (is_null($rCliente)) {
				$objDoctrine->persist($cliente);
			} else {
				$rCliente->setNombre($cliente->getNombre());
				$rCliente->setPrimerApellido($cliente->getPrimerApellido());
				$rCliente->setDni($cliente->getDni());
				$rCliente->setDireccion($cliente->getDireccion());
				$rCliente->setCiudad($cliente->getCiudad());
				$rCliente->setProvincia($cliente->getProvincia());
				$rCliente->setCodPostal($cliente->getCodPostal());
				$rCliente->setTelefono($cliente->getTelefono());
				$rCliente->setEmail($cliente->getEmail());
				
				$cliente = $rCliente;
			}
			
			$objDoctrine->persist($reserva->setCliente($cliente));
			$objDoctrine->flush();
			
			return $this->redirect($this->generateUrl('pagina_reservas_finalizar'));
		}
		
        return $this->render('proyectoHotelBundle:Reservas:cliente.html.twig',
			array('form' => $form->createView(),
			'error' => $error
		));
	}
	
	public function finalizarAction(Request $request)
    {
		$reserva = null;
		$this->get('purgador')->purgar();
		$sesion = $this->get("session");
		$objDoctrine = $this->getDoctrine()->getManager();
		
		if (!($reserva = self::cargarReserva($sesion))) {
			return $this->redirect($this->generateUrl('pagina_reservas'));
		}
		
		$uniCod = md5(round(microtime(true) * 1000));
		
		$reserva->setUniCod($uniCod);
		$objDoctrine->persist($reserva->setFechaPreReserva(new \DateTime("now")));
		$objDoctrine->flush();
		
		$email = \Swift_Message::newInstance()
			->setContentType("text/html")
			->setSubject('Confirma tu reserva')
			->setFrom('symfony2hotel@gmail.com')
			->setTo($reserva->getCliente()->getEmail())
			->setBody(
				$this->renderView(
					'proyectoHotelBundle:Reservas:email.html.twig',
					array('codigo' => $uniCod,
					'nombre' => $reserva->getCliente()->getNombre(),
					'dni' => $reserva->getCliente()->getDni(),
					'precio' => self::calcularImporte($reserva),
					'email' => $reserva->getCliente()->getEmail()
				))
		);
		$this->get('mailer')->send($email);
		
		$sesion->remove("id_reserva");
		
		return $this->render('proyectoHotelBundle:Reservas:finalizar.html.twig',
			array('codigo' => $uniCod,
			'email' => $reserva->getCliente()->getEmail()
		));
	}
	
	public function confirmarAction(Request $request, $codigo)
    {
		$this->get('purgador')->purgar();
		$objDoctrine = $this->getDoctrine()->getManager();
		
		$query = $objDoctrine->createQuery(
			'SELECT r
			 FROM proyectoHotelBundle:Reserva r
			 WHERE r.uniCod = :codigo AND 
			 r.confirmada = 0'
		)->setParameter('codigo', $codigo);
		
		$reserva = $query->getOneOrNullResult();
		$error = ""; $mensaje = "";
		
		if (is_null($reserva)) {
			$error = "Esa reserva ya está confirmada, no existe o ha expirado.";
		} else {
			$reserva->setConfirmada(1);
			$objDoctrine->flush();
			$mensaje = "Reserva confirmada correctamente.";
			self::enviarEmailFinal($reserva);
		}
		
		return $this->render('proyectoHotelBundle:Reservas:confirmar.html.twig',
			array('mensaje' => $mensaje,
			'error' => $error
		));
	}
	
	private function calcularImporte($reserva) {
		$importe = 0;
		
		$diferencia = $reserva->getFechaEntrada()->diff($reserva->getFechaSalida());
		$numDias = $diferencia->format('%a');
		
		$habitaciones = $reserva->getHabitaciones();
		foreach ($habitaciones as $habitacion) {
			$importe += $habitacion->getPrecio() * intval($numDias);
		}
		
		return $importe;
	}
	
	private function enviarEmailFinal($reserva) {
		$diferencia = $reserva->getFechaEntrada()->diff($reserva->getFechaSalida());
		$numDias = $diferencia->format('%a');
	
		$email = \Swift_Message::newInstance()
			->setContentType("text/html")
			->setSubject('Tu reserva ha sido realizada y confirmada con éxito.')
			->setFrom('symfony2hotel@gmail.com')
			->setTo($reserva->getCliente()->getEmail())
			->setBody(
				$this->renderView(
					'proyectoHotelBundle:Reservas:emailFinal.html.twig',
					array('nombre' => $reserva->getCliente()->getNombre(),
					'dni' => $reserva->getCliente()->getDni(),
					'habitaciones' => $reserva->getHabitaciones(),
					'numDias' => intval($numDias),
					'total' => self::calcularImporte($reserva),
			)));
		$this->get('mailer')->send($email);
	}
	
	private function validarDni($nif) {
		if (!is_null($nif)) {
			$partes = explode('-', $nif);
			if (count($partes) > 1) {
				$numeros = $partes[0];
				$letra = strtoupper($partes[1]);
				if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra) {
				   return true;
				} else {
				   return false;
				}
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	
	private function cargarReserva($sesion) {
		if ($sesion->has("id_reserva")) {
			$repositorio = $this->getDoctrine()->getRepository('proyectoHotelBundle:Reserva');
			return $repositorio->find($sesion->get("id_reserva"));
		} else {
			return false;
		}
	}
	
	private function reservarHabitaciones($idHabitaciones, $doctrine, $reserva) {
		if (!is_null($idHabitaciones)) {
			$reserva->setFechaPreReserva(new \DateTime("now"));
			$doctrine->persist($reserva);
			
			foreach ($idHabitaciones as $idHab) {
				$repositorio = $this->getDoctrine()->getRepository('proyectoHotelBundle:Habitacion');
				$habitacion = $repositorio->find($idHab);
				
				$doctrine->persist($reserva->addHabitacione($habitacion));
			}
			
			$doctrine->flush();
			return true;
		} else {
			return false;
		}
	}
	
	private function obtenerHabitaciones($reserva) {
		$habitaciones = $reserva->getTipoHabitacion()->getHabitaciones();
		$habitacionesLibres = array();
		$libre = true;
		$entrada = $reserva->getFechaEntrada();
		$salida = $reserva->getFechaSalida();
		
		foreach ($habitaciones as $habitacion) {
			$libre = true;
			
			foreach ($habitacion->getReservas() as $reservaHab) {
				$entradaHab = $reservaHab->getFechaEntrada();
				$salidaHab = $reservaHab->getFechaSalida();
				
				if (($entrada >= $entradaHab) && ($entrada <= $salidaHab)) {
					$libre = false;
				} else {
					if (($salida >= $entradaHab) && ($salida <= $salidaHab)) {
						$libre = false;
					}
				}
			}
			
			if ($libre) {
				array_push($habitacionesLibres, $habitacion);
			}
		}
		
		return $habitacionesLibres;
	}
}