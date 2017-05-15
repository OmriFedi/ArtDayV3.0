<?php
/**
 * Created by PhpStorm.
 * User: Omri Fedi
 * Date: 14/02/2017
 * Time: 18:16
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BonLivraison
 * @ORM\Entity()
 */
class BonLivraison
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
    private $num_bl;


    /**
     * @ORM\Column(type="datetime")
     */
    private $date_l;




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
    public function getNumBl()
    {
        return $this->num_bl;
    }

    /**
     * @param mixed $num_bl
     */
    public function setNumBl($num_bl)
    {
        $this->num_bl = $num_bl;
    }

    /**
     * @return mixed
     */
    public function getDateL()
    {
        return $this->date_l;
    }

    /**
     * @param mixed $date_l
     */
    public function setDateL($date_l)
    {
        $this->date_l = $date_l;
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->num_bl ;
    }


}