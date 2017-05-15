<?php
/**
 * Created by PhpStorm.
 * User: Omri Fedi
 * Date: 17/02/2017
 * Time: 04:46
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class QuantiteLivreRepository extends EntityRepository
{


    public function getQuantiteALivre($id){

        $query=$this->getEntityManager()->createQuery("
        SELECT  ql.quantite_l,qc.quantite_c,p.id,bc.bonCommande,bl.num_bl,bl.date_l,u.username,u.city,u.streetAddress, 
         u.country
         
         
         From AppBundle:QuantiteLivre ql,
                AppBundle:QuantiteCommandee qc,
                AppBundle:Produit p,
                AppBundle:BonCommande bc,
                AppBundle:BonLivraison bl,
                AppBundle:User u WHERE 
                
                ql.quantitecommandee_id = qc.id AND 
                ql.bonlivraison_id = bl.id AND 
                qc.boncommande_id = bc.id AND 
                bc.user_id  = u.id
                
                 
                AND ql.id=:id
         
        
        ")->setParameter('id',$id);


        return $query->getResult();
    }
}