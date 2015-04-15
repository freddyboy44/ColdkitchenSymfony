<?php

namespace ColdkitchenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ColdkitchenBundle\Entity\Speler;
use ColdkitchenBundle\Form\SpelerType;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use \DateTime;

/**
 * Speler controller.
 *
 * @Route("/")
 */
class SpelerController extends Controller
{

    /**
     * Ajax call om speler te maken
     *
     * @Route("/maakspeler", name="ajaxspeler")
     * @Method("POST")
     */
    public function createajaxAction(Request $request)
    {
        
        
        $naam = $request->query->get('naam');
        $voornaam = $request->query->get('voornaam');

        $response = array("code" => 100, "success" => true);
        return new Response(json_encode($response)); 
    }

    /**
     * Ajax call om speler te maken
     *
     * @Route("/laadspeler/{spelernummer}", name="laadajaxspeler")
     * @Method("GET")
     */
    public function laadajaxAction($spelernummer)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();
        $entity = $em->getRepository('ColdkitchenBundle:Ploeg')->find($id);
        $ploegid = $entity->getId();

        $speler = $em->getRepository('ColdkitchenBundle:Speler')->findByPloegAndNummer($ploegid,$spelernummer);
        
        /*$naam = $request->query->get('naam');
        $voornaam = $request->query->get('voornaam');*/

        $serializer = $this->get('serializer');
        $reports = $serializer->serialize($speler, 'json');

        $response = array("code" => 100, "success" => true,"antwoord" => $reports);
        return new Response(json_encode($response)); 
    }

    /**
     * Ajax call om speler te verwijderen
     *
     * @Route("/verwijderspeler/{spelernummer}", name="verwijderajaxspeler")
     * @Method("GET")
     */
    public function verwijderajaxAction($spelernummer)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();
        $entity = $em->getRepository('ColdkitchenBundle:Ploeg')->find($id);
        $ploegid = $entity->getId();

        $speler = $em->getRepository('ColdkitchenBundle:Speler')->findByPloegAndNummer($ploegid,$spelernummer);
        
        $speler->setNaam('')
                ->setVoornaam('')
                ->setGeboortedatum(NULL)
                ->setStraat('')
                ->setBus('')
                ->setEmailadres('')
                ->setGsm('')
                ->setHuisnr('')
                ->setPostcode('')
                ->setWoonplaats('')
                ->setTelefoon('')
                ->setRugnummer('');
        
        $em->persist($speler);
        $em->flush();      

        /*$naam = $request->query->get('naam');
        $voornaam = $request->query->get('voornaam');*/

        $serializer = $this->get('serializer');
        $reports = $serializer->serialize($speler, 'json');

        $response = array("code" => 100, "success" => true,"antwoord" => $reports);
        return new Response(json_encode($response)); 
    }

    /**
     * Ajax call om speler op te slaan
     *
     * @Route("/saveplayer", name="saveajaxplayer")
     * @Method("POST")
     */
    public function saveajaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();
        $entity = $em->getRepository('ColdkitchenBundle:Ploeg')->find($id);
        $ploegid = $entity->getId();
        $spelernummer = $request->get('spelernummer');
        $speler = $em->getRepository('ColdkitchenBundle:Speler')->findByPloegAndNummer($ploegid,$spelernummer);

        

        $spelernummer = $request->get('spelernummer');

        $naam = $request->get('naam');
        $voornaam = $spelernummer = $request->get('voornaam');
        $straat = $spelernummer = $request->get('straat');
        $huisnr = $request->get('huisnr');
        $bus = $request->get('bus');
        $woonplaats = $request->get('woonplaats');
        $postcode = $request->get('postcode');
        $telefoon = $request->get('telefoon');
        $gsm = $request->get('gsm');
        $emailadres = $request->get('emailadres');
        $rugnummer = $request->get('rugnummer');

        // 
        // 
        $format = "d m Y";
        $geboortedatum = DateTime::createFromFormat($format, $request->get('geboortedatum'));

        $speler->setNaam($naam);
        $speler->setVoornaam($voornaam);
        $speler->setStraat($straat);
        $speler->setHuisnr($huisnr);
        $speler->setBus($bus);
        $speler->setWoonplaats($woonplaats);
        $speler->setPostcode($postcode);
        $speler->setTelefoon($telefoon);
        $speler->setGsm($gsm);
        $speler->setEmailadres($emailadres);
        $speler->setRugnummer($rugnummer);
        $speler->setGeboortedatum($geboortedatum);
        //$speler->setNaam($geboortedatum);

        $em->persist($speler);
        $em->flush();       

        $response = array("code" => 100, "success" => true,"antwoord" => $spelernummer);
        return new Response(json_encode($response)); 
    }

    

    

    /**
     * Lists all Speler entities.
     *
     * @Route("/spelers", name="speler")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ColdkitchenBundle:Speler')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Speler entity.
     *
     * @Route("/maakspeler", name="speler_create")
     * @Method("POST")
     * @Template("ColdkitchenBundle:Speler:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Speler();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('speler_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Speler entity.
     *
     * @param Speler $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Speler $entity)
    {
        $form = $this->createForm(new SpelerType(), $entity, array(
            'action' => $this->generateUrl('speler_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Speler entity.
     *
     * @Route("/nieuwespeler", name="speler_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Speler();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Speler entity.
     *
     * @Route("/speler/{id}", name="speler_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:Speler')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Speler entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Speler entity.
     *
     * @Route("/speler/{id}/edit", name="speler_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:Speler')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Speler entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Speler entity.
    *
    * @param Speler $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Speler $entity)
    {
        $form = $this->createForm(new SpelerType(), $entity, array(
            'action' => $this->generateUrl('ploeg_edit_kort'),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Speler entity.
     *
     * @Route("/speler/{id}", name="speler_update")
     * @Method("PUT")
     * @Template("ColdkitchenBundle:Speler:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:Speler')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Speler entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('speler_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Speler entity.
     *
     * @Route("/speler/{id}", name="speler_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ColdkitchenBundle:Speler')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Speler entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('speler'));
    }

    /**
     * Creates a form to delete a Speler entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('speler_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
