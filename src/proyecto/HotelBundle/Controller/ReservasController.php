<?php

namespace proyecto\HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use proyecto\HotelBundle\Form\Type\ReservaMinType;
use proyecto\HotelBundle\Entity\Reserva;

class ReservasController extends Controller
{
    public function primeraAction()
    {
		$reserva = new Reserva();
		
		$form = $this->createForm(new ReservaMinType(), $reserva, array(
			'action' => $this->generateUrl('pagina_reservas')
		));
		
		return $this->render('proyectoHotelBundle:Reservas:primera.html.twig', array('form' => $form->createView()));
    }
}
