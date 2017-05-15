<?php

namespace AppBundle\Controller;

use AppBundle\Entity\QuantiteLivre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Quantitelivre controller.
 *
 */
class QuantiteLivreController extends Controller
{
    /**
     * Lists all quantiteLivre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $quantiteLivres = $em->getRepository('AppBundle:QuantiteLivre')->findAll();

        return $this->render('quantitelivre/index.html.twig', array(
            'quantiteLivres' => $quantiteLivres,
        ));
    }

    /**
     * Creates a new quantiteLivre entity.
     *
     */
    public function newAction(Request $request)
    {
        $quantiteLivre = new Quantitelivre();
        $form = $this->createForm('AppBundle\Form\QuantiteLivreType', $quantiteLivre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $QuantiteL = $form->get('quantite_l')->getData();
            $QuantiteCo =  $form->get('quantitecommandee_id')->getData();



               if ( (int)$QuantiteL <=(int) $QuantiteCo->getQuantiteC()){
                   $em->persist($quantiteLivre);
                   $em->flush($quantiteLivre);
               }
               else {

                   return $this->redirectToRoute('quantitelivre_new');
               }







            return $this->redirectToRoute('quantitelivre_show', array('id' => $quantiteLivre->getId()));
        }

        return $this->render('quantitelivre/new.html.twig', array(
            'quantiteLivre' => $quantiteLivre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a quantiteLivre entity.
     *
     */
    public function showAction(QuantiteLivre $quantiteLivre)
    {
        $deleteForm = $this->createDeleteForm($quantiteLivre);

        return $this->render('quantitelivre/show.html.twig', array(
            'quantiteLivre' => $quantiteLivre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing quantiteLivre entity.
     *
     */
    public function editAction(Request $request, QuantiteLivre $quantiteLivre)
    {
        $deleteForm = $this->createDeleteForm($quantiteLivre);
        $editForm = $this->createForm('AppBundle\Form\QuantiteLivreType', $quantiteLivre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quantitelivre_edit', array('id' => $quantiteLivre->getId()));
        }

        return $this->render('quantitelivre/edit.html.twig', array(
            'quantiteLivre' => $quantiteLivre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a quantiteLivre entity.
     *
     */
    public function deleteAction(Request $request, QuantiteLivre $quantiteLivre)
    {
        $form = $this->createDeleteForm($quantiteLivre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($quantiteLivre);
            $em->flush($quantiteLivre);
        }

        return $this->redirectToRoute('quantitelivre_index');
    }

    /**
     * Creates a form to delete a quantiteLivre entity.
     *
     * @param QuantiteLivre $quantiteLivre The quantiteLivre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(QuantiteLivre $quantiteLivre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('quantitelivre_delete', array('id' => $quantiteLivre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    public  function  showLivraisonAction(Request $request,$id){


        $em = $this->getDoctrine()->getManager();

        $quantiteLivres = $em->getRepository('AppBundle:QuantiteLivre')->getQuantiteALivre($id);

        return $this->render('quantitelivre/maLivraison.html.twig',array(
            'livraison' => $quantiteLivres,
            ));


    }
}
