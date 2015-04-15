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
     * @Route("/", name="fixed")
     * @Template()
     */
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $fotoentities = $em->getRepository('ColdkitchenBundle:AchtergrondFoto')->findAll();
        $partners = $em->getRepository('ColdkitchenBundle:Partner')->findAll();
 

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
     * @Route("/fotos", name="fotos")
     * @Template()
     */
    public function toonfotosAction(){
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
        $fieldpartners = $em->getRepository('ColdkitchenBundle:PartnerType')->find(1)->getPartners();
        $suppliers = $em->getRepository('ColdkitchenBundle:PartnerType')->find(2)->getPartners();
        $partners = $em->getRepository('ColdkitchenBundle:PartnerType')->find(3)->getPartners();
        $sponsors = $em->getRepository('ColdkitchenBundle:PartnerType')->find(4)->getPartners();
        
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
        return $this->render('ColdkitchenBundle:Default:reglement.html.twig');
    }

    /**
     * @Route("/fotos", name="fotos")
     * @Template()
     */
    public function fotosAction()
    {
        return $this->render('ColdkitchenBundle:Default:reglement.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     * @Template()
     */
    public function contactAction()
    {
        return $this->render('ColdkitchenBundle:Default:reglement.html.twig');
    }


    
}
