<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Semaforo
 *
 * @ORM\Table(name="semaforo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SemaforoRepository")
 */
class Semaforo
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
     * @var int
     *
     * @ORM\Column(name="frecuencia", type="integer")
     */
    private $frecuencia;

    /**
     * @ORM\ManyToOne(targetEntity="Interseccion", inversedBy="semaforos")
     * @ORM\JoinColumn(name="interseccion_id", referencedColumnName="id")
     */
    private $interseccion;

    /**
     * @ORM\ManyToOne(targetEntity="Calle")
     * @ORM\JoinColumn(name="calle_id", referencedColumnName="id")
     */
    private $calle;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;


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
     * Set frecuencia
     *
     * @param integer $frecuencia
     *
     * @return Semaforo
     */
    public function setFrecuencia($frecuencia)
    {
        $this->frecuencia = $frecuencia;

        return $this;
    }

    /**
     * Get frecuencia
     *
     * @return int
     */
    public function getFrecuencia()
    {
        return $this->frecuencia;
    }

    /**
     * Set interseccion
     *
     * @param \AppBundle\Entity\Interseccion $interseccion
     *
     * @return Semaforo
     */
    public function setInterseccion(\AppBundle\Entity\Interseccion $interseccion = null)
    {
        $this->interseccion = $interseccion;

        return $this;
    }

    /**
     * Get interseccion
     *
     * @return \AppBundle\Entity\Interseccion
     */
    public function getInterseccion()
    {
        return $this->interseccion;
    }

    /**
     * Set calle
     *
     * @param \AppBundle\Entity\Calle $calle
     *
     * @return Semaforo
     */
    public function setCalle(\AppBundle\Entity\Calle $calle = null)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle
     *
     * @return \AppBundle\Entity\Calle
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Calle
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
