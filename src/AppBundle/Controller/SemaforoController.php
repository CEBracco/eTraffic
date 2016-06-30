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

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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
       
        return $this->render('semaforo/mapa.html.twig',array());
    }

     /**
     * Return a map view.
     *
     * @Route("/update", name="update_list")
     * @Method({"GET"})
     */
    public function updateAction(){
         $em = $this->getDoctrine()->getManager();
         $semaforosGuardados = $em->getRepository('AppBundle:Semaforo')->findAll();
         $interseccionesGuardadas = $em->getRepository('AppBundle:Interseccion')->findAll();
         $calle=$em->getRepository('AppBundle:Calle')->findAll();
       //borro
        foreach ($interseccionesGuardadas as $int => $value) {
             $em->remove($value);
             $em->flush();
         }
        
         //doy de alta
        $json = file_get_contents('http://localhost/SemaphoreSimulator/web/semaforo/json');
        $semaforosApi = json_decode($json,true);
        $this->loadSemaphores($semaforosApi);

        $em = $this->getDoctrine()->getManager();

        $semaforos = $em->getRepository('AppBundle:Semaforo')->findAll();
        return $this->render('semaforo/index.html.twig', array(
            'semaforos' => $semaforos,
        ));
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
            $avenida->addInterseccione($interseccion);
            $semaforo->setCalle($calle);
            $semaforo->setInterseccion($interseccion);
            $em->persist($interseccion);
            $em->persist($calle);
            $em->persist($avenida);
            $em->persist($semaforo);
            $em->flush();
        }
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

    /**
     * Returns a JSON list of Semaforos.
     *
     *@Route("/json", name="semaforo_list_JSON")
     *@Method({"GET", "POST"})
     */

    public function getInterseccionessJSONAction(){

        $em = $this->getDoctrine()->getManager();

        $intersecciones = $em->getRepository('AppBundle:Interseccion')->findAll();
        $arregloIntersessiones=array();
        foreach ($intersecciones as $interseccion => $value) {
            $calles= $value->getCalles();
            array_push($arregloIntersessiones,array('primaria' => $calles[0]->getNombre(),'calleSecundaria' => $calles[1]->getNombre()));
        }
        $jsonContent=$this->jsonSerialize($arregloIntersessiones);

        return new Response($jsonContent);
    }

     private function jsonSerialize($interseccion, $hideFields=true){
        $normalizer= new ObjectNormalizer();

        if($hideFields){
            $normalizer->setIgnoredAttributes(array('id'));
        }
        else{
            $normalizer->setIgnoredAttributes(array('id'));   
        }
        
        $encoders = array(new JsonEncoder());
        $normalizers = array($normalizer);

        $serializer = new Serializer($normalizers, $encoders);

        return $serializer->serialize($interseccion, 'json');
    }

    /**
    * Retorna un listado de las calles mas transitadas
    *
    * @Route("/calles", name="calles_view")
    * @Method({"GET"})
    */
    public function callesTransitadasAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("SELECT s from AppBundle:Semaforo s");
        $semaforos= $query->getResult();
        $calles=array();
        foreach($semaforos as $semaforo){
            $json=file_get_contents($semaforo->getUrl());
            $sem=json_decode($json,true);
            $calles[$sem['callePrimaria']]=$sem;
        }

        return $this->render('semaforo/calles.html.twig', array(
            'calles' => $calles
        ));
    }
}
