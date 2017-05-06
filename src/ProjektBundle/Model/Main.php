<?php

namespace ProjektBundle\Model;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjektBundle\Entity\Projekt;
use Symfony\Component\HttpFoundation\Response;

class Main
{ 

	public function findMains($projektId)
    {

        $em = $this->getDoctrine()->getManager();

        $mains = $em->getRepository('ProjektBundle:Projekt')
                    ->findBy(array(
                        'id' => $projektId));

        return $mains;
    }

}
