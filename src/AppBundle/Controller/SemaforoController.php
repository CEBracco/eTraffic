<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Semaforo;
use AppBundle\Entity\Calle;
use AppBundle\Entity\Interseccion;



/**
 * Semaforo controller.
 *
 * @Route("/semaforo")
 */
class SemaforoController extends Controller
{
    /**
     * Lists all Semaforo entities.
     *
     * @Route("/", name="semaforo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $semaforos = $em->getRepository('AppBundle:Semaforo')->findAll();

        return $this->render('semaforo/index.html.twig', array(
            'semaforos' => $semaforos,
        ));
    }

     /**
     * Return a map view.
     *
     * @Route("/map", name="map_view")
     * @Method({"GET"})
     */
     public function showMapAction()
    {
        $json = file_get_contents('http://localhost/SemaphoreSimulator/web/semaforo/json');
        $semaforosApi = json_decode($json,true);
        $url='http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address='.urlencode('calle 1 y calle 50, La Plata');
        $coord = file_get_contents($url);
        $parseC = json_decode($coord,true);
       $this->loadSemaphores($semaforosApi);
        return $this->render('semaforo/mapa.html.twig',array('semaforos' => $semaforosApi,'coord' =>$parseC['results'][0]));
       
    }
    private function loadSemaphores($semjson){
         $semRepo = $this->getDoctrine()->getRepository('AppBundle:Semaforo');
         $calleRepo = $this->getDoctrine()->getRepository('AppBundle:Calle');
         $em = $this->getDoctrine()->getManager();
           

        foreach($semjson as $semaphore => $valor){ 

            $semaforo = new Semaforo();
            $semaforo->setUrl($valor['url']);
            $semaforo->setFrecuencia($valor['frecuencia']);
            $calle=$this->getCalle($calleRepo,$valor['callePrimaria']);
            $avenida=$this->getCalle($calleRepo,$valor['calleSecundaria']);
            $interseccion= new Interseccion();
            $interseccion->addSemaforo($semaforo);
            $interseccion->addCalle($calle);
            $interseccion->addCalle($avenida);
            $calle->addInterseccione($interseccion);
            $semaforo->setCalle($calle);
            $semaforo->setInterseccion($interseccion);
            $em->persist($interseccion);
            $em->persist($calle);

            $em->persist($semaforo);
            $em->flush();
        }
    }

    private function getSemaforo(){

    }

    private function getCalle($calleRepo,$nombreCalle){
        $calleExist = $calleRepo->findOneBy(
        array('nombre' => $nombreCalle)
        );
        if(empty($calleExist)){
            $calle= new Calle();
            $calle->setNombre($nombreCalle);
            return $calle;
         }else{
            return $calleExist;
        }

    }


    /**
     * Show the graphic for a semaphore.
     *
     * @Route("/graphic/{id}", name="semaforo_graphic")
     * @Method({"GET", "POST"})
     */
    public function graphicAction(Semaforo $semaforo)
    {
        return $this->render('semaforo/graphic.html.twig', array('semaforo' => $semaforo));
    }
}
