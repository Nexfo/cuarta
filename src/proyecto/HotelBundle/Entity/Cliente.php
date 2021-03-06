<?php

namespace proyecto\HotelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cliente
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cliente
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
	 * @ORM\Column(name="primer_apellido", type="string")
	 */
	private $primerApellido;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="dni", type="string", length=10, unique=true)
	 */
	private $dni;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="direccion", type="string")
	 */
	private $direccion;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="ciudad", type="string")
	 */
	private $ciudad;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="provincia", type="string")
	 */
	private $provincia;
	
	/**
	 * @var int
	 * 
	 * @ORM\Column(name="cod_postal", type="integer")
	 */
	private $cod_postal;
	
	/**
	 * @var int
	 * 
	 * @ORM\Column(name="telefono", type="integer")
	 */
	private $telefono;
	
	/**
	 * @var string
	 * 
	 * @ORM\Column(name="email", type="string")
	 */
	private $email;
	
    /**
     * @ORM\OneToMany(targetEntity="Reserva", mappedBy="cliente")
     */
	protected $reservas;

    public function __construct()
    {
        $this->reservas = new ArrayCollection();
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
     * @return Cliente
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
     * Set primerApellido
     *
     * @param string $primerApellido
     * @return Cliente
     */
    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    /**
     * Get primerApellido
     *
     * @return string 
     */
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * Set segundoApellido
     *
     * @param string $segundoApellido
     * @return Cliente
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return string 
     */
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Cliente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     * @return Cliente
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     * @return Cliente
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set cod_postal
     *
     * @param integer $codPostal
     * @return Cliente
     */
    public function setCodPostal($codPostal)
    {
        $this->cod_postal = $codPostal;

        return $this;
    }

    /**
     * Get cod_postal
     *
     * @return integer 
     */
    public function getCodPostal()
    {
        return $this->cod_postal;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     * @return Cliente
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Cliente
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add reservas
     *
     * @param \proyecto\HotelBundle\Entity\Reserva $reservas
     * @return Cliente
     */
    public function addReserva(\proyecto\HotelBundle\Entity\Reserva $reservas)
    {
        $this->reservas[] = $reservas;

        return $this;
    }

    /**
     * Remove reservas
     *
     * @param \proyecto\HotelBundle\Entity\Reserva $reservas
     */
    public function removeReserva(\proyecto\HotelBundle\Entity\Reserva $reservas)
    {
        $this->reservas->removeElement($reservas);
    }

    /**
     * Get reservas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReservas()
    {
        return $this->reservas;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return Cliente
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }
}
