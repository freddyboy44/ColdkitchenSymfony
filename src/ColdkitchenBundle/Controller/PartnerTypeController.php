<?php

namespace ColdkitchenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ColdkitchenBundle\Entity\PartnerType;
use ColdkitchenBundle\Form\PartnerTypeType;

/**
 * PartnerType controller.
 *
 * @Route("/partnertype")
 */
class PartnerTypeController extends Controller
{

    /**
     * Lists all PartnerType entities.
     *
     * @Route("/", name="partnertype")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ColdkitchenBundle:PartnerType')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new PartnerType entity.
     *
     * @Route("/", name="partnertype_create")
     * @Method("POST")
     * @Template("ColdkitchenBundle:PartnerType:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PartnerType();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('partnertype_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PartnerType entity.
     *
     * @param PartnerType $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PartnerType $entity)
    {
        $form = $this->createForm(new PartnerTypeType(), $entity, array(
            'action' => $this->generateUrl('partnertype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PartnerType entity.
     *
     * @Route("/new", name="partnertype_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PartnerType();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PartnerType entity.
     *
     * @Route("/{id}", name="partnertype_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:PartnerType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PartnerType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PartnerType entity.
     *
     * @Route("/{id}/edit", name="partnertype_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:PartnerType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PartnerType entity.');
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
    * Creates a form to edit a PartnerType entity.
    *
    * @param PartnerType $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PartnerType $entity)
    {
        $form = $this->createForm(new PartnerTypeType(), $entity, array(
            'action' => $this->generateUrl('partnertype_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PartnerType entity.
     *
     * @Route("/{id}", name="partnertype_update")
     * @Method("PUT")
     * @Template("ColdkitchenBundle:PartnerType:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:PartnerType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PartnerType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('partnertype_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a PartnerType entity.
     *
     * @Route("/{id}", name="partnertype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ColdkitchenBundle:PartnerType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PartnerType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('partnertype'));
    }

    /**
     * Creates a form to delete a PartnerType entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('partnertype_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
