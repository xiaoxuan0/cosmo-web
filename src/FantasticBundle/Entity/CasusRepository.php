<?php

namespace FantasticBundle\Entity;

use Doctrine\ORM\EntityRepository;
use UtilBundle\Service\UtilService;

class CasusRepository extends EntityRepository
{
    public function findCasusByGuid($guid) {
        return $this->findOneBy(array('guid' => $guid));
    }

    public function saveCasus($casus)
    {
        $casus->setUpdateTime(UtilService::getCurrentTime());
        $this->getEntityManager()->persist($casus);
        $this->getEntityManager()->flush();
    }

    public function getLatestPublicCasusList()
    {
        return $this->findBy(array('public' => true), array('createTime' => 'DESC'), 5, 0);
    }

    public function getTotalPublicCasusNumber()
    {
        $queryStr = "select count(c) from FantasticBundle:Casus c where c.public = true";
        $query = $this->getEntityManager()->createQuery($queryStr);
        $result = $query->getResult();
        if ($result[0][1]) {
            return $result[0][1];
        } else {
            return 0;
        }
    }

    public function listToArray($casusList) {
        $casusListArray = array();
        foreach ($casusList as $casus) {
            array_push($casusListArray, $casus->toArray());
        }
        return $casusListArray;
    }
}