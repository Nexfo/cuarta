<?php

namespace proyecto\HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Reserva
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Reserva
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
     * @var integer
     *
     * @ORM\Column(name="adultos", type="integer")
     */
	private $adultos;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="ninios", type="integer")
     */
	private $ninios;
	/* Menores de 12 años, 12 o más se considerán adultos */
	
    /**
     * @var \Date
     *
     * @ORM\Column(name="fecha_entrada", type="date")
     */
	private $fecha_entrada;
	
    /**
     * @var \Date
     *
     * @ORM\Column(name="fecha_salida", type="date")
     */
	private $fecha_salida;
	
	/**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="reservas")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	private $cliente;
	
    /**
     * @ORM\OneToMany(targetEntity="Habitacion", mappedBy="reserva")
     */
	private $habitaciones;
	
    public function __construct()
    {
        /*parent::__construct();*/
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
     * Set adultos
     *
     * @param integer $adultos
     * @return Reserva
     */
    public function setAdultos($adultos)
    {
        $this->adultos = $adultos;

        return $this;
    }

    /**
     * Get adultos
     *
     * @return integer 
     */
    public function getAdultos()
    {
        return $this->adultos;
    }

    /**
     * Set ninios
     *
     * @param integer $ninios
     * @return Reserva
     */
    public function setNinios($ninios)
    {
        $this->ninios = $ninios;

        return $this;
    }

    /**
     * Get ninios
     *
     * @return integer 
     */
    public function getNinios()
    {
        return $this->ninios;
    }

    /**
     * Set fecha_entrada
     *
     * @param \DateTime $fechaEntrada
     * @return Reserva
     */
    public function setFechaEntrada($fechaEntrada)
    {
        $this->fecha_entrada = $fechaEntrada;

        return $this;
    }

    /**
     * Get fecha_entrada
     *
     * @return \DateTime 
     */
    public function getFechaEntrada()
    {
        return $this->fecha_entrada;
    }

    /**
     * Set fecha_salida
     *
     * @param \DateTime $fechaSalida
     * @return Reserva
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fecha_salida = $fechaSalida;

        return $this;
    }

    /**
     * Get fecha_salida
     *
     * @return \DateTime 
     */
    public function getFechaSalida()
    {
        return $this->fecha_salida;
    }

    /**
     * Set cliente
     *
     * @param \proyecto\HotelBundle\Entity\Cliente $cliente
     * @return Reserva
     */
    public function setCliente(\proyecto\HotelBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \proyecto\HotelBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Add habitaciones
     *
     * @param \proyecto\HotelBundle\Entity\Habitacion $habitaciones
     * @return Reserva
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
