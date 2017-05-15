<?php
/**
 * Created by PhpStorm.
 * User: Ichraf
 * Date: 17/02/2017
 * Time: 19:14
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Produit;

use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zend\Json\Expr;

class GrapheController extends Controller
{
    public function chartLinAction()
    {
        $em = $this->getDoctrine()->getManager();
        $classes = $em->getRepository('AppBundle:Produit')->findAll();
        $tab = array();
        $categories = array();
        foreach ($classes as $classe) {
            array_push($tab, $classe->getPrix());
            array_push($categories, $classe->getNom());
        }
        // Chart
        $series = array(
            array("name" => "Prix", "data" => $tab)
        );
        $ob = new Highchart();
        $ob->chart->renderTo('linechart'); // #id du div où afficher le graphe
        $ob->title->text('Les Produit par prix');
        $ob->xAxis->title(array('text' => "Classe"));
        $ob->yAxis->title(array('text' => "Prix"));
        $ob->xAxis->categories($categories);
        $ob->series($series);
        return $this->render('Graphe/LineChart.html.twig',
            array(
                'chart' => $ob
            ));
    }
 public function cht3Action()
{
    $em = $this->getDoctrine()->getManager();
    $user = $em->getRepository('AppBundle:Reclamation')->findAll();

    $tablivraison = array();
    $tabproduits = array();
    $tabpromotions=array();

    foreach ($user as $value) {


        if ($value->getSujet()  == 'livraison') {
            array_push($tablivraison, $value);

        }
        if ($value->getSujet() == 'produits') {
            array_push($tabproduits, $value);
        }
        if ($value->getSujet() == 'promotion') {
            array_push($tabpromotions, $value);
        }
    }
    $nbrlivraison = count($tablivraison);
    $nbrpromotions = count($tabpromotions);
    $nbrproduits = count($tabproduits);


    $ob = new Highchart();
    $ob->chart->renderTo('piechart');
    $ob->title->text('poucentage de réclamation ');
    $ob->plotOptions->pie(array(
        'allowPointSelect' => true,
        'cursor' => 'pointer',
        'dataLabels' => array('enabled' => false),
        'showInLegend' => true
    ));
    $data = array(
        array('les livraisons', $nbrlivraison * 100 / count($user)),
        array('les promotions', $nbrpromotions* 100 / count($user)),
        array('les promotions', $nbrproduits* 100 / count($user)),


    );
    $ob->series(array(array('type' => 'pie', 'name' => 'Browser share', 'data' => $data)));
    return $this->render(':piechart:chart.html.twig',
        array(
            'chart' => $ob
        ));

}}