<?php

namespace ColdkitchenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ColdkitchenBundle\Entity\Vraag;
use ColdkitchenBundle\Form\VraagType;

/**
 * Vraag controller.
 *
 * @Route("/")
 */
class VraagController extends Controller
{

    /**
     * Lists all Vraag entities.
     *
     * @Route("/admin/vraag", name="vraag")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ColdkitchenBundle:Vraag')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Vraag entity.
     *
     * @Route("/contact", name="contact_post")
     * @Method("POST")
     * @Template("ColdkitchenBundle:Default:contact.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Vraag();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            
            $email = $entity->getEmail();
            $naam = $entity->getNaam();
            //$tocc = array($email => $naam);
            $sender = array($email => $naam);
            $sender = array('info@coldkitchentornooi.be'=> 'Info Cold Kitchentornooi');
            //$to = array('info@coldkitchentornooi.be'=> 'Info Cold Kitchentornooi');
            $to = array('boifrederik@telenet.be' => 'Frederik Boi');

            $mailer = $this->get('mailer');
            $message = $mailer->createMessage()
                ->setSubject('Vraag via website Coldkitchentornooi')
                ->setFrom($sender)
                ->setTo($to)
                ->setCc(array('boifrederik@telenet.be' => 'Frederik Boi'))
                ->setBody(
                    $this->renderView(
                        'ColdkitchenBundle:Vraag:vraagwebsite.html.twig',
                        array('vraag' => $entity)
                    ),
                    'text/html'
                );
            $mailer->send($message); 
            
            return $this->render('ColdkitchenBundle:Vraag:verstuurd.html.twig', array('message' => $message));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Vraag entity.
     *
     * @param Vraag $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Vraag $entity)
    {
        $form = $this->createForm(new VraagType(), $entity, array(
            'action' => $this->generateUrl('contact'),
            'method' => 'POST',
        ));
        $form->add('captcha', 'genemu_captcha',array('mapped' => false,'label'=>false));

        return $form;
    }

    /**
     * Displays a form to create a new Vraag entity.
     *
     * @Route("/contact", name="contact")
     * @Method("GET")
     * @Template("ColdkitchenBundle:Default:contact.html.twig")
     */
    public function newAction()
    {
        $entity = new Vraag();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Vraag entity.
     *
     * @Route("/vraag/{id}", name="vraag_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:Vraag')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vraag entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Vraag entity.
     *
     * @Route("/vraag/{id}/edit", name="vraag_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:Vraag')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vraag entity.');
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
    * Creates a form to edit a Vraag entity.
    *
    * @param Vraag $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vraag $entity)
    {
        $form = $this->createForm(new VraagType(), $entity, array(
            'action' => $this->generateUrl('vraag_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Vraag entity.
     *
     * @Route("/vraag/{id}", name="vraag_update")
     * @Method("PUT")
     * @Template("ColdkitchenBundle:Vraag:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:Vraag')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vraag entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vraag_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Vraag entity.
     *
     * @Route("/vraag/{id}", name="vraag_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ColdkitchenBundle:Vraag')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vraag entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vraag'));
    }

    /**
     * Creates a form to delete a Vraag entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vraag_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
