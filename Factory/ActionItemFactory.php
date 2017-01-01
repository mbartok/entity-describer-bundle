<?php

namespace mbartok\EntityDescriberBundle\Factory;

use mbartok\EntityDescriberBundle\Model\ItemInterface;

class ActionItemFactory
{
    /**
     * Builds the full option array used to configure the item.
     *
     * @param array $options
     *
     * @return array
     */
    public function buildOptions(array $options)
    {
        return array_merge(
            array(
                'route' => null,
                'parameters' => [],
                'attributes' => []
            ),
            $options
        );
    }

    /**
     * Configures the newly created item with the passed options
     *
     * @param ItemInterface $item
     * @param array $options
     */
    public function buildItem(ItemInterface $item, array $options)
    {
        $item
            ->setRouteName($options['route'])
            ->setRouteParams($options['route_params'])
            ->setLabel($options['label'])
            ->setAttributes($options['attributes'])
            ->setLinkAttributes($options['linkAttributes'])
            ->setCurrent($options['current'])
            ->setDisplay($options['display'])
            ->setDisplayChildren($options['displayChildren']);

        $this->buildExtras($item, $options);
    }

    /**
     * Configures the newly created item's extras
     * Extras are processed one by one in order not to reset values set by other extensions
     *
     * @param ItemInterface $item
     * @param array $options
     */
    private function buildExtras(ItemInterface $item, array $options)
    {
        if (!empty($options['extras'])) {
            foreach ($options['extras'] as $key => $value) {
                $item->setExtra($key, $value);
            }
        }
    }
}
