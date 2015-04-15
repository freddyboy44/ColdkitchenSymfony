<?php

namespace ColdkitchenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ColdkitchenBundle\Entity\AchtergrondFoto;
use ColdkitchenBundle\Form\AchtergrondFotoType;

/**
 * AchtergrondFoto controller.
 *
 * @Route("/achtergrondfoto")
 */
class AchtergrondFotoController extends Controller
{

    /**
     * Lists all AchtergrondFoto entities.
     *
     * @Route("/", name="achtergrondfoto")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ColdkitchenBundle:AchtergrondFoto')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new AchtergrondFoto entity.
     *
     * @Route("/", name="achtergrondfoto_create")
     * @Method("POST")
     * @Template("ColdkitchenBundle:AchtergrondFoto:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new AchtergrondFoto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->upload();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('achtergrondfoto_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a AchtergrondFoto entity.
     *
     * @param AchtergrondFoto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(AchtergrondFoto $entity)
    {
        $form = $this->createForm(new AchtergrondFotoType(), $entity, array(
            'action' => $this->generateUrl('achtergrondfoto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AchtergrondFoto entity.
     *
     * @Route("/new", name="achtergrondfoto_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AchtergrondFoto();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AchtergrondFoto entity.
     *
     * @Route("/{id}", name="achtergrondfoto_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:AchtergrondFoto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AchtergrondFoto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AchtergrondFoto entity.
     *
     * @Route("/{id}/edit", name="achtergrondfoto_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:AchtergrondFoto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AchtergrondFoto entity.');
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
    * Creates a form to edit a AchtergrondFoto entity.
    *
    * @param AchtergrondFoto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AchtergrondFoto $entity)
    {
        $form = $this->createForm(new AchtergrondFotoType(), $entity, array(
            'action' => $this->generateUrl('achtergrondfoto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AchtergrondFoto entity.
     *
     * @Route("/{id}", name="achtergrondfoto_update")
     * @Method("PUT")
     * @Template("ColdkitchenBundle:AchtergrondFoto:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:AchtergrondFoto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AchtergrondFoto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->upload();
            $em->flush();

            return $this->redirect($this->generateUrl('achtergrondfoto_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AchtergrondFoto entity.
     *
     * @Route("/{id}", name="achtergrondfoto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ColdkitchenBundle:AchtergrondFoto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AchtergrondFoto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('achtergrondfoto'));
    }

    /**
     * Creates a form to delete a AchtergrondFoto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('achtergrondfoto_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
