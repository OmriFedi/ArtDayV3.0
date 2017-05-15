<?php

namespace AppBundle\Controller;

use AppBundle\Entity\QuantiteCommandee;
use AppBundle\Entity\BonCommande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Quantitecommandee controller.
 *
 */
class QuantiteCommandeeController extends Controller
{
    /**
     * Lists all quantiteCommandee entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $quantiteCommandees = $em->getRepository('AppBundle:QuantiteCommandee')->findAll();

        return $this->render('quantitecommandee/index.html.twig', array(
            'quantiteCommandees' => $quantiteCommandees,
        ));
    }

    /**
     * Creates a new quantiteCommandee entity.
     *
     */
    public function newAction(Request $request)
    {
        $quantiteCommandee = new Quantitecommandee();
        $form = $this->createForm('AppBundle\Form\QuantiteCommandeeType', $quantiteCommandee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($quantiteCommandee);
            $em->flush($quantiteCommandee);

            return $this->redirectToRoute('quantitecommandee_show', array('id' => $quantiteCommandee->getId()));
        }

        return $this->render('quantitecommandee/new.html.twig', array(
            'quantiteCommandee' => $quantiteCommandee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a quantiteCommandee entity.
     *
     */
    public function showAction(QuantiteCommandee $quantiteCommandee)
    {
        $deleteForm = $this->createDeleteForm($quantiteCommandee);

        return $this->render('quantitecommandee/show.html.twig', array(
            'quantiteCommandee' => $quantiteCommandee,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing quantiteCommandee entity.
     *
     */
    public function editAction(Request $request, QuantiteCommandee $quantiteCommandee)
    {
        $deleteForm = $this->createDeleteForm($quantiteCommandee);
        $editForm = $this->createForm('AppBundle\Form\QuantiteCommandeeType', $quantiteCommandee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quantitecommandee_edit', array('id' => $quantiteCommandee->getId()));
        }

        return $this->render('quantitecommandee/edit.html.twig', array(
            'quantiteCommandee' => $quantiteCommandee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a quantiteCommandee entity.
     *
     */
    public function deleteAction(Request $request, QuantiteCommandee $quantiteCommandee)
    {
        $form = $this->createDeleteForm($quantiteCommandee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($quantiteCommandee);
            $em->flush($quantiteCommandee);
        }

        return $this->redirectToRoute('quantitecommandee_index');
    }

    /**
     * Creates a form to delete a quantiteCommandee entity.
     *
     * @param QuantiteCommandee $quantiteCommandee The quantiteCommandee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(QuantiteCommandee $quantiteCommandee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('quantitecommandee_delete', array('id' => $quantiteCommandee->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }






    public function AjouterCommandeAction(Request $request)
    {

        $req = $request->request->all();
        $total = $req['total'];
        $c = $req['compteur'];
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {


            $user = $this->getUser();
            $id_user = $user->getId();
            $description = "";

            for ($i = 1; $i < $c; $i++) {
                $item = $req['item_name_' . $i];
                $quantite = $req['quantity_' . $i];
                $prixUnit = $req['amount_' . $i];



                $description = "<tr>
                                   <td>" . $item . "</td>
                                    <td class='text-center'>" . $prixUnit . "</td>
                                    <td class='text-center'>" . $quantite . "</td>
                                    
                                </tr>" . $description;
            }
            $m = new BonCommande();
            $m->setTotal($total);
            $m->setBonCommande($description);
            $m->setUserId($id_user);
            $m->setValide(0);
            $m->setArchive(0);

            $em = $this->get('doctrine.orm.entity_manager');
            $em->persist($m);
            $em->flush();

            $id_commande = $m->getId();



            for ($i = 1; $i < $c; $i++) {
                $item = $req['item_name_' . $i];
                $quantite = $req['quantity_' . $i];
                $prixUnit = $req['amount_' . $i];
                $it = (int)$item;
                $p_c = new QuantiteCommandee();
                $p_c->setProduitId($it);
                $p_c->setQuantiteC($quantite);
                $p_c->setBoncommandeId($id_commande);
                $em = $this->get('doctrine.orm.entity_manager');
                $em->persist($p_c);
                $em->flush();


            }


            return $this->render(':Commande:devis.html.twig', array("description" => $description, "total" => $total, "user" => $user));


        } else {

            return $this->redirectToRoute('fos_user_security_login');

        }


    }
    public function AfficherCommandeAction()
    {

        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository('AppBundle:BonCommande')->findAll();
        $user=$em->getRepository('AppBundle:User')->findAll();
        return $this->render(':Commande:gestion_commande.html.twig', array("commande"=>$commande,"user"=>$user));

    }

    public function commandeAction($id)
    {
        $commande = $this->getDoctrine()
            ->getRepository('AppBundle:BonCommande')
            ->find($id);

        $corps_commande = $commande->getBonCommande();
        $total = $commande->getTotal();
        $id_user = $commande->getUserId();

        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->find($id_user);


        return $this->render(':Commande:devis.html.twig', array("description" => $corps_commande, "total" => $total, "user" => $user));

    }
    public function validerAction(Request $request,$id)
    {

        $commande = $this->getDoctrine()
            ->getRepository('AppBundle:BonCommande')
            ->find($id);

        $commande->setValide(1);

        $em = $this->getDoctrine()->getManager();


        $em->persist($commande);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));



    }

    public function archiverAction(Request $request,$id){

        $commande = $this->getDoctrine()
            ->getRepository('AppBundle:BonCommande')
            ->find($id);

        $commande->setArchive(1);

        $em = $this->getDoctrine()->getManager();


        $em->persist($commande);
        $em->flush();

        return $this->redirect($request->headers->get('referer'));



    }


    public function archiveAction()
    {
        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository('AppBundle:BonCommande')->findAll();
        $user=$em->getRepository('AppBundle:User')->findAll();




        return $this->render(':Commande:archive.html.twig', array("commande"=>$commande,"user"=>$user));

    }



}
