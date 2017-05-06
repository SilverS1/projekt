<?php

namespace ProjektBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjektBundle\Entity\Projekt;
use Symfony\Component\HttpFoundation\Response;

class SubmainController extends Controller
{

    public function indexAction($mainId = 0, $submainId = 0) 
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
            ['submains' => $submains]
        );

    }

}
