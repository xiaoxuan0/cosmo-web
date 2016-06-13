<?php

namespace FantasticBundle\Entity;

use Doctrine\ORM\EntityRepository;
use UtilBundle\Service\UtilService;

class UserRepository extends EntityRepository
{
    public function findUserByGuid($guid)
    {
        return $this->findOneBy(array('guid' => $guid, 'valid' => true));
    }

    public function findUserByTelephone($telephone)
    {
        return $this->findOneBy(array('telephone' => $telephone, 'valid' => true));
    }

    public function saveUser($user)
    {
        $user->setUpdateTime(UtilService::getCurrentTime());
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}