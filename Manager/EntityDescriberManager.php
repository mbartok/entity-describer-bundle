<?php

namespace mbartok\EntityDescriberBundle\Manager;

use mbartok\EntityDescriberBundle\Discovery\EntityDescriberDiscovery;

class EntityDescriberManager
{
    /**
     * @var EntityDescriberDiscovery
     */
    private $discovery;

    public function __construct(EntityDescriberDiscovery $discovery)
    {
        $this->discovery = $discovery;
    }

    /**
     * Returns a list of available describers.
     *
     * @return array
     */
    public function getDescribers()
    {
        return $this->discovery->getDescribers();
    }

    /**
     * Returns one worker by class name
     *
     * @param $className
     * @return array
     *
     * @throws \Exception
     */
    public function getDescriber($className)
    {
        $describers = $this->discovery->getDescribers();
        if (isset($describers[$className])) {
            return $describers[$className];
        }
        throw new \Exception('Entity describer for ' . $className . ' not found.');
    }
}