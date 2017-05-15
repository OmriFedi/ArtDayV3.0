<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Contact;
use AppBundle\Entity\Reclamation;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $modeles = $em->getRepository('AppBundle:Categorie')->findAll();
        $products = $em->getRepository('AppBundle:Produit')->findAll();
        return $this->render('base.html.twig', array('modeles' => $modeles,'products'=>$products));;
    }

    public function produitEnPromotionAction(){
        $em = $this->getDoctrine()->getManager();

        $produitEnPromotions = $em->getRepository('AppBundle:ProduitEnPromotion')->findAll();
        return $this->render('AppBundle:FrontProduitPromotion:index.html.twig', array(
            'produitEnPromotions' => $produitEnPromotions,
        ));
    }


    public function contactAction(Request $request){

        $contact = new Contact();
        $form = $this->createForm('AppBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush($contact);

            //  return $this->redirectToRoute('contact_show', array('id' => $contact->getId()));
        }

        return $this->render('AppBundle::FrontContact.html.twig',array(
            'contact' => $contact,
            'form' => $form->createView(),
        ));
    }


    public function reclamationAction(Request $request){

        $reclamation = new Reclamation();
        $form = $this->createForm('AppBundle\Form\ReclamationType', $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush($reclamation);
        }

        return $this->render('AppBundle::FrontReclamation.html.twig',array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ));
    }

    public function mesReponsesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('AppBundle:Reclamation')->findAll();

        return $this->render('AppBundle::Reponses.html.twig', array(
            'reclamations' => $reclamations,
        ));
    }


}
