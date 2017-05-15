<?php
/**
 * Created by PhpStorm.
 * User: Omri Fedi
 * Date: 14/02/2017
 * Time: 18:19
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class QuantiteLivre
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuantiteLivreRepository")
 */

class QuantiteLivre
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
    private  $quantite_l;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BonLivraison")
     * @ORM\JoinColumn(name="bonlivraison_id",referencedColumnName="id")
     */
    private  $bonlivraison_id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\QuantiteCommandee")
     * @ORM\JoinColumn(name="quantitecommandee_id",referencedColumnName="id")
     */
    private  $quantitecommandee_id;

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
    public function getQuantiteL()
    {
        return $this->quantite_l;
    }

    /**
     * @param mixed $quantite_l
     */
    public function setQuantiteL($quantite_l)
    {
        $this->quantite_l = $quantite_l;
    }

    /**
     * @return mixed
     */
    public function getBonlivraisonId()
    {
        return $this->bonlivraison_id;
    }

    /**
     * @param mixed $bonlivraison_id
     */
    public function setBonlivraisonId($bonlivraison_id)
    {
        $this->bonlivraison_id = $bonlivraison_id;
    }

    /**
     * @return mixed
     */
    public function getQuantitecommandeeId()
    {
        return $this->quantitecommandee_id;
    }

    /**
     * @param mixed $quantitecommandee_id
     */
    public function setQuantitecommandeeId($quantitecommandee_id)
    {
           $this->quantitecommandee_id = $quantitecommandee_id;
    }




}