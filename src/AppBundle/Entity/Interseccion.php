<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interseccion
 *
 * @ORM\Table(name="interseccion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InterseccionRepository")
 */
class Interseccion
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
     * @ORM\OneToMany(targetEntity="Semaforo", mappedBy="interseccion")
     */
    private $semaforos;

    /**
     * @ORM\ManyToMany(targetEntity="Calle", mappedBy="intersecciones")
     */
    private $calles;

    public function __construct() {
        $this->semaforos = new ArrayCollection();
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
     * Add semaforo
     *
     * @param \AppBundle\Entity\Semaforo $semaforo
     *
     * @return Interseccion
     */
    public function addSemaforo(\AppBundle\Entity\Semaforo $semaforo)
    {
        $this->semaforos[] = $semaforo;

        return $this;
    }

    /**
     * Remove semaforo
     *
     * @param \AppBundle\Entity\Semaforo $semaforo
     */
    public function removeSemaforo(\AppBundle\Entity\Semaforo $semaforo)
    {
        $this->semaforos->removeElement($semaforo);
    }

    /**
     * Get semaforos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSemaforos()
    {
        return $this->semaforos;
    }

    /**
     * Add calle
     *
     * @param \AppBundle\Entity\Calle $calle
     *
     * @return Interseccion
     */
    public function addCalle(\AppBundle\Entity\Calle $calle)
    {
        $this->calles[] = $calle;

        return $this;
    }

    /**
     * Remove calle
     *
     * @param \AppBundle\Entity\Calle $calle
     */
    public function removeCalle(\AppBundle\Entity\Calle $calle)
    {
        $this->calles->removeElement($calle);
    }

    /**
     * Get calles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCalles()
    {
        return $this->calles;
    }
}
