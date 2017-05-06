<?php

namespace ProjektBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjektBundle\Entity\Projekt;
use Symfony\Component\HttpFoundation\Response;
use ProjektBundle\Twig;
use Gedmo\Tree\Entity\MappedSuperclass\AbstractClosure;

class ProjektController extends Controller
{
	/**
     * @Route("/index", name="projekt_projekts_index")
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        // need an if statement for if a user is not logged in

        $userId = $user->getId();

        $projekts = $em->getRepository('ProjektBundle:Projekt')
                    ->findBy(array(
                        'user' => $userId));



        return $this->render('ProjektBundle:Default:index.html.twig', 
            ['projekts' => $projekts]);

    }

    /**
     * @Route("/{id}/show", name="projekt_show")
     */
    public function showAction(Projekt $projekt)
    {
        $projektId = $projekt->getId();

        $mainContainer = $this->container->get('app.main_controller');
        $submainContainer = $this->container->get('app.submain_controller');
        $mains = $mainContainer->findMains($projektId);
        // foreach($mains as $m) {
        //     $idtest = $m->getId();
        //     echo "<pre>";
        //     print_r($submainContainer->findSubmains($idtest));
        //     echo "</pre>";
        // }

        // array_walk($mains, 'findSubmains');

         $em = $this->getDoctrine()->getManager();

        // $submains = $em->getRepository('ProjektBundle:Submain')
        //             ->findBy(array(
        //                 'mainId' => 1));

        // var_dump($submains);

        // foreach($mains as $m) {
        //     var_dump($m->getChildren());
        //  }

         
//         $nodes = $mains[0]->getChildren();
// $parent = $nodes[0]; //get Parent node 
// $children = $parent->getChildren(); // get Children of Parent Nodes

// $subChildren = array();

// foreach ($children as $child)
// {
//     $subChildren = array_merge($subChildren, $child->getChildren()->toArray());
// }

        return $this->render('ProjektBundle:Default:projekt/show.html.twig', array(
            'projekt' => $projekt,
            'mains' => $mains,
        ));
    }

}
