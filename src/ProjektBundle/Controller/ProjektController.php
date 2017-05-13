<?php

namespace ProjektBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjektBundle\Entity\Projekt;
use Symfony\Component\HttpFoundation\Response;
use ProjektBundle\Twig;
use Gedmo\Tree\Entity\MappedSuperclass\AbstractClosure;
use ProjektBundle\Form\ProjektType;

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

    public function returnMains($projektId)
    {
        $mains = $this->forward('ProjektBundle:Main:findMains', array(
            'projektId'  => $projektId,
        ));

        return $mains;
    }

    /**
     * @Route("/{id}/show", name="projekt_show")
     */
    public function showAction(Projekt $projekt)
    {
        //$em = $this->getDoctrine()->getManager();
        $projektId = $projekt->getId();

        // $mains = $this->returnMains($projektId);

        //$mainContainer = $this->container->get('app.main_controller');
        
        ///var_dump($mains);

            //var_dump($mains);
        // do I need this below?
        //$submainContainer = $this->container->get('app.submain_controller');
        //$mains = $mainContainer->findMains($projektId);

         

        return $this->render('ProjektBundle:Default:projekt/show.html.twig', array(
            'projekt' => $projekt,
            // 'mains' => $mains,
        ));
    }

    /**
     * @Route("/new", name="projekt_new")
     */
    public function newAction(Request $request)
    {
        $projekt = new Projekt();
        $form = $this->createForm(ProjektType::class, $projekt);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $projekt->setUser($user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $projekt = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($projekt);
            $em->flush();

            return $this->redirectToRoute('projekt_index');
        }


        return $this->render('ProjektBundle:Default:projekt/new.html.twig', array(
            'form' => $form->createView(),
        ));

    }

}
