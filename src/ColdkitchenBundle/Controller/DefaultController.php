<?php

namespace ColdkitchenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use ColdkitchenBundle\Entity\Ploeg;
use ColdkitchenBundle\Form\PloegType;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use GuzzleHttp\Client;

class DefaultController extends Controller
{

     /**
     * @Route("/testinschrijven", name="watemail")
     * @Template()
     */
    public function testinschrijvenAction(){
      
      return $this->render('ColdkitchenBundle:Ploeg:ingeschreven.html.twig', array(
                                                        'email' => 'boifrederik@telenet.be'
));
    }

    /**
     * @Route("/", name="fixed")
     * @Template()
     */
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $fotoentities = $em->getRepository('ColdkitchenBundle:AchtergrondFoto')->findByZichtbaar(1);
        
        $fieldpartners = $em->getRepository('ColdkitchenBundle:PartnerType')->findFieldpartners();
        $suppliers = $em->getRepository('ColdkitchenBundle:PartnerType')->findSuppliers();
        $partners = $em->getRepository('ColdkitchenBundle:PartnerType')->findPartners();
 

        FacebookSession::setDefaultApplication('767174366685015', 'bb8deb1a28923c26de9fe9427a2a8915');
        $session = FacebookSession::newAppSession();
        $request = new FacebookRequest(
        $session,
          'GET',
          '/700828453310114/photos?limit=75'
        );
        $response = $request->execute();
        $graphObject = $response->getGraphObject();
        $pages = $graphObject->asArray()['paging'];
        $teller = 0;
        $data = $graphObject->asArray()['data'];
        
        while(property_exists($pages->cursors, 'after') ){
            $teller++;

            $request = new FacebookRequest(
            $session,
              'GET',
              '/700828453310114/photos?limit=75&after=' . $pages->cursors->after
            );
            $response = $request->execute();
            $graphObject = $response->getGraphObject();

            
            $nieuwedata = $graphObject->asArray()['data'];
            $data = array_merge($data, $nieuwedata);
            if(in_array("paging",$graphObject->asArray())){
                $pages = $graphObject->asArray()['paging'];
            }else{
                break;
            }
            
        }

        return array(
            'fotos' => $fotoentities,
            'fieldpartners' => $fieldpartners,
            'suppliers' => $suppliers,
            'partners' => $partners,
            'data' => $data

        );
        return array();
    }

    /**
     * @Route("/facebook", name="facebookfotos")
     * @Template()
     */
    public function facebookAction(){
        FacebookSession::setDefaultApplication('767174366685015', 'bb8deb1a28923c26de9fe9427a2a8915');
        $session = FacebookSession::newAppSession();
        $request = new FacebookRequest(
        $session,
          'GET',
          '/700828453310114/photos?limit=75'
        );
        $response = $request->execute();
        $graphObject = $response->getGraphObject();
        $pages = $graphObject->asArray()['paging'];
        $teller = 0;
        $data = $graphObject->asArray()['data'];
        
        while(property_exists($pages->cursors, 'after') ){
            $teller++;

            $request = new FacebookRequest(
            $session,
              'GET',
              '/700828453310114/photos?limit=75&after=' . $pages->cursors->after
            );
            $response = $request->execute();
            $graphObject = $response->getGraphObject();

            
            $nieuwedata = $graphObject->asArray()['data'];
            $data = array_merge($data, $nieuwedata);
            if(in_array("paging",$graphObject->asArray())){
                $pages = $graphObject->asArray()['paging'];
            }else{
                break;
            }
            
        }
        
        return array('facebookobject' => $graphObject->asArray(),
            'data'=>$data
            );

    }

    

    /**
     * @Route("/partners",name="partners")
     * @Template()
     */
    public function partnerAction()
    {
        $em = $this->getDoctrine()->getManager();
        //$fieldpartners = $em->getRepository('ColdkitchenBundle:PartnerType')->find(1)->getPartners();
        $fieldpartners = $em->getRepository('ColdkitchenBundle:PartnerType')->findFieldpartners();
        $suppliers = $em->getRepository('ColdkitchenBundle:PartnerType')->findSuppliers();
        $partners = $em->getRepository('ColdkitchenBundle:PartnerType')->findPartners();
        $sponsors = $em->getRepository('ColdkitchenBundle:PartnerType')->findSponsors();
        
        //$suppliers = $em->getRepository('ColdkitchenBundle:Partner')->findSuppliers();
        //$partners = $em->getRepository('ColdkitchenBundle:Partner')->findPartners();
        return $this->render('ColdkitchenBundle:Default:partners.html.twig', array(
                                                        'fieldpartners' => $fieldpartners,
                                                        'suppliers'     => $suppliers,
                                                        'partners'      => $partners,
                                                        'sponsors'      => $sponsors));
    }

    /**
     * @Route("/reglement", name="reglement")
     * @Template()
     */
    public function reglementAction()
    {
        return $this->render('ColdkitchenBundle:Default:reglement.html.twig');
    }

    /**
     * @Route("/", name="home")
     * @Template("ColdkitchenBundle:Default:index.html.twig")
     */
    public function fixedAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fotoentities = $em->getRepository('ColdkitchenBundle:AchtergrondFoto')->findAll();
        $partners = $em->getRepository('ColdkitchenBundle:Partner')->findAll();

        return array(
            'fotos' => $fotoentities,
            'partners' => $partners,

        );
        
    }

    /**
     * @Route("/programma", name="programma")
     * @Template()
     */
    public function programmaAction()
    {
        return $this->render('ColdkitchenBundle:Default:programma.html.twig');
    }

    /**
     * @Route("/fotos/{albumid}/{paginanummer}/{aantalpaginas}", name="fotos", defaults={"albumid" = 1, "paginanummer" = 1, "aantalpaginas" = 0})
     * @Template()
     */
    public function fotosAction($albumid,$paginanummer,$aantalpaginas)
    {
      $em = $this->getDoctrine()->getManager();
      if($albumid===1){
        $album =  $em->getRepository('ColdkitchenBundle:Album')->findOneByVolgorde(1);
        $albumid = $album->getUrl();  
      }else{
        $album = $em->getRepository('ColdkitchenBundle:Album')->findOneByVolgorde($albumid);
        $albumid = $album->getUrl();
      }
      
      $albums = $em->getRepository('ColdkitchenBundle:Album')->findAll();
      
      $vanaf = (($paginanummer-1) * 20);
      



        FacebookSession::setDefaultApplication('767174366685015', 'bb8deb1a28923c26de9fe9427a2a8915');
        $session = FacebookSession::newAppSession();
        $request = new FacebookRequest(
        $session,
          'GET',
          '/' . $albumid .'/photos?offset='. $vanaf .'&limit=20'
        );
        $response = $request->execute();
        $graphObject = $response->getGraphObject();
        $pages = $graphObject->asArray()['paging'];
        $teller = 0;
        $data = $graphObject->asArray()['data'];
        
        if($aantalpaginas===0){
          if(property_exists($pages, 'next')){
            $cursor = $pages->cursors->after;
          }else{
            $cursor = 0;
          }

          while(property_exists($pages, 'next') ){
              $teller++;

              $request = new FacebookRequest(
              $session,
                'GET',
                '/'. $albumid. '/photos?limit=20&after=' . $pages->cursors->after
              );
              $response = $request->execute();
              $graphObject = $response->getGraphObject();

              
              $nieuwedata = $graphObject->asArray()['data'];
              //$data = array_merge($data, $nieuwedata);
              $pages = $graphObject->asArray()['paging'];
              
          }
          $aantalpaginas = $teller;
        }

        

        return $this->render('ColdkitchenBundle:Default:fotos.html.twig', array(
            'fotos'=>$data,
            'paginanummer'=>$paginanummer,
            'aantalpaginas' => $aantalpaginas,
            'albums' => $albums,
            'huidigalbum'=>$album
          ));
    }
    /**
     * @Route("/fotos/{aantalpaginas}/{pagina}", name="fotospagina")
     * @Template()
     */
    public function fotospaginaAction($aantalpaginas, $pagina)
    {
      FacebookSession::setDefaultApplication('767174366685015', 'bb8deb1a28923c26de9fe9427a2a8915');
        $session = FacebookSession::newAppSession();
        //$pagina--;
        //$nieuwe = abs($nieuwe) - 1;
        $vanaf = ($pagina-1) * 20 + 1;
        //$vanaf++;
        
        $urlstring = '/700828453310114/photos?limit=20&offset=' . $vanaf;
        //var_dump($urlstring);
        $request = new FacebookRequest(
        $session,
          'GET',
          $urlstring
        );
        $response = $request->execute();
        $graphObject = $response->getGraphObject();
        $pages = $graphObject->asArray()['paging'];
        $teller = 0;
        $data = $graphObject->asArray()['data'];


      return $this->render('ColdkitchenBundle:Default:fotos.html.twig', array(
            'fotos'=>$data,
            'paginanummer'=>$pagina,
            'aantalpaginas'=>$aantalpaginas
            ));
    }



    
}
