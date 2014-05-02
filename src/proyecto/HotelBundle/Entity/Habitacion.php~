<?php

namespace proyecto\HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Habitacion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Habitacion
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
	 * @ORM\Column(name="nombre", type="string")
	 */
	private $nombre;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="imagen", type="string")
	 */
	private $imagen;
	
	/**
	 * @var float
	 * 
	 * @ORM\Column(name="precio", type="float")
	 */
	private $precio;
	
	/**
     * @ORM\ManyToOne(targetEntity="TipoHabitacion")
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
    */
	private $tipo;
	
	/**
     * @ORM\ManyToOne(targetEntity="Reserva", inversedBy="habitaciones")
     * @ORM\JoinColumn(name="reserva_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $reserva;


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
     * @return Habitacion
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
     * Set imagen
     *
     * @param string $imagen
     * @return Habitacion
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set precio
     *
     * @param \double $precio
     * @return Habitacion
     */
    public function setPrecio(\double $precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return \double 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set reserva
     *
     * @param \proyecto\HotelBundle\Entity\Reserva $reserva
     * @return Habitacion
     */
    public function setReserva(\proyecto\HotelBundle\Entity\Reserva $reserva = null)
    {
        $this->reserva = $reserva;

        return $this;
    }

    /**
     * Get reserva
     *
     * @return \proyecto\HotelBundle\Entity\Reserva 
     */
    public function getReserva()
    {
        return $this->reserva;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Habitacion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}
