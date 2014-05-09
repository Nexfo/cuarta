<?php

namespace proyecto\HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TipoHabitacion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TipoHabitacion
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
     * @var string
     *
     * @ORM\Column(name="nombrePlural", type="string", length=255)
     */
    private $nombrePlural;

    /**
     * @var integer
     *
     * @ORM\Column(name="numPlazas", type="integer")
     */
    private $numPlazas;
	
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string")
     */
    private $slug;
	
    /**
     * @ORM\OneToMany(targetEntity="Habitacion", mappedBy="tipo")
     */
	protected $habitaciones;

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
     * @return TipoHabitacion
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
     * @return TipoHabitacion
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

    /**
     * Set numPlazas
     *
     * @param integer $numPlazas
     * @return TipoHabitacion
     */
    public function setNumPlazas($numPlazas)
    {
        $this->numPlazas = $numPlazas;

        return $this;
    }

    /**
     * Get numPlazas
     *
     * @return integer 
     */
    public function getNumPlazas()
    {
        return $this->numPlazas;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return TipoHabitacion
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set nombrePlural
     *
     * @param string $nombrePlural
     * @return TipoHabitacion
     */
    public function setNombrePlural($nombrePlural)
    {
        $this->nombrePlural = $nombrePlural;

        return $this;
    }

    /**
     * Get nombrePlural
     *
     * @return string 
     */
    public function getNombrePlural()
    {
        return $this->nombrePlural;
    }
}
