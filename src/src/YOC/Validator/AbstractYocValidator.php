<?php

namespace YOC\Validator;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Interface AbstractYocValidator
 * @package YOC\Validator
 */
abstract class AbstractYocValidator implements ContainerAwareInterface
{
    protected $container;

    public function setContainer(ContainerInterface $container)
    {
        if (empty($this->container)) {
            $this->container = $container;
        }
    }

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

    /**
     * @param array $params
     * @return boolean
     */
    abstract public function validate($params = array());
}