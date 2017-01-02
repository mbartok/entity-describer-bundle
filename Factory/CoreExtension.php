<?php

namespace mbartok\EntityDescriberBundle\Factory;

use mbartok\EntityDescriberBundle\Model\ActionInterface;

class CoreExtension implements ExtensionInterface
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
                'routeParams' => array(),
                'label' => null,
                'attributes' => array(),
                'linkAttributes' => array(),
                'display' => true,
                'displayChildren' => true,
            ),
            $options
        );
    }

    /**
     * Configures the newly created item with the passed options
     *
     * @param ActionInterface $item
     * @param array $options
     */
    public function buildItem(ActionInterface $item, array $options)
    {
        $item
            ->setRouteName($options['route'])
            ->setRouteParams($options['routeParams'])
            ->setLabel($options['label'])
            ->setAttributes($options['attributes'])
            ->setLinkAttributes($options['linkAttributes'])
            ->setDisplay($options['display'])
            ->setDisplayChildren($options['displayChildren']);
    }
}
