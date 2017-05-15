<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Promotion
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PromotionRepository")
 */
class Promotion
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $refPromotion;

    /**
     * @ORM\Column(type="float")
     */
    private $tauxPromotion;

    /**
     * @ORM\Column(type="string")
     */
    private $typePromotion;

    /**
     * @var \DateTime
     */
    private $dateDebut;

    /**
     * @var \DateTime
     */
    private $dateFin;


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
     * Set refPromotion
     *
     * @param string $refPromotion
     *
     * @return Promotion
     */
    public function setRefPromotion($refPromotion)
    {
        $this->refPromotion = $refPromotion;

        return $this;
    }

    /**
     * Get refPromotion
     *
     * @return string
     */
    public function getRefPromotion()
    {
        return $this->refPromotion;
    }

    /**
     * Set tauxPromotion
     *
     * @param float $tauxPromotion
     *
     * @return Promotion
     */
    public function setTauxPromotion($tauxPromotion)
    {
        $this->tauxPromotion = $tauxPromotion;

        return $this;
    }

    /**
     * Get tauxPromotion
     *
     * @return float
     */
    public function getTauxPromotion()
    {
        return $this->tauxPromotion;
    }

    /**
     * Set typePromotion
     *
     * @param string $typePromotion
     *
     * @return Promotion
     */
    public function setTypePromotion($typePromotion)
    {
        $this->typePromotion = $typePromotion;

        return $this;
    }

    /**
     * Get typePromotion
     *
     * @return string
     */
    public function getTypePromotion()
    {
        return $this->typePromotion;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Promotion
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Promotion
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->getRefPromotion();
    }


}

