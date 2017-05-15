<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BonLivraison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Bonlivraison controller.
 *
 */
class BonLivraisonController extends Controller
{
    /**
     * Lists all bonLivraison entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bonLivraisons = $em->getRepository('AppBundle:BonLivraison')->findAll();

        return $this->render('bonlivraison/index.html.twig', array(
            'bonLivraisons' => $bonLivraisons,
        ));
    }

    /**
     * Creates a new bonLivraison entity.
     *
     */
    public function newAction(Request $request)
    {
        $bonLivraison = new Bonlivraison();
        $form = $this->createForm('AppBundle\Form\BonLivraisonType', $bonLivraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bonLivraison);
            $em->flush($bonLivraison);

            return $this->redirectToRoute('bonlivraison_show', array('id' => $bonLivraison->getId()));
        }

        return $this->render('bonlivraison/new.html.twig', array(
            'bonLivraison' => $bonLivraison,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bonLivraison entity.
     *
     */
    public function showAction(BonLivraison $bonLivraison)
    {
        $deleteForm = $this->createDeleteForm($bonLivraison);

        return $this->render('bonlivraison/show.html.twig', array(
            'bonLivraison' => $bonLivraison,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bonLivraison entity.
     *
     */
    public function editAction(Request $request, BonLivraison $bonLivraison)
    {
        $deleteForm = $this->createDeleteForm($bonLivraison);
        $editForm = $this->createForm('AppBundle\Form\BonLivraisonType', $bonLivraison);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bonlivraison_edit', array('id' => $bonLivraison->getId()));
        }

        return $this->render('bonlivraison/edit.html.twig', array(
            'bonLivraison' => $bonLivraison,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bonLivraison entity.
     *
     */
    public function deleteAction(Request $request, BonLivraison $bonLivraison)
    {
        $form = $this->createDeleteForm($bonLivraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bonLivraison);
            $em->flush($bonLivraison);
        }

        return $this->redirectToRoute('bonlivraison_index');
    }

    /**
     * Creates a form to delete a bonLivraison entity.
     *
     * @param BonLivraison $bonLivraison The bonLivraison entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BonLivraison $bonLivraison)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bonlivraison_delete', array('id' => $bonLivraison->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
