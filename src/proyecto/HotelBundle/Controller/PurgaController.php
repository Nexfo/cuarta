<?php

namespace proyecto\HotelBundle\Controller;

use proyecto\HotelBundle\Entity\Reserva;
use Doctrine\ORM\EntityManager;

class PurgaController
{
	private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function purgar()
    {
		$query = $this->em->createQuery(
			'SELECT r
			 FROM proyectoHotelBundle:Reserva r
			 WHERE r.confirmada = :conf'
		)->setParameter('conf', 0);
		$reservas = $query->getResult();
		
		$ahora = new \DateTime("now");
		
		foreach ($reservas as $reserva) {
			$fechaReserva = $reserva->getFechaPreReserva();
			$luego = clone $fechaReserva;
			$luego = $luego->modify( '+15 minutes' );
			
			if ($ahora < $luego) {
				if ($ahora > $fechaReserva) {
					// No borrar, la reserva no ha expirado todavia
				} else {
					$this->em->remove($reserva);
				}
			} else {
				$this->em->remove($reserva);
			}
		}
		
		$this->em->flush();
    }
}
