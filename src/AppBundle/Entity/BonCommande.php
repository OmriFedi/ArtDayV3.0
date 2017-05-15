<?php
/**
 * Created by PhpStorm.
 * User: Omri Fedi
 * Date: 17/02/2017
 * Time: 03:49
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BonCommande
 * @ORM\Entity
 */
class BonCommande
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

        private $bonCommande;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\Column(type="float")
     */

    private $total;


    /**
     * @ORM\Column(type="boolean")
     */

    private $valide;


    /**
     * @ORM\Column(type="boolean")
     */

    private $archive;

    /**
     * @return mixed
     */
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * @param mixed $valide
     */
    public function setValide($valide)
    {
        $this->valide = $valide;
    }

    /**
     * @return mixed
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * @param mixed $archive
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;
    }




    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }



    /**
     * @return mixed
     */
    public function getQuantiteCommandeeId()
    {
        return $this->quantiteCommandee_id;
    }

    /**
     * @param mixed $quantiteCommandee_id
     */
    public function setQuantiteCommandeeId($quantiteCommandee_id)
    {
        $this->quantiteCommandee_id = $quantiteCommandee_id;
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
    public function getBonCommande()
    {
        return $this->bonCommande;
    }

    /**
     * @param mixed $bonCommande
     */
    public function setBonCommande($bonCommande)
    {
        $this->bonCommande = $bonCommande;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
    return $this->bonCommande;
    }


}