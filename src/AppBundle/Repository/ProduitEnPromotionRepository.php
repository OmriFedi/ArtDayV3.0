<?php
/**
 * Created by PhpStorm.
 * User: Omri Fedi
 * Date: 15/02/2017
 * Time: 22:24
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ProduitEnPromotionRepository extends EntityRepository
{

    public function findProduitEnPromotion($produi_id){
        $query=$this->getEntityManager()->createQuery(
            "SELECT a from AppBundle:ProduitEnPromotion a,
              AppBundle:Produit produit,
               AppBundle:Promotion promotion 
               WHERE a.produit_if=:produit_id  AND produit.id=:produit_id AND a.promotion_id=promotion.id")
            ->setParameter('produit_id',$produi_id);



        return $query->getResult();
    }

    public function findPrix($prix){

        $query=$this->getEntityManager()->createQuery(
            "SELECT a from  
              AppBundle:Produit a
               WHERE a.pix:=prix")->setParameter('prix',$prix);
        return $query->getResult();
    }
}