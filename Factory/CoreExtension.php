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
                'params' => array(),
                'label' => null,
                'linkAttributes' => array(),
                'display' => true,
                'displayChildren' => true,
                'color' => null
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
            ->setRouteParams($options['params'])
            ->setLabel($options['label'])
            ->setLinkAttributes($options['linkAttributes'])
            ->setDisplay($options['display'])
            ->setDisplayChildren($options['displayChildren'])
            ->setColor($options['color']);

        $this->buildExtras($item, $options);
    }

    /**
     * Configures the newly created item's extras
     * Extras are processed one by one in order not to reset values set by other extensions
     *
     * @param ActionInterface $item
     * @param array $options
     */
    private function buildExtras(ActionInterface $item, array $options)
    {
        if (!empty($options['extras'])) {
            foreach ($options['extras'] as $key => $value) {
                $item->setExtra($key, $value);
            }
        }
    }
}
