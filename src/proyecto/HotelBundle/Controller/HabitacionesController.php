<?php

namespace proyecto\HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use proyecto\HotelBundle\Form\Type\EmailType;
use proyecto\HotelBundle\Entity\Email;
use Symfony\Component\HttpFoundation\Request;
use proyecto\HotelBundle\Form\Type\ReservaMinType;
use proyecto\HotelBundle\Entity\Reserva;

class HabitacionesController extends Controller
{
    public function mostrarAction($tipo)
    {
		$repositorio = $this->getDoctrine()->getRepository('proyectoHotelBundle:TipoHabitacion');
		$tipos = $repositorio->findAll();
		
		$habitaciones = null;
		$titulo = "";
		
		if ($tipo != "") {
			$objDoctrine = $this->getDoctrine()->getManager();
			$query = $objDoctrine->createQuery(
				'SELECT t
				 FROM proyectoHotelBundle:TipoHabitacion t
				 WHERE t.slug = :tipo'
			)->setParameter('tipo', $tipo);
			$tipoHab = $query->getOneOrNullResult();
			
			if (!is_null($tipoHab)) {
				$titulo = $tipoHab->getNombrePlural();
				$habitaciones = $tipoHab->getHabitaciones();
			}
		}
		
		$reserva = new Reserva();
		$form = $this->createForm(new ReservaMinType(), $reserva, array(
			'action' => $this->generateUrl('pagina_reservas')
		));
		
		$repositorio = $this->getDoctrine()->getRepository('proyectoHotelBundle:Habitacion');
		$fotos = $repositorio->findAll();
		
		return $this->render('proyectoHotelBundle:Habitaciones:habitaciones.html.twig',
			array('tipos' => $tipos,
			'tipoSlug' => $tipo,
			'form_reserva' => $form->createView(),
			'habitaciones' => $habitaciones,
			'titulo' => $titulo,
			'habitacionesFotos' => $fotos
		));
    }
}