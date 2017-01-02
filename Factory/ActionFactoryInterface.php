<?php

namespace mbartok\EntityDescriberBundle\Factory;

use mbartok\EntityDescriberBundle\Model\ActionInterface;

/**
 * Interface implemented by the factory to create items
 */
interface ActionFactoryInterface
{
    /**
     * Creates a action item
     *
     * @param string $name
     * @param array $options
     *
     * @return ActionInterface
     */
    public function createAction($name, array $options = array());
}