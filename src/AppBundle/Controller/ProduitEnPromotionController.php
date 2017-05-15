<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProduitEnPromotion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Produitenpromotion controller.
 *
 */
class ProduitEnPromotionController extends Controller
{
    /**
     * Lists all produitEnPromotion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $produitEnPromotions = $em->getRepository('AppBundle:ProduitEnPromotion')->findAll();


        return $this->render('produitenpromotion/index.html.twig', array(
            'produitEnPromotions' => $produitEnPromotions,
        ));
    }

    /**
     * Creates a new produitEnPromotion entity.
     *
     */
    public function newAction(Request $request)
    {
        $taux = "";
        $produitEnPromotion = new Produitenpromotion();
        $form = $this->createForm('AppBundle\Form\ProduitEnPromotionType', $produitEnPromotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $produit = $form['produit_if']->getData();
            $product_id = $produit->getId();

            $produitEnPromotions = $em->getRepository('AppBundle:ProduitEnPromotion')->findProduitEnPromotion($product_id);
            foreach ($produitEnPromotions as $Item) {

                $produit = $em->getRepository('AppBundle:Produit')->findPrix($Item->getProduitIf());
                $promotion = $em->getRepository('AppBundle:Promotion')->findPromotion($Item->getPromotionId());
                foreach ($promotion as $item)
                    $taux = $item->getTauxPromotion();


                foreach ($produit as $p) {
                    $nouveauPrix = ($p->getPrix() * $taux) / 100;
                    $p->setPrix($p->getPrix() - $nouveauPrix);
                    $em->persist($p);
                    $em->flush($p);
                }
            }

            $em->persist($produitEnPromotion);
            $em->flush($produitEnPromotion);


            return $this->redirectToRoute('produitenpromotion_show', array('id' => $produitEnPromotion->getId()));
        }

        return $this->render('produitenpromotion/new.html.twig', array(
            'produitEnPromotion' => $produitEnPromotion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produitEnPromotion entity.
     *
     */
    public function showAction(ProduitEnPromotion $produitEnPromotion)
    {
        $deleteForm = $this->createDeleteForm($produitEnPromotion);

        return $this->render('produitenpromotion/show.html.twig', array(
            'produitEnPromotion' => $produitEnPromotion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produitEnPromotion entity.
     *
     */
    public function editAction(Request $request, ProduitEnPromotion $produitEnPromotion)
    {
        $deleteForm = $this->createDeleteForm($produitEnPromotion);
        $editForm = $this->createForm('AppBundle\Form\ProduitEnPromotionType', $produitEnPromotion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produitenpromotion_edit', array('id' => $produitEnPromotion->getId()));
        }

        return $this->render('produitenpromotion/edit.html.twig', array(
            'produitEnPromotion' => $produitEnPromotion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produitEnPromotion entity.
     *
     */
    public function deleteAction(Request $request, ProduitEnPromotion $produitEnPromotion)
    {
        $form = $this->createDeleteForm($produitEnPromotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produitEnPromotion);
            $em->flush($produitEnPromotion);
        }

        return $this->redirectToRoute('produitenpromotion_index');
    }

    /**
     * Creates a form to delete a produitEnPromotion entity.
     *
     * @param ProduitEnPromotion $produitEnPromotion The produitEnPromotion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProduitEnPromotion $produitEnPromotion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produitenpromotion_delete', array('id' => $produitEnPromotion->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
