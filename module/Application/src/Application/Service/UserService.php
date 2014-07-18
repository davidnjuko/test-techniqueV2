<?php

namespace Application\Service;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class UserService implements ServiceLocatorAwareInterface, EventManagerAwareInterface
{

    use ServiceLocatorAwareTrait;
    use EventManagerAwareTrait;

    public function persist(\Application\Entity\User $user)
    {
        $em = $this->getServiceLocator()->get('entity_manager');
        $em->persist($user);
        $em->flush();
    }

}