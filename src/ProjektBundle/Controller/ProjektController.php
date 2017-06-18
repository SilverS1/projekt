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

        $securityContext = $this->container->get('security.authorization_checker');

        if($securityContext->isGranted('IS_AUTHENTICATED_FULLY') == false){
            return $this->redirect($this->generateUrl('fos_user_security_login'));

        }

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
        $projektId = $projekt->getId();

        return $this->render('ProjektBundle:Default:projekt/show.html.twig', array(
            'projekt' => $projekt,
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
