<?php

namespace ColdkitchenBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PartnerTypeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PartnerTypeRepository extends EntityRepository
{
	public function findFieldpartners(){
		
		$id = 1;

		return $this->find($id);
	}
}
