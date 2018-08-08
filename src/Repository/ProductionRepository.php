<?php

namespace App\Repository;

use App\Entity\Production;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\ProductionInterface;

/**
 * @method Production|null find($id, $format, $id_shipper_address_id, $date_receipt, $nb_pages )
 * @method Production|null findOneBy(array $criteria, array $orderBy = null)
 * @method Production[]    findAll()
 * @method Production[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class ProductionRepository extends EntityRepository {


    /**
     * Loads the user for the given username.
     *
     * This method must return null if the user is not found.
     *
     * @param string $production The production
     *
     * @return ProductionInterface
     * @throws \Doctrine\ORM\NonUniqueResultException
     */


    public function loadProduction() {
        $table = $this->getClassMetadata()->table["production, customer"];
        
    }
}