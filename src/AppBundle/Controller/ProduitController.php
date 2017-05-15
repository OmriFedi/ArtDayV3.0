<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Produit controller.
 *
 */
class ProduitController extends Controller
{
    /**
     * Lists all produit entities.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('AppBundle:Produit')->findAll();
        return $this->render('produit/index.html.twig', array(
            'produits' => $produits,
        ));
    }

    /**
     * Creates a new produit entity.
     *
     */
    public function newAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm('AppBundle\Form\ProduitType', $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $file=$form['image']->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('upload_directory'),
                $fileName
            );
            $produit->setImage($fileName);
            $em->persist($produit);
            $em->flush($produit);

            return $this->redirectToRoute('produit_show', array('id' => $produit->getId()));
        }

        return $this->render('produit/new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produit entity.
     *
     */
    public function showAction(Produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);

        return $this->render('produit/show.html.twig', array(
            'produit' => $produit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produit entity.
     *
     */
    public function editAction(Request $request, Produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('AppBundle\Form\ProduitType', $produit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if ($editForm['image']->getData()!=null){
                $file=$editForm['image']->getData();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('upload_directory'),
                    $fileName
                );
                $produit->setImage($fileName);
                $this->getDoctrine()->getManager()->flush();
            }


            return $this->redirectToRoute('produit_edit', array('id' => $produit->getId()));
        }

        return $this->render('produit/edit.html.twig', array(
            'produit' => $produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produit entity.
     *
     */
    public function deleteAction(Request $request, Produit $produit)
    {
        $form = $this->createDeleteForm($produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produit);
            $em->flush($produit);
        }

        return $this->redirectToRoute('produit_index');
    }

    /**
     * Creates a form to delete a produit entity.
     *
     * @param Produit $produit The produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produit_delete', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }




    public  function productAction(Request $request,$id)

    {
        $em = $this->getDoctrine()->getEntityManager();
        $req= $em->getRepository("AppBundle:Produit")->findBy(array('categorie_id' => $id),array('id' => 'ASC'));
        $entities = $this->get('knp_paginator');
        $modeles = $entities->paginate($req,
            $request->query->getInt('p', 1), 2);
        $categories= $em->getRepository("AppBundle:Categorie")->findAll();

        $titre = $em->getRepository('AppBundle:Categorie')->find($id);

        return $this->render("produit/produits.html.twig",array("product"=>$modeles,'modeles'=>$categories,'titre'=>$titre));
    }


    public  function details_productAction(Request $request,$id){

        $em = $this->getDoctrine()->getEntityManager();
        $categories= $em->getRepository("AppBundle:Categorie")->findAll();
        $details = $em->getRepository('AppBundle:Produit')->find($id);
        return $this->render(":produit:details.html.twig",array('details'=>$details,'modeles'=>$categories));

    }
}
