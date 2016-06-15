<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Calle
 *
 * @ORM\Table(name="calle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CalleRepository")
 */
class Calle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @ORM\ManyToMany(targetEntity="Interseccion", inversedBy="calles")
     * @ORM\JoinTable(name="calles_intersecciones")
     */
    private $intersecciones;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->intersecciones = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Calle
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
     * Add interseccion
     *
     * @param \AppBundle\Entity\Interseccion $interseccione
     *
     * @return Calle
     */
    public function addInterseccione(\AppBundle\Entity\Interseccion $interseccion)
    {
        $this->intersecciones[] = $interseccion;

        return $this;
    }

    /**
     * Remove interseccion
     *
     * @param \AppBundle\Entity\Interseccion $interseccione
     */
    public function removeInterseccione(\AppBundle\Entity\Interseccion $interseccion)
    {
        $this->intersecciones->removeElement($interseccion);
    }

    /**
     * Get intersecciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIntersecciones()
    {
        return $this->intersecciones;
    }
}
