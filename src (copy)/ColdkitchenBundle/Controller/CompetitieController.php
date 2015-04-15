<?php

namespace ColdkitchenBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ColdkitchenBundle\Entity\Competitie;
use ColdkitchenBundle\Form\CompetitieType;

/**
 * Competitie controller.
 *
 * @Route("/competitie")
 */
class CompetitieController extends Controller
{

    /**
     * Lists all Competitie entities.
     *
     * @Route("/", name="competitie")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ColdkitchenBundle:Competitie')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Competitie entity.
     *
     * @Route("/", name="competitie_create")
     * @Method("POST")
     * @Template("ColdkitchenBundle:Competitie:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Competitie();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('competitie_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Competitie entity.
     *
     * @param Competitie $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Competitie $entity)
    {
        $form = $this->createForm(new CompetitieType(), $entity, array(
            'action' => $this->generateUrl('competitie_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Competitie entity.
     *
     * @Route("/new", name="competitie_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Competitie();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Competitie entity.
     *
     * @Route("/{id}", name="competitie_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:Competitie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Competitie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Competitie entity.
     *
     * @Route("/{id}/edit", name="competitie_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:Competitie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Competitie entity.');
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
    * Creates a form to edit a Competitie entity.
    *
    * @param Competitie $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Competitie $entity)
    {
        $form = $this->createForm(new CompetitieType(), $entity, array(
            'action' => $this->generateUrl('competitie_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Competitie entity.
     *
     * @Route("/{id}", name="competitie_update")
     * @Method("PUT")
     * @Template("ColdkitchenBundle:Competitie:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ColdkitchenBundle:Competitie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Competitie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('competitie_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Competitie entity.
     *
     * @Route("/{id}", name="competitie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ColdkitchenBundle:Competitie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Competitie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('competitie'));
    }

    /**
     * Creates a form to delete a Competitie entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('competitie_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
