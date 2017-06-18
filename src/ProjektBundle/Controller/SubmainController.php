<?php

namespace ProjektBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjektBundle\Entity\Projekt;
use ProjektBundle\Entity\Submain;
use Symfony\Component\HttpFoundation\Response;
use ProjektBundle\Form\SubmainType;

class SubmainController extends Controller
{

    public function indexAction($projektId, $mainId = 0, $submainId = 0) 
    {

        $em = $this->getDoctrine()->getManager();

        if($mainId) {
            $submains = $em->getRepository('ProjektBundle:Submain')
                    ->findBy(array(
                        'mainId' => $mainId));
        } elseif($submainId) {
            $submains = $em->getRepository('ProjektBundle:Submain')
                    ->findBy(array(
                        'submainId' => $submainId));
        }

        return $this->render(
            'ProjektBundle:Default:submain/index.html.twig',
            ['submains' => $submains,
            'projektId' => $projektId]
        );

    }

    /**
     * @Route("submain/new", name="submain_new")
     */
    public function newAction(Request $request, $mainId = 0, $submainId = 0)
    {
        $em = $this->getDoctrine()->getManager();
        $submain = new Submain();
        $form = $this->createForm(SubmainType::class, $submain, ['attr'=>array('novalidate'=>'novalidate')]);
        $mainId = $request->query->get('mainId');
        $submainId =$request->query->get('submainId');
        $projektId =$request->query->get('projektId');
        $submain->setCreatedDate(new \DateTime());

        if($mainId) {
            $main = $em->getRepository('ProjektBundle:Main')
                    ->findOneBy(array(
                        'id' => $mainId));
            $mainId2 = $main->getId();
            $submain->setMainId($mainId2);
            /// probably dont need to do the submain thing at all below
        } elseif($submainId) {
            $submain2 = $em->getRepository('ProjektBundle:Submain')
                    ->findOneBy(array(
                        'id' => $submainId));
            $submainId3 = $submain2->getId();
            $submain->setSubmainId($submainId3);
        } 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $submain = $form->getData();
            
            $em->persist($submain);
            $em->flush();

            return $this->redirect($this->container->get('router')->generate('projekt_show', array('id' => $projektId)));
        }

        return $this->render('ProjektBundle:Default:submain/new.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("submain/delete", name="submain_delete")
     */
    public function deleteAction(Request $request)
    {   
        $submainId =$request->query->get('submainId');
       $em = $this->getDoctrine()->getEntityManager();
       $submain = $em->getRepository('ProjektBundle:Submain')
            ->findOneBy(array(
            'id' => $submainId));;

       $em->remove($submain);
       $em->flush(); 

       return $this->redirect($request->headers->get('referer'));
    }


}
