<?php

namespace mbartok\EntityDescriberBundle\Factory;

use mbartok\EntityDescriberBundle\Model\ItemInterface;

/**
 * Interface implemented by the factory to create items
 */
interface ItemFactoryInterface
{
    /**
     * Creates a action item
     *
     * @param string $name
     * @param array $options
     *
     * @return ItemInterface
     */
    public function createItem($name, array $options = array());
}