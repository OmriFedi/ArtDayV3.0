<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Promotion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PromotionController extends Controller
{



    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $Promotions = $em->getRepository('AppBundle:Promotion')->findAll();

        return $this->render('Promotion/index.html.twig', array(
            'promotions' => $Promotions,
        ));
    }

    /**
     * Creates a new Promotion entity.
     *
     */
    public function newAction(Request $request)
    {
        $Promotion = new promotion();
        $form = $this->createForm('AppBundle\Form\PromotionType', $Promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();



            $em->persist($Promotion);
            $em->flush($Promotion);

            return $this->redirectToRoute('promotion_show', array('id' => $Promotion->getId()));
        }

        return $this->render('promotion/new.html.twig', array(
            'Promotion' => $Promotion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Promotion entity.
     *
     */
    public function showAction(Promotion $Promotion)
    {
        $deleteForm = $this->createDeleteForm($Promotion);

        return $this->render('promotion/show.html.twig', array(
            'Promotion' => $Promotion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Promotion entity.
     *
     */
    public function editAction(Request $request, Promotion $Promotion)
    {
        $deleteForm = $this->createDeleteForm($Promotion);
        $editForm = $this->createForm('AppBundle\Form\PromotionType', $Promotion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('promotion_edit', array('id' => $Promotion->getId()));
        }

        return $this->render('promotion/edit.html.twig', array(
            'Promotion' => $Promotion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Promotion entity.
     *
     */
    public function deleteAction(Request $request, Promotion $Promotion)
    {
        $form = $this->createDeleteForm($Promotion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($Promotion);
            $em->flush($Promotion);
        }

        return $this->redirectToRoute('promotion_index');
    }

    /**
     * Creates a form to delete a Promotion entity.
     *
     * @param Promotion $Promotion The Promotion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Promotion $Promotion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('promotion_delete', array('id' => $Promotion->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
