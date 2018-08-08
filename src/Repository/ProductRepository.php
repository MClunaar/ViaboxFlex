<?php

namespace App\Repository;


use Doctrine\ORM\EntityRepository;


class ProductRepository extends EntityRepository {

    public function  myFindDQL()
    {

        $query = $this->_em ->createQuery('SELECT p.price, t.name FROM App:Product p, App:Type t, App:Form f WHERE p.form=f.id and f.type=t.id');
        $results=$query->getResult();


        return $results;
    }

}