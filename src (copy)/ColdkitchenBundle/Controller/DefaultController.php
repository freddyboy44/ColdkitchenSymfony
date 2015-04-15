<?php

namespace ColdkitchenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use ColdkitchenBundle\Entity\Ploeg;
use ColdkitchenBundle\Form\PloegType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $fotoentities = $em->getRepository('ColdkitchenBundle:AchtergrondFoto')->findAll();
        $partners = $em->getRepository('ColdkitchenBundle:Partner')->findAll();
 
        return array(
            'fotos' => $fotoentities,
            'partners' => $partners,

        );
        return array();
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
        return $this->render('partners.html.twig', array(
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
     * @Route("/fixed", name="fixed")
     * @Template("ColdkitchenBundle:Default:indexstatic.html.twig")
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
