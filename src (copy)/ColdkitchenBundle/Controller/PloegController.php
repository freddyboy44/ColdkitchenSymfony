<?php

namespace ColdkitchenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ColdkitchenBundle\Entity\Ploeg;
use ColdkitchenBundle\Entity\Speler;
use ColdkitchenBundle\Form\PloegType;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;



/**
 * Ploeg controller.
 *
 * @Route("/")
 */
class PloegController extends Controller
{

    /**
     * Lists all Ploeg entities.
     *
     * @Route("/ploegen", name="ploeg")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ColdkitchenBundle:Ploeg')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    

    /**
     * Creates a new Ploeg entity.
     *
     * @Route("/inschrijven", name="ploeg_create")
     * @Method("POST")
     * @Template("ColdkitchenBundle:Ploeg:inschrijven.html.twig")
     */
    public function createAction(Request $request)
    {
        
        $entity = new Ploeg();


        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $generator = new SecureRandom();
            $random = $generator->nextBytes(3);
            $wachtwoord = bin2hex($random);

            //$enco = new BCryptPasswordEncoder();
            //$encodedpassword = $enco->encodePassword($wachtwoord);
            //$wachtwoord = 'test';
            
            
            $encoder = $this->get('security.password_encoder');
            $encoded = $encoder->encodePassword($entity, $wachtwoord);
            $entity->setWachtwoord($encoded);

            $em->persist($entity);
            $em->flush();
            $email = $entity->getEmailadres();
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = \Swift_Message::newInstance();
                $sender = array('info@coldkitchentornooi.be'=> 'Info Cold Kitchentornooi');
                $email = $entity->getEmailadres();
                $naam = $entity->getKapiteinVoornaam() + " " + $entity->getKapiteinNaam();
                $to = array($email => $naam);
                
               
                $message->setFrom($sender);
                $message->setTo(array('boifrederik@telenet.be' => 'Frederik Boi'));
                $message->setCc($to);
                $message->setSubject('Uw inschrijving in het Cold Kitchentornooi');
                
                

                $html = $this->render('ColdkitchenBundle:Ploeg:email.html.twig', array(
                            'ploeg' => $entity  , 'wachtwoord' => $wachtwoord                         
                        ));
                

                $message->setBody($html);
                $message->setContentType('text/html');
                //dump($message);

                $mailer = $this->get('mailer');
                $message = $mailer->createMessage()
                    ->setSubject('Uw inschrijving in het Cold Kitchentornooi')
                    ->setFrom($sender)
                    ->setTo($to)
                    ->setCc(array('boifrederik@telenet.be' => 'Frederik Boi'))
                    ->setBody(
                        $this->renderView(
                            // app/Resources/views/Emails/registration.html.twig
                            'ColdkitchenBundle:Ploeg:email.html.twig',
                            array('ploeg' => $entity, 'wachtwoord' => $wachtwoord)
                        ),
                        'text/html'
                    )
                    /*
                     * If you also want to include a plaintext version of the message
                    ->addPart(
                        $this->renderView(
                            'Emails/registration.txt.twig',
                            array('name' => $name)
                        ),
                        'text/plain'
                    )
                    */
                ;
                $mailer->send($message);                
                
            }

            $speler = new Speler();
            $speler->setNaam($entity->getKapiteinNaam())
                        ->setBus($entity->getBus())
                        ->setEmailadres($entity->getEmailadres())
                        ->setGSM($entity->getGSM())
                        ->setVoornaam($entity->getKapiteinVoornaam())
                        ->setGeboortedatum($entity->getGeboortedatum())
                        ->setStraat($entity->getStraat())
                        ->setHuisnr($entity->getHuisnr())
                        ->setWoonplaats($entity->getWoonplaats())
                        ->setPostcode($entity->getPostcode())
                        ->setTelefoon($entity->getTelefoon())
                        ->setSpelernummer(1)
                        ->setPloeg($entity);
            $em->persist($speler);
            $em->flush();
            for($teller=2;$teller<12;$teller++){
                $speler = new Speler();
                $speler->setPloeg($entity);
                $speler->setSpelernummer($teller);
                $em->persist($speler);
                $em->flush();
            }



            return $this->render('ColdkitchenBundle:Ploeg:ingeschreven.html.twig', array(
                    'email' => $entity->getEmailadres()
                ));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Ploeg entity.
     *
     * @param Ploeg $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Ploeg $entity)
    {
        $form = $this->createForm(new PloegType(), $entity, array(
            'action' => $this->generateUrl('ploeg_create'),
            'method' => 'POST',
        ));
        
        $form->add('captcha', 'genemu_captcha',array('mapped' => false));
        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Ploeg entity.
     *
     * @Route("/nieuweploeg", name="ploeg_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Ploeg();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Ploeg entity.
     *
     * @Route("/ploeg/{id}", name="ploeg_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:Ploeg')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ploeg entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Ploeg entity.
     *
     * @Route("/ploeg/{id}/edit", name="ploeg_edit")
     * @Route("/bewerkploeg", name="ploeg_edit_kort")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id=0)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();

        $entity = $em->getRepository('ColdkitchenBundle:Ploeg')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ploeg entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        );
    }

    /**
     *
     * @Route("/kopieerkapitein", name="kopieerkapitein")
     * @Method("GET")
     * @Template()
     */
    public function kopieerAction($id=0)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $id = $user->getId();

        $entity = $em->getRepository('ColdkitchenBundle:Ploeg')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ploeg entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Ploeg entity.
    *
    * @param Ploeg $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Ploeg $entity)
    {
        $form = $this->createForm(new PloegType(), $entity, array(
            'action' => $this->generateUrl('ploeg_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Ploeg entity.
     *
     * @Route("/ploeg/{id}", name="ploeg_update")
     * @Method("PUT")
     * @Template("ColdkitchenBundle:Ploeg:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:Ploeg')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ploeg entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Je wijzigingen werden opgeslaan!')
            ;

            return $this->redirect($this->generateUrl('ploeg_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    

    /**
     * Deletes a Ploeg entity.
     *
     * @Route("/ploeg/{id}", name="ploeg_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ColdkitchenBundle:Ploeg')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ploeg entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ploeg'));
    }

    /**
     * Creates a form to delete a Ploeg entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ploeg_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * @Route("/inschrijven", name="ploeginschrijven")
     * @Method("GET")
     * @Template()
     */
    public function inschrijvenAction(Request $request)
    {
        return $this->newAction();
    }
}
