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
			'action' => $this->generateUrl('pagina_reservas_habitacion')
		));
		
        return $this->render('proyectoHotelBundle:Default:index.html.twig', array('form' => $form->createView()));
    }
}
