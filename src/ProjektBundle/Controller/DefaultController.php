<?php

namespace ProjektBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjektBundle\Entity\Projekt;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{

    /**
     * @Route("/test", name="projekt_test")
     */
    public function testAction(Request $request)
    {
        $projekt = new Projekt();
        $projekt->setName('Write a book');
        $projekt->setDescription('Write it');
        $projekt->setProgress(10);
        $projekt->setImage('Write it');

        $em = $this->getDoctrine()->getManager();

        $em->persist($projekt);

        $em->flush();

        return new Response('Saved new projekt with id' . $projekt->getId());

    }


}
