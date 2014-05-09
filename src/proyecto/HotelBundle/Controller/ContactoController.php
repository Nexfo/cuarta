<?php

namespace proyecto\HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use proyecto\HotelBundle\Form\Type\EmailType;
use proyecto\HotelBundle\Entity\Email;
use Symfony\Component\HttpFoundation\Request;
use proyecto\HotelBundle\Form\Type\ReservaMinType;
use proyecto\HotelBundle\Entity\Reserva;

class ContactoController extends Controller
{
    public function mostrarAction()
    {
		$email = new Email();
		
		$reserva = new Reserva();
		
		$formReserv = $this->createForm(new ReservaMinType(), $reserva, array(
			'action' => $this->generateUrl('pagina_reservas')
		));
		
		$form = $this->createForm(new EmailType(), $email);
		
		return $this->render('proyectoHotelBundle:Contacto:contacto.html.twig',
			array('form' => $form->createView(),
			'formRserv' => $formReserv->createView(),
		));
    }
	
    public function procesarAction(Request $request)
    {
		$email = new Email();
		
		$form = $this->createForm(new EmailType(), $email);		
		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$objDoctrine = $this->getDoctrine()->getManager();
			
			$email->setIp($request->getClientIp());
			
			self::enviarEmail($email);
			
			$objDoctrine->persist($email);
			$objDoctrine->flush();
		}
		
		return $this->redirect($this->generateUrl('contacto'));
    }
	
	private function enviarEmail ($email) {
		$mensaje = \Swift_Message::newInstance()
			->setContentType("text/html")
			->setSubject($email->getAsunto())
			->setFrom($email->getEmail())
			->setTo('symfony2hotel@gmail.com')
			->setBody(
				$this->renderView(
					'proyectoHotelBundle:Contacto:email.html.twig',
					array(
					'nombre' => $email->getNombre(),
					'email' => $email->getEmail(),
					'ip' => $email->getIp(),
					'mensaje' => $email->getMensaje()
				))
			)
		;
		$this->get('mailer')->send($mensaje);
	}
}
