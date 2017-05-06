<?php 

namespace ProjektBundle\Twig;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProjektBundle\Entity\Projekt;
use Symfony\Component\HttpFoundation\Response;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;
use Twig_Function_Method;

class ProjektExtension extends Twig_Extension
{
    // public function getFilters()
    //     {
    //         return array(
    //             new Twig_SimpleFilter('renderSubmains', array($this, 'renderSubmains')),
    //         );
    //     }

    // protected $doctrine;

    // public function __construct(/Twig/RegistryInterface $doctrine)
    // {
    //     $this->doctrine = $doctrine;
    // }    

    // public function getFunctions()
    // {
    //     return array(
    //         'renderSubmains' => new Twig_Function_Method($this, 'renderSubmains', array('needs_environment' => true)
    //         ),
    //     );
    // }
    

    // public function renderSubmains($mainId)
    // {

    //     $em = $this->doctrine->getManager();

    //     $submains = $em->getRepository('ProjektBundle:Submain')
    //                 ->findBy(array(
    //                     'main' => $mainId));


    //     return $twig->render('ProjektBundle:Default:submain/show.html.twig', array(
    //         'submains' => $submains,
    //     ));
    // }

}