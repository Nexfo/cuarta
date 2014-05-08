<?php

namespace proyecto\HotelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use proyecto\HotelBundle\Form\Type\ReservaMinType;

class ContactoController extends Controller
{
    public function mostrarAction()
    {
		return $this->render('proyectoHotelBundle:Default:index.html.twig');
    }
	
    public function procesarAction()
    {
		return $this->render('proyectoHotelBundle:Default:index.html.twig');
    }
}
