<?php

namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class OfferRepository extends EntityRepository {
	public function findBest() {
		$qb = $this->createQueryBuilder('offer');

		$qb
			->addSelect(['form', 'type'])
			->join('offer.form', 'form')
			->join('form.type', 'type')
			->orderBy('offer.price', 'ASC')
			->groupBy('form.type');

		return $qb->getQuery()->getResult();

	}
}