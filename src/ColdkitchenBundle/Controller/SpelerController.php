<?php

namespace ColdkitchenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ColdkitchenBundle\Entity\Speler;
use ColdkitchenBundle\Form\SpelerType;

/**
 * Speler controller.
 *
 * @Route("/speler")
 */
class SpelerController extends Controller
{

    /**
     * Lists all Speler entities.
     *
     * @Route("/", name="speler")
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
     * @Route("/", name="speler_create")
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
     * @Route("/new", name="speler_new")
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
     * @Route("/{id}", name="speler_show")
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
     * @Route("/{id}/edit", name="speler_edit")
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
            'action' => $this->generateUrl('speler_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Speler entity.
     *
     * @Route("/{id}", name="speler_update")
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
     * @Route("/{id}", name="speler_delete")
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
