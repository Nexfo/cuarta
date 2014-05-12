<?php

namespace proyecto\HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use proyecto\HotelBundle\Form\Type\ReservaMinType;
use proyecto\HotelBundle\Entity\Reserva;

class HotelController extends Controller
{
    public function mostrarAction()
    {
		$reserva = new Reserva();
		
		$formReserv = $this->createForm(new ReservaMinType(), $reserva, array(
			'action' => $this->generateUrl('pagina_reservas')
		));
		
		return $this->render('proyectoHotelBundle:Hotel:hotel.html.twig',
			array('formReserva' => $formReserv->createView()
		));
    }
}