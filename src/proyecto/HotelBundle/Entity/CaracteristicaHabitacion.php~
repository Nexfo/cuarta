<?php

namespace proyecto\HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CaracteristicaHabitacion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CaracteristicaHabitacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

	/**
     * @ORM\ManyToMany(targetEntity="Habitacion", mappedBy="caracteristicas")
	 */
	private $habitaciones;

    public function __construct()
    {
        $this->habitaciones = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CaracteristicaHabitacion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add habitaciones
     *
     * @param \proyecto\HotelBundle\Entity\Habitacion $habitaciones
     * @return CaracteristicaHabitacion
     */
    public function addHabitacione(\proyecto\HotelBundle\Entity\Habitacion $habitaciones)
    {
        $this->habitaciones[] = $habitaciones;

        return $this;
    }

    /**
     * Remove habitaciones
     *
     * @param \proyecto\HotelBundle\Entity\Habitacion $habitaciones
     */
    public function removeHabitacione(\proyecto\HotelBundle\Entity\Habitacion $habitaciones)
    {
        $this->habitaciones->removeElement($habitaciones);
    }

    /**
     * Get habitaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHabitaciones()
    {
        return $this->habitaciones;
    }
}
