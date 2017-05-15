<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Commentaire;
use AppBundle\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;


class CommentaireController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }


    public function productAction()
        /*affichage des commentaires valide*/
    {
        $form2 = $this->createForm('AppBundle\Form\ProduitType');


        $em = $this->getDoctrine()->getManager();

        $cmnt = $em->getRepository('AppBundle:Commentaire')->findBy(array('valide' => 1), array('id' => 'DESC'));

        $c = new Commentaire();
        $Form = $this->createForm(CommentaireType::class, $c);
        return $this->render('Commentaire/Product.html.twig', array("cmnts" => $cmnt, "Form_1" => $Form->createView(),
            'form2' => $form2->createView()
        ));


    }


    public function gestion_commentaireAction()
    {
        /*creation des commentaires*/


        $em = $this->getDoctrine()->getManager();

        $cmnt = $em->getRepository('AppBundle:Commentaire')->findBy(array(), array('id' => 'DESC'));

        $c = new Commentaire();
        $Form = $this->createForm(CommentaireType::class, $c);
        return $this->render(':Commentaire:gestion_commentaire.html.twig', array("cmnts" => $cmnt, "Form_1" => $Form->createView()));


    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function add_commentaireAction(\Symfony\Component\HttpFoundation\Request $request)
    {


        $c = new Commentaire();
        $Form_1 = $this->createForm(CommentaireType::class, $c);
        $Form_1->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $cmnt = $em->getRepository('AppBundle:Commentaire')->findAll();

        if ($Form_1->isValid()) {


            $em->persist($c);
            $em->flush();
            return $this->redirectToRoute('product');

        }
        return $this->render('Commentaire/Product.html.twig', array("Form_1" => $Form_1->createView(), "cmnts" => $cmnt));
    }

    public function validerAction($id)
    {
        /*Acceptation des commentaires*/
        $em = $this->getDoctrine()->getManager();
        //Recuperation de l'entité Modele qui a  l'id= $id
        $cmnts = $em->getRepository('AppBundle:Commentaire')->find($id);

        $cmnts->setValide(1);

        $em->persist($cmnts);
        $em->flush();

        $c = new Commentaire();
        $Form = $this->createForm(CommentaireType::class, $c);


        $cmnt = $em->getRepository('AppBundle:Commentaire')->findBy(array(), array('id' => 'DESC'));


        return $this->redirectToRoute('gestion_commentaire');

    }


    public function supprimerAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('AppBundle:Commentaire');

        /** @var $product Product */
        $product = $repository->findOneBy(array('id' => $id));
        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('gestion_commentaire');
    }


    public function page_repondreAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('AppBundle:Commentaire');
        $cmnt = $repository->findOneBy(array('id' => $id));


        $Form = $this->createForm(CommentaireType::class, $cmnt);


        return $this->render(':Commentaire:repondre.html.twig', array("Form_1" => $Form->createView(), "cmnt" => $cmnt, "id" => $id));

    }

    public function repondreAction(Request $request)
    {


        /*ajout commentaire reponse */
        // $_POST parameters
        $id = $request->request->get('id');

        $reponse = $request->request->get('d');

        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('AppBundle:Commentaire');
        $cmnt = $repository->findOneBy(array('id' => $id));

        $cmnt->setReponse($reponse);

        $em->persist($cmnt);
        $em->flush();

        return $this->redirectToRoute('gestion_commentaire');


    }
}

