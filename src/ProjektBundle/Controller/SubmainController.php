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

    public function indexAction($mainId = 0, $submainId = 0) 
    {

        // var_dump($submainId);
        // die();

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
            ['submains' => $submains]
        );

    }

    public function getChildren($submainId)
    {
        $em = $this->getDoctrine()->getManager();

        $submains = $em->getRepository('ProjektBundle:Submain')
                ->findOneBy(array(
                'submainId' => $submainId));

        $qb->select('s')
           ->from('ProjektBundle:Submain', 's')
           ->where('s.submainId = ?1')
           ->setParameter(1, $submainId);

        $result = $query->getResult();



        // return $this->render(
        //     'ProjektBundle:Default:submain/index.html.twig',
        //     ['submains' => $submains]
        // );
    }


    /**
     * @Route("submain/new", name="submain_new")
     */
    public function newAction(Request $request, $mainId = 0, $submainId = 0)
    {
        $em = $this->getDoctrine()->getManager();
        $submain = new Submain();
        $form = $this->createForm(SubmainType::class, $submain);
        $mainId = $request->query->get('mainId');
        $submainId =$request->query->get('submainId');
        $submain->setCreatedDate(new \DateTime());

        if($mainId) {
            $main = $em->getRepository('ProjektBundle:Main')
                    ->findOneBy(array(
                        'id' => $mainId));
            $mainId2 = $main->getId();
            $submain->setMainId($mainId2);
        } elseif($submainId) {
            // var_dump($submainId);
            // echo "<br>";
            $submain2 = $em->getRepository('ProjektBundle:Submain')
                    ->findOneBy(array(
                        'id' => $submainId));
            $submainId3 = $submain2->getId();
            $submain->setSubmainId($submainId3);
            // var_dump($submainId2);
            // echo "<br>";

            // var_dump($submain);
            // echo "<br>";

            ///die();
        } 

        // // $submain->setSubmainId($submainId);
        // print_r($submain);
        // die();

        

        
        

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // var_dump($submain->getSubmainId());
            // die();

            $submain = $form->getData();
            
            $em->persist($submain);
            $em->flush();

            return $this->redirectToRoute('projekt_index');
        }


        return $this->render('ProjektBundle:Default:submain/new.html.twig', array(
            'form' => $form->createView(),
        ));

    }


}
