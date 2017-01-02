<?php

namespace mbartok\EntityDescriberBundle\Factory;

use mbartok\EntityDescriberBundle\Model\ActionInterface;

interface ExtensionInterface
{
    /**
     * Builds the full option array used to configure the item.
     *
     * @param array $options The options processed by the previous extensions
     *
     * @return array
     */
    public function buildOptions(array $options);

    /**
     * Configures the item with the passed options
     *
     * @param ActionInterface $item
     * @param array $options
     */
    public function buildItem(ActionInterface $item, array $options);
}
