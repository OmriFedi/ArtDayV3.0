<?php
/**
 * Created by PhpStorm.
 * User: Omri Fedi
 * Date: 13/02/2017
 * Time: 22:41
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ProduitEnPromotion
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitEnPromotionRepository")
 */
class ProduitEnPromotion
{

    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Produit")
     * @ORM\JoinColumn(name="produit_id",referencedColumnName="id")
     */
    private  $produit_if;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Promotion")
     * @ORM\JoinColumn(name="promotion_id",referencedColumnName="id")
     */
    private $promotion_id;

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
    public function getProduitIf()
    {
        return $this->produit_if;
    }

    /**
     * @param mixed $produit_if
     */
    public function setProduitIf($produit_if)
    {
        $this->produit_if = $produit_if;
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




}