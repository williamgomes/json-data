<?php

namespace YOC\Model;

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;


abstract class AbstractModel implements ContainerAwareInterface
{

    use ContainerAwareTrait;

    /**
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }

    /**
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->container->get('doctrine')->getManager();
    }

    /**
     * @param $entityClass
     * @return ObjectRepository
     */
    public function getRepository($entityClass)
    {
        return $this->getObjectManager()->getRepository($entityClass);
    }
}