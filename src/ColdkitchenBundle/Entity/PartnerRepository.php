<?php

namespace ColdkitchenBundle\Entity;

use Doctrine\ORM\EntityRepository;
use ColdkitchenBundle\Entity\PartnerTypeRepository as TypeRepo;

/**
 * PartnerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PartnerRepository extends EntityRepository
{
	public function findZichtbaar(){
		$query = $this->createQueryBuilder('p')
		    ->where('p.zichtbaar= 1')
		    ->getQuery();


		return($query->getResult());

	}
	public function findFieldpartners($zichtbaar = false){
		

		$query = $this->createQueryBuilder('p')
		    ->where('p.zichtbaar= :zichtbaar')
		    ->andwhere('p.typepartner=1')
		    ->setParameter('zichtbaar',$zichtbaar)
		    ->getQuery();


		return($query->getResult());

	}
}
