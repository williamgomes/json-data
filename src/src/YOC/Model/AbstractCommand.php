<?php

namespace YOC\Model;

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;


abstract class AbstractCommand extends ContainerAwareCommand
{

    /**
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
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