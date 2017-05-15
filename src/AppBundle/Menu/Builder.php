<?php
namespace AppBundle\Menu;

/**
 * Created by PhpStorm.
 * User: Omri Fedi
 * Date: 18/02/2017
 * Time: 17:09
 */

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements  ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'nav navbar-nav'));


        // create another menu item

        $menu->addChild('Home', array('route' => 'Index_page'));
        $menu->addChild('Promotion', array('route' => 'front_produit_promotion'));
        $menu->addChild('Reclamation', array('route' => 'Front_reclamation'));
        $menu->addChild('Contact', array('route' => 'Front_contact'));
        // you can also add sub level's to your menu's as follows
      //  $menu['About Me']->addChild('Edit profile', array('route' => 'edit_profile'));

        // ... add more children

        return $menu;
    }


    public function categorieMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(array('class' => 'nav'));

        //   $menu->addChild('Home', array('route' => 'Index_page'));


        /*
           // access services from the container!
           $em = $this->container->get('doctrine')->getManager();
           // findMostRecent and Blog are just imaginary examples
           $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();

           $menu->addChild('Latest Blog Post', array(
               'route' => 'blog_show',
               'routeParameters' => array('id' => $blog->getId())
           ));
        */

        // create another menu item

        $menu->addChild('Categorie1', array('route' => 'Index_page'))->setAttribute('icon', 'icon-list');

        // you can also add sub level's to your menu's as follows
        //  $menu['About Me']->addChild('Edit profile', array('route' => 'edit_profile'));

        // ... add more children

        return $menu;
    }

}