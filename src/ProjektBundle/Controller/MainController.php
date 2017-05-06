<?php

namespace ProjektBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjektBundle\Entity\Projekt;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * Constructor
     * @param $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param integer $projektId
     *
     * @return array
     */
    public function findMains($projektId)
    {

        $em = $this->entityManager;

        $mains = $em->getRepository('ProjektBundle:Main')
                    ->findBy(array(
                        'projekt' => $projektId));

        ///var_dump($mains);

        return $mains;
    }

    public function findSubmains($mainId) 
    {

        $params = $container->get('request')->attributes->get('_route_params');
        $id = $params['id'];

    }

}
