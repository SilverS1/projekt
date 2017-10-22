<?php

namespace ProjektBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjektBundle\Entity\Projekt;
use ProjektBundle\Entity\Main;
use Symfony\Component\HttpFoundation\Response;
use ProjektBundle\Form\MainType;
use Doctrine\ORM\EntityManager;
use DateTime;

class MainController extends Controller
{

    /**
     * @param integer $projektId
     *
     * @return array
     */
    public function findMainsAction($projektId)
    {

        $em = $this->getDoctrine()->getManager();   

        $mains = $em->getRepository('ProjektBundle:Main')
                    ->findBy(array(
                        'projekt' => $projektId));

        return $mains;
    }


    public function indexAction($projektId) 
    {
        $em = $this->getDoctrine()->getManager();

        $mains = $em->getRepository('ProjektBundle:Main')
                    ->findBy(array(
                        'projekt' => $projektId));

        return $this->render('ProjektBundle:Default:main/index.html.twig', 
            ['mains' => $mains,
            'projektId' => $projektId]);
    }


    /**
     * @Route("{projektId}/main/new", name="main_new")
     */
    public function newAction(Request $request, $projektId)
    {
        $em = $this->getDoctrine()->getManager();
        $main = new Main();
        $form = $this->createForm(MainType::class, $main, 
            ['attr'=>array('novalidate' =>  'novalidate'), 'label' => 'Create']);
        $projekt = $em->getRepository('ProjektBundle:Projekt')
                    ->findOneBy(array(
                        'id' => $projektId));
        $main->setProjekt($projekt);
        $main->setCreatedDate(new \DateTime());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $main = $form->getData();
            
            $em->persist($main);
            $em->flush();

            return $this->redirect($this->container->get('router')->generate('projekt_show', array('id' => $projektId)));
        }


        return $this->render('ProjektBundle:Default:main/new.html.twig', array(
            'form' => $form->createView(),
            'projekt' => $projekt,
        ));

    }

    /**
     * @Route("main/delete", name="main_delete")
     */
    public function deleteAction(Request $request)
    {   
        $mainId =$request->query->get('mainId');
        $em = $this->getDoctrine()->getEntityManager();
        $main = $em->getRepository('ProjektBundle:Main')
            ->findOneBy(array(
            'id' => $mainId));

        $submains = $em->getRepository('ProjektBundle:Submain')
            ->findBy(array(
            'mainId' => $mainId));


        $em->remove($main);
        if(!empty($submains)) {
            foreach($submains as $submain) {
                $em->remove($submain);
            }
        }
        
        $em->flush();   

        return $this->redirect($request->headers->get('referer'));
    }

       /**
     * @Route("{projektId}/main/{mainId}/edit", name="main_edit")
     */
    public function editAction(Request $request, $projektId, $mainId)
    {
        $em = $this->getDoctrine()->getManager();

        $projekt = $em->getRepository('ProjektBundle:Projekt')
                    ->findOneBy(array(
                        'id' => $projektId));


        $main = $em->getRepository('ProjektBundle:Main')
                    ->findOneBy(array(
                        'id' => $mainId));

        $form = $this->createForm(MainType::class, $main, 
            ['attr' => array('novalidate'=>'novalidate'),
            'label' => 'edit']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $main = $form->getData();
            
            $em->persist($main);
            $em->flush();

            return $this->redirect($this->container->get('router')
                ->generate('projekt_show', array('id' => $projektId)));
        }


        return $this->render('ProjektBundle:Default:main/edit.html.twig', array(
            'form' => $form->createView(),
            'projekt' => $projekt,
            'main' => $main,
        ));

    }

}
