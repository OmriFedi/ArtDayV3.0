<?php
/**
 * Created by PhpStorm.
 * User: Omri Fedi
 * Date: 14/02/2017
 * Time: 18:34
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class QuantiteCommandee
 * @ORM\Entity()
 */
class QuantiteCommandee
{

    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private  $quantite_c;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Produit")
     * @ORM\JoinColumn(name="produit_id",referencedColumnName="id")
     * @ORM\Column(type="integer")
     */

    private $produit_id;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Promotion")
     * @ORM\JoinColumn(name="promotion_id",referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    private $promotion_id;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BonCommande")
     * @ORM\JoinColumn(name="boncommande_id",referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    private $boncommande_id;

    /**
     * @return mixed
     */
    public function getBoncommandeId()
    {
        return $this->boncommande_id;
    }

    /**
     * @param mixed $boncommande_id
     */
    public function setBoncommandeId($boncommande_id)
    {
        $this->boncommande_id = $boncommande_id;
    }






    /**
     * @return mixed
     */
    public function getPromotionId()
    {
        return $this->promotion_id;
    }

    /**
     * @param mixed $promotion_id
     */
    public function setPromotionId($promotion_id)
    {
        $this->promotion_id = $promotion_id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getQuantiteC()
    {
        return $this->quantite_c;
    }

    /**
     * @param mixed $quantite_c
     */
    public function setQuantiteC($quantite_c)
    {
        $this->quantite_c = $quantite_c;
    }

    /**
     * @return mixed
     */
    public function getProduitId()
    {
        return $this->produit_id;
    }

    /**
     * @param mixed $produit_id
     */
    public function setProduitId($produit_id)
    {
        $this->produit_id = $produit_id;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return (string)$this->quantite_c;
    }


}