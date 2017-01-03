<?php

namespace mbartok\EntityDescriberBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use mbartok\EntityDescriberBundle\Model\Describable;
use mbartok\EntityDescriberBundle\Model\EntityDescriber;

class EntityDescriberManager
{
    private $describers;
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
        $this->describers = array();
    }

    public function addDescriber(EntityDescriber $describer, $class)
    {
        $this->describers[$class] = $describer;
    }

    /**
     * Returns a list of available describers.
     *
     * @return EntityDescriber[]
     */
    public function getDescribers()
    {
        return $this->describers;
    }

    /**
     * Returns one worker by class name
     *
     * @param string $className
     * @return EntityDescriber
     *
     * @throws \Exception
     */
    public function getDescriberByClassName($className)
    {
        if (array_key_exists($className, $this->describers)) {
            return $this->describers[$className];
        }
        throw new \Exception('Entity describer for ' . $className . ' not found.');
    }

    public function getDescriberByClass(Describable $describable)
    {
        $className = get_class($describable);
        if ($this->objectManager->getMetadataFactory()->isTransient($className)) {
            $className = $this->objectManager->getClassMetadata($className)->getName();
        }
        return $this->getDescriberByClassName($className);
    }
}